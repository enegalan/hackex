<?php

namespace App\Http\Controllers;

use App\Models\Crack;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class BankController extends Controller {
    const DEPOSITS = [
        1 => [
            'id' => 1,
            'oc' => 400,
            'value' => 10000,
        ],
        2 => [
            'id' => 2,
            'oc' => 1200,
            'value' => 26000,
        ],
        3 => [
            'id' => 3,
            'oc' => 2000,
            'value' => 60000,
        ],
        4 => [
            'id' => 4,
            'oc' => 4600,
            'value' => 150000,
        ],
    ];
    function loginBankAccount() {
        if (session()->get('isHacked')) {
            $victim = session()->get('hackedUser');
            $hasCredentials = Crack::hasCredentials($victim['id']);
            if (!$hasCredentials) {
                return back()->with('error', 'You have no credentials for this bank account.');
            }
            $hacker = Auth::user();
            LogController::doLog(LogController::SECURITY_ALERT, $victim, ['ip' => $hacker->ip]);
        }
        return view('bank-account');
    }
    function crack (Request $request) {
        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);
        $auth_user = Auth::user();
        // Check if user has a crack process
        $crack = $auth_user->Crack()->where('victim_id', $user_id)->where('status', Crack::WORKING)->first();
        if ($crack) {
            return redirect()->back()->with('error', 'You already have a crack process running for this user.');
        }
        // For security reasons, check if auth user is allowed to crack this user's bank account
        $canCrack = $auth_user->Bypass()
        ->where('victim_id', $user_id)
        ->where('status', Crack::SUCCESSFUL)
        ->exists() && $auth_user['password_cracker_level'] > 1;
        if (!$canCrack) {
            return redirect()->back()->with('error', 'You are not allowed to crack this user.');
        }
        $passwordEncryptorLevel = $user->password_encryptor_level;
        $passwordCrackerLevel = $auth_user['password_cracker_level'];
        $auth_user->Crack()->create([
            'victim_id' => $user_id,
            'expires_at' => calculateCrackExpiration($passwordEncryptorLevel, $passwordCrackerLevel),
        ]);
        return redirect()->back()->with('message', 'Download has started.');
    }
    function deposit(Request $request) {
        $deposit_id = $request->input('deposit_id');
        $deposit = self::DEPOSITS[$deposit_id] ?? false;
        if (!$deposit) {
            return back()->with('error', 'This deposit does not exist.');
        }
        $deposit_oc = $deposit['oc'];
        $success = BuyOCController::purchase($deposit_oc);
        if ($success) {
            $deposit_value = $deposit['value'];
            // Add deposit value to Secured Savings ignoring Max limits
            $user = Auth::user();
            $user->secured_bitcoins += $deposit_value;
            $success = $user->save();
            if ($success) {
                return back()->with(['message' => 'Deposit successfully done!.', 'autologin' => true]);
            }
        }
        return back()->with('error', 'Deposit could not be done.');
    }
}
