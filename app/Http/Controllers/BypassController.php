<?php

namespace App\Http\Controllers;

use App\Enums\ExpActions;
use App\Models\Bypass;
use Illuminate\Http\Request;

class BypassController extends Controller {
    public static function checkAndUpdateBypass(Bypass $bypass) {
        if ($bypass->status === Bypass::WORKING && now()->greaterThanOrEqualTo($bypass->expires_at)) {
            $successChance = self::calculateSuccessChance(
                $bypass->User['bypasser_level'],
                $bypass->Victim['firewall_level']
            );
            $bypass->status = rand(1, 100) <= $successChance ? Bypass::SUCCESSFUL : Bypass::FAILED;
            $bypass->save();
            if ($bypass->status === Bypass::SUCCESSFUL) {
                LogController::doLog(LogController::BYPASS_SUCCESSFUL, $bypass->User, ['ip' => $bypass->Victim->ip]);
                ExpActions::addExp('bypass_successful', null, true, 'bypass_' . $bypass->id);
            }
        }
        return $bypass;
    }
    static function calculateSuccessChance(int $bypasserLevel, int $firewallLevel): int {
        $diff = $firewallLevel - $bypasserLevel;
        // Bypasser level penalty (more high, more difficult)
        $progressPenalty = min(0.5, $bypasserLevel * 0.02); // to -50%
        // Base chance for equal level players
        $baseChance = 80;
        // Level diff modificator
        // If diff > 0 (firewall higher), decrease chance
        // Si diff < 0 (bypasser higher), increase chance
        $levelModifier = -($diff * 8); // 8% per level diff
        // Apply progress penalty (higher levels less chance)
        $adjustedChance = ($baseChance + $levelModifier) * (1 - $progressPenalty);
        // Limit between 5 to 95%
        return max(5, min(95, round($adjustedChance)));
    }
}
