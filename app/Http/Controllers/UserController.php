<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    static function getAvailableIp() {
        $usedIps = User::pluck('ip')->toArray();
        $ip = null;
        $attempts = 0;
        $max_attempts = 5000;
        while ($attempts < $max_attempts) {
            $ip = rand(1, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(1, 254);
            if (!in_array($ip, $usedIps)) {
                return $ip;
            }
            $attempts++;
        }
        return $ip;
    }
}
