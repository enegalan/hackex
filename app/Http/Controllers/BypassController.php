<?php

namespace App\Http\Controllers;

use App\Enums\ExpActions;
use App\Enums\ReputationActions;
use App\Models\Bypass;

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
                LogController::doLog(LogController::getConstant('BYPASS_SUCCESSFUL', $bypass->User->locale), $bypass->User, ['ip' => $bypass->Victim->ip]);
                ExpActions::addExp('bypass_successful', null, true, 'bypass_' . $bypass->id);
                $difficultAction = $bypass->Victim->firewall_level > $bypass->User->bypasser_level;
                ReputationActions::addReputation('bypass_successful', null, true, 'bypass_' . $bypass->id, $difficultAction);
                // Check if user re-hacked this bypass
                if (Bypass::where('user_id', $bypass->User->id)->where('victim_id', $bypass->Victim->id)->where('available', false)->exists()) ReputationActions::addReputation('rehack_bypass_successful', null, true, 'rehack_bypass_' . $bypass->id, $difficultAction);
            }
        }
        return $bypass;
    }
    static function calculateSuccessChance(int $bypasserLevel, int $firewallLevel): int {
        $diff = $firewallLevel - $bypasserLevel;
        // Bypasser level penalty (more high, more difficult)
        $progressPenalty = min(config('core.multiplicators.bypass_success_chance.bypasser_penalty.from'), $bypasserLevel * config('core.multiplicators.bypass_success_chance.bypasser_penalty.level_multiplicator'));
        // Base chance for equal level players
        $baseChance = config('core.multiplicators.bypass_success_chance.equal_level_players_base');
        // Level diff modificator
        // If diff > 0 (firewall higher), decrease chance
        // If diff < 0 (bypasser higher), increase chance
        $levelModifier = -($diff * config('core.multiplicators.bypass_success_chance.level_diff'));
        // Apply progress penalty (higher levels less chance)
        $adjustedChance = ($baseChance + $levelModifier) * (1 - $progressPenalty);
        // Limit chances
        return max(config('core.multiplicators.bypass_success_chance.min_chance'), min(config('core.multiplicators.bypass_success_chance.max_chance'), round($adjustedChance)));
    }
}
