<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetCode;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Mail;

class PasswordCodeController extends Controller {
    public function sendCode(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $email = $request->input('email');
        session(['password_reset_email' => $email]);
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // 6 digits
        DB::table('password_resets_codes')->updateOrInsert(
            ['email' => $request->email],
            ['code' => $code, 'created_at' => Carbon::now()]
        );
        Mail::to($request->email)->send(new PasswordResetCode($code));
        return back()->with(['success' => 'Recovery code has been sent.', 'validateCode' => true]);
    }

    public function verifyCode(Request $request) {
        $code1 = $request->input('code1');
        $code2 = $request->input('code2');
        $code3 = $request->input('code3');
        $code4 = $request->input('code4');
        $code5 = $request->input('code5');
        $code6 = $request->input('code6');
        $code = $code1 . $code2 . $code3 . $code4 . $code5 . $code6;
        $email = session()->get('password_reset_email');
        $record = DB::table('password_resets_codes')
            ->where('email', $email)
            ->where('code', $code)
            ->first();
        if (!$record) {
            return back()->withErrors(['code' => 'Invalid code']);
        }
        // Check expiration (10 min)
        if (Carbon::parse($record->created_at)->addMinutes(10)->isPast()) {
            return back()->withErrors(['code' => 'Code has expired']);
        }
        return redirect()->back()->with(['resetPassword' => true]);
    }

    public function resetPassword(Request $request) {
        $password = $request->input('password');
        if (!$password || is_null($password)) {
            return redirect()->back()->with(['resetPassword' => true])->withErrors(['password' => 'Password field must be specified']);
        }
        if (strlen($password) < 8) {
            return redirect()->back()->with(['resetPassword' => true])->withErrors(['password' => 'Password must have at least 8 characters']);
        }
        $user = User::where('email', session('password_reset_email'))->first();
        if (!$user) return redirect()->back();
        $user->password = bcrypt($request->password);
        $user->save();
        DB::table('password_resets_codes')->where('email', $user->email)->delete();
        session()->forget('password_reset_email');
        return redirect()->route('home')->with('success', 'Password correctly updated');
    }
}
