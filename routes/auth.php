<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\Anonymous;
use App\Http\Middleware\IsFullyVerified;
use App\Models\Network;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::post('/signin', function (Request $request) {
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
        return redirect()->intended('/');
    } else {
        $errors = array();
        if (!$user) {
            $errors['login-username-email'] = 'User not found.';
        } else if (!$correct_password) {
            $errors['login-password'] = 'Incorrect password.';
        }
        return back()->withErrors($errors)->withInput();
    }
});

Route::post('/signup', function (Request $request) {
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
        //dd($errors);
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
    return redirect('/');
});

Route::middleware([IsFullyVerified::class])->group(function () {
    Route::get('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    });
});

Route::middleware([Anonymous::class])->group(function () {
    Route::get('/forgot-password', function () {
        return view('forgot-password');
    });
});

