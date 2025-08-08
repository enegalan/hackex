<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Message;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller {
    const INITIAL_MESSAGE = ": transmission intercepted: 20190310
            : sender: PNT INTERNATIONAL INC
            : location: NA
            : decrypting...100%, done.
            : run interpreter... 100%, done.
            : results accuracy: 80%
            : output transmission:decrypt
            ***TRANSMISSION***
            Exceed alongside the horizon ...don't stray too far
            Positive correlations are the essential ..be of good cheer
            Grand openings are to be visited ...a fresh start is due
            Virtuous minds make for applicable tidings ...reap what you sow
            Inspire your inspirations ..if it's even possible
            Accept your welcomings ...if you come back
            Polite askings are the butterflies of tomorrow
            ..in a few months
            ***END TRANSMISSION***
            :copy... 100%, done exit";
    function contacts() {
        return view('contacts');
    }
    function sendRequest(Request $request) {
        $ip = $request->input('ip');
        if (!$ip) return back()->with('error', 'Please enter an IP.');
        if (!filter_var($ip, FILTER_VALIDATE_IP)) return back()->with('error', 'Please enter a valid IP.');
        $user = User::where('ip', $ip)->first();
        if (!$user) return back()->with('error', 'Device not found with that IP.');
        Friendship::create([
            'user_id' => Auth::id(),
            'friend_id' => $user->id,
            'accepted' => false,
        ])->save();
        return back()->with('success', 'Friend request has been sent.');
    }
    function acceptRequest(Request $request) {
        $friend_request_id = $request->input('friend_request_id');
        $friend_request = Friendship::findOrFail($friend_request_id);
        if ($friend_request->accepted == true) return back()->with('message', 'Friend request already accepted.');
        $friend_request->accepted = true;
        $friend_request->save();
        return back()->with('success', $friend_request->User->username . ' is now your part of your contacts.');
    }
    function declineRequest(Request $request) {
        $friend_request_id = $request->input('friend_request_id');
        $friend_request = Friendship::findOrFail($friend_request_id);
        if ($friend_request->accepted == true) return back()->with('message', 'Friend request is accepted, it can not be declined.');
        $friend_request->delete();
        return back()->with('success', 'Friend request declined.');
    }
    function removeFriendship(Request $request) {
        $friend_request_id = $request->input('friendship_id');
        $friend_request = Friendship::findOrFail($friend_request_id);
        $friend_request->delete();
        return back()->with('success', 'Contact removed from your agend.');
    }
    function compose(Request $request) {
        $to_id = $request->input('to');
        $message = $request->input('message');
        $subject = $request->input('subject');
        $userFriends = Auth::user()->Friend()->get();
        $validated = false;
        foreach ($userFriends as $user) {
            $validated = $user->id == $to_id;
            if ($validated) break;
        }
        if ($validated) $validated = Auth::id() !== $to_id;
        if (!$validated) return back()->with('error', 'Error while trying to send message.');
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $to_id,
            'subject' => $subject,
            'message' => $message,
        ])->save();
        return back()->with('success', 'Message has been sent.');
    }
    function message(Request $request) {
        $message_id = $request->input('message_id');
        $message = Message::findOrFail($message_id);
        if ($message->Receiver->id != Auth::id()) return back()->with('error', 'You are not receiver of this message.');
        $message->read = true;
        $message->save();
        return view('message', ['received_message' => $message]);
    }
    function deleteMessage(Request $request) {
        $message_id = $request->input('message_id');
        $message = Message::findOrFail($message_id);
        if ($message->Receiver->id != Auth::id()) return back()->with('error', 'You are not receiver of this message.');
        $message->delete();
        return view('messages')->with('success', 'Message deleted.');
    }
}
