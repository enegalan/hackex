<?php

namespace App\Http\Controllers;

use App\Enums\AppPrices;
use App\Enums\Apps;
use App\Enums\ExpActions;
use App\Models\Network;
use App\Models\Platform;
use Auth;
use Illuminate\Http\Request;

class StoreController extends Controller {
    function buy($app_name) {
        $user = Auth::user();
        $checking = $user->checking_bitcoins;
        $secured = $user->secured_bitcoins;
        $total = $checking + $secured;
        if ($app_name !== 'device' && $app_name !== 'network') {
            // Validate if level column exists
            $levelColumn = $app_name . '_level';
            if (!isset($user->$levelColumn)) {
                throw new \Exception("App '$app_name' is not valid.");
            }
            $nextLevel = $user->$levelColumn + 1;
            $price = AppPrices::getPrice($app_name, $nextLevel);
        } else {
            if ($app_name === 'device') {
                $actual_device_name = $user->Platform->name;
                $next_platform = Platform::getNextLevelDevice($actual_device_name);
                $price = $next_platform['price'];
                $next_platform = Platform::findOrFail($next_platform['id']);
                $nextLevel = $next_platform['name'];
            } elseif ($app_name === 'network') {
                $actual_network_name = $user->Network->name;
                $next_network = Network::getNextLevelNetwork($actual_network_name);
                $price = $next_network['price'];
                $next_network = Network::findOrFail($next_network['id']);
                $nextLevel = $next_network['name'];
            }
        }
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
        if ($app_name !== 'device' && $app_name !== 'network') {
            $user->$levelColumn = $nextLevel;
        } else {
            if ($app_name === 'device') {
                $user->platform_id = $next_platform->id;
            } elseif ($app_name === 'network') {
                $user->network_id = $next_network->id;
            }
        }
        $user->save();
        LogController::doLog(LogController::PURCHASED, $user, ['app_level' => $nextLevel, 'app_name' => Apps::getAppName($app_name)]);
        ExpActions::addExp('purchased_items', $app_name, false);
        return redirect()->back()->with('success', 'App successfully upgraded.');
    }
}
