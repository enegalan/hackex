<?php

namespace App\Http\Controllers;

use App\Enums\AppPrices;
use App\Enums\Apps;
use App\Enums\ExpActions;
use Auth;
use Illuminate\Http\Request;

class StoreController extends Controller {
    function buy($app_name) {
        $user = Auth::user();
        $checking = $user->checking_bitcoins;
        $secured = $user->secured_bitcoins;
        $total = $checking + $secured;
        // Validate if level column exists
        $levelColumn = $app_name . '_level';
        if (!isset($user->$levelColumn)) {
            throw new \Exception("App '$app_name' is not valid.");
        }
        $nextLevel = $user->$levelColumn + 1;
        $price = AppPrices::getPrice($app_name, $nextLevel);
        if ($total < $price) {
            return redirect()->back()->with('error', 'Not enough bitcoins');
        }
        // Subtract from checking first
        if ($checking >= $price) {
            $user->checking_bitcoins -= $price;
        } else {
            $remaining = $price - $checking;
            $user->checking_bitcoins = 0;
            $user->secured_bitcoins -= $remaining;
        }
        $user->$levelColumn = $nextLevel;
        $user->save();
        LogController::doLog(LogController::PURCHASED, $user, ['app_level' => $nextLevel, 'app_name' => Apps::getAppName($app_name)]);
        ExpActions::addExp('purchased_items', $app_name, false);
        return redirect()->back()->with('success', 'App successfully upgraded.');
    }
}
