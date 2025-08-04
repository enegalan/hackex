<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Auth;
use Illuminate\Http\Request;

class AppController extends Controller {
    function antivirus (Request $request) {
        $transfer_id = $request->input('transfer_id');
        $transfer = Transfer::findOrFail($transfer_id);
        if ($transfer->Victim->id !== Auth::id()) {
            return back()->with('error', 'You are not able to clean a virus that is not yours.');
        }
        if ($transfer->app_level > Auth::user()['antivirus_level']) {
            return back()->with('error', 'Your antivirus is not strong enough!');
        }
        $success = $transfer->delete();
        if ($success) {
            return back()->with('success', 'Your antivirus has cleaned the virus!');
        } else {
            return back()->with('error', 'Error while cleaning this virus.');
        }
    }
    function spam (Request $request) {
        $transfer_id = $request->input('transfer_id');
        $transfer = Transfer::findOrFail($transfer_id);
        if ($transfer->Victim->id === Auth::id()) {
            return back()->with('error', 'This is not they way to clean an Spam that someones has on you. Use the antivirus!');
        }
        $success = $transfer->delete();
        if ($success) {
            return back()->with('success', 'Spam process cleaned.');
        } else {
            return back()->with('error', 'Error while cleaning this Spam process.');
        }
    }
    function spyware (Request $request) {
        $transfer_id = $request->input('transfer_id');
        $transfer = Transfer::findOrFail($transfer_id);
        if ($transfer->Victim->id === Auth::id()) {
            return back()->with('error', 'This is not they way to clean an Spyware that someones has on you. Use the antivirus!');
        }
        $success = $transfer->delete();
        if ($success) {
            return back()->with('success', 'Spam process cleaned.');
        } else {
            return back()->with('error', 'Error while cleaning this Spam process.');
        }
    }
}
