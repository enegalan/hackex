<?php

namespace App\Http\Controllers;

use App\Enums\AppPrices;
use App\Enums\Apps;
use App\Enums\ExpActions;
use App\Enums\MaxSavings;
use App\Models\Bypass;
use App\Models\Crack;
use App\Models\Network;
use App\Models\Platform;
use Auth;

class StoreController extends Controller {
    function buy($app_name) {
        $user = Auth::user();
        $checking = $user->checking_bitcoins;
        if ($app_name !== 'device' && $app_name !== 'network') {
            // Validate if level column exists
            $levelColumn = $app_name . '_level';
            if (!isset($user->$levelColumn)) throw new \Exception("App '$app_name' is not valid.");
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
        if (!self::hasEnoughBitcoins($price, $user)) return redirect()->back()->with('error', 'Not enough bitcoins');
        // Subtract from checking first
        if ($checking >= $price) $user->checking_bitcoins -= $price;
        else {
            $remaining = $price - $checking;
            $user->checking_bitcoins = 0;
            $user->secured_bitcoins -= $remaining;
        }
        if ($app_name !== 'device' && $app_name !== 'network') {
            $user->$levelColumn = $nextLevel;
            if ($app_name === 'firewall') {
                // Do bypasses unavailable where user is the victim
                Bypass::where('victim_id', $user->id)->update([
                    'available' => 0,
                ]);
            } elseif ($app_name === 'password_encryptor') {
                // Do cracks unavailable where user is the victim
                Crack::where('victim_id', $user->id)->update([
                    'available' => 0,
                ]);
            }
        } else {
            if ($app_name === 'device') {
                $user->platform_id = $next_platform->id;
                $user->max_savings += MaxSavings::getMaxSaving($next_platform->id);
            } elseif ($app_name === 'network') {
                $user->network_id = $next_network->id;
            }
        }
        $user->save();
        LogController::doLog(LogController::PURCHASED, $user, ['app_level' => $nextLevel, 'app_name' => Apps::getAppName($app_name)]);
        ExpActions::addExp('purchased_items', $app_name, false);
        return redirect()->back()->with('success', 'App successfully upgraded.');
    }
    public static function hasEnoughBitcoins($price, $user = null) {
        if (!$user) $user = Auth::user();
        $checking = $user->checking_bitcoins;
        $secured = $user->secured_bitcoins;
        $total = $checking + $secured;
        if ($total < $price) return false;
        return true;
    }
}
