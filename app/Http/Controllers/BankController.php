<?php

namespace App\Http\Controllers;

use App\Models\Crack;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class BankController extends Controller {
    public static $DEPOSITS;
    public static function getDeposits() {
        if (!self::$DEPOSITS) self::$DEPOSITS = config('core.earnings.oc.deposits');
        return self::$DEPOSITS;
    }
    public static function loginBankAccount($hackAllow = true, $data = []) {
        if ($hackAllow && session()->get('isHacked')) {
            $victim = session()->get('hackedUser');
            $hasCredentials = Crack::hasCredentials($victim['id']);
            if (!$hasCredentials) {
                return back()->with('error', __('errors.bank.no_credentials'));
            }
            $hacker = Auth::user();
            LogController::doLog(LogController::getConstant('SECURITY_ALERT', $victim['locale']), $victim, ['ip' => $hacker->ip]);
        }
        return view('bank-account')->with($data);
    }
    public static function autoLoginBankAccount($data) {
        return self::loginBankAccount(false, $data);
    }
    function crack (Request $request) {
        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);
        $auth_user = Auth::user();
        // Check if user has a crack process
        if ($auth_user->Crack()->where('victim_id', $user_id)->where('status', Crack::WORKING)->exists()) return redirect()->back()->with('error', __('errors.bank.already_cracking'));
        // For security reasons, check if auth user is allowed to crack this user's bank account
        $canCrack = $auth_user->Bypass()
        ->where('victim_id', $user_id)
        ->where('status', Crack::SUCCESSFUL)
        ->exists() && $auth_user['password_cracker_level'] > 1;
        if (!$canCrack) {
            return redirect()->back()->with('error', __('errors.bank.crack_not_allowed'));
        }
        $passwordEncryptorLevel = $user->password_encryptor_level;
        $passwordCrackerLevel = $auth_user['password_cracker_level'];
        $auth_user->Crack()->create([
            'victim_id' => $user_id,
            'expires_at' => calculateCrackExpiration($passwordEncryptorLevel, $passwordCrackerLevel),
            'visible' => 1,
        ]);
        return redirect()->back()->with('success', __('notifies.bank.crack_started'));
    }
    function deposit(Request $request) {
        $deposit_id = $request->input('deposit_id');
        $deposit = self::getDeposits()[$deposit_id] ?? false;
        if (!$deposit) return back()->with('error', __('errors.bank.deposit_not_found'));
        $deposit_oc = $deposit['oc'];
        $success = BuyOCController::purchase($deposit_oc);
        if ($success === true) {
            $deposit_value = $deposit['value'];
            // Add deposit value to Secured Savings ignoring Max limits
            $user = Auth::user();
            $user->secured_bitcoins += $deposit_value;
            $success = $user->save();
            if ($success) {
                return self::autoLoginBankAccount(['success' => __('notifies.bank.deposit_success')]);
            }
        }
        return view('bank-account')->with('error', __('errors.bank.deposit_error'));
    }
}
