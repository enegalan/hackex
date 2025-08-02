<?php

namespace App\Http\Controllers;

use App\Models\Network;
use App\Models\Platform;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
    function logout (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    function signup(Request $request) {
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
                'repeat-password' => 'required|string|same:password',
            ], [
                'repeat-password.same' => 'Passwords does not match.',
            ]);
        } catch (ValidationException $e) {
            $errors = array('signup' => $e->errors());
            return back()
                ->withErrors($errors)
                ->withInput()
                ->with('initialToggle', true);
        }
        $first_platform = Platform::first();
        $first_network = Network::first();
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $first_platform['id'],
            'network_id' => $first_network['id'],
        ]);
        Auth::login($user);
        return view('home', ['access_boot' => 'Booting Device...']);
    }
    function signin(Request $request) {
        $request->validate([
            'username-email' => 'required|string',
            'password' => 'required|string',
        ]);
        $usernameEmail = $request->input('username-email');
        $password = $request->input('password');
        $isEmail = filter_var($usernameEmail, FILTER_VALIDATE_EMAIL);
        $user = $isEmail
            ? User::where('email', $usernameEmail)->first()
            : User::where('username', $usernameEmail)->first();
        $correct_password = $user && Hash::check($password, $user->password);
        if ($correct_password) {
            Auth::login($user);
            return view('home', ['access_boot' => 'Booting Device...']);
        } else {
            $errors = array();
            if (!$user) {
                $errors['login-username-email'] = 'User not found.';
            } else if (!$correct_password) {
                $errors['login-password'] = 'Incorrect password.';
            }
            return back()->withErrors($errors)->withInput();
        }
    }
}
