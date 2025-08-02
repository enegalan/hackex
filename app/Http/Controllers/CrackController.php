<?php

namespace App\Http\Controllers;

use App\Models\Crack;
use Illuminate\Http\Request;

class CrackController extends Controller {
    public static function checkAndUpdateCrack(Crack $crack) {
        if ($crack->status === Crack::WORKING && now()->greaterThanOrEqualTo($crack->expires_at)) {
            $crack->status = Crack::SUCCESSFUL;
            $crack->save();
        }
        return $crack;
    }
}
