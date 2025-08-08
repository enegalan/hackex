<?php

namespace App\Http\Controllers;

class ViewController extends Controller {
    function home() {
        return view('home');
    }
    function processes() {
        return view('processes');
    }
    function scan() {
        return view('scan');
    }
    function bankAccount() {
        return view('bank-login');
    }
    function store() {
        return view('store');
    }
    function log() {
        return view('log');
    }
    function device() {
        return view('my-device');
    }
    function messages() {
        return view('messages');
    }
    function forgotPassword() {
        return view('forgot-password');
    }
    function leaderboards() {
        return view('leaderboards');
    }
}
