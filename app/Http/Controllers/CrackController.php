<?php

namespace App\Http\Controllers;

use App\Enums\ExpActions;
use App\Enums\ReputationActions;
use App\Models\Crack;

class CrackController extends Controller {
    public static function checkAndUpdateCrack(Crack $crack) {
        if ($crack->status === Crack::WORKING && now()->greaterThanOrEqualTo($crack->expires_at)) {
            $successChance = self::calculateSuccessChance(
                $crack->User['password_cracker_level'],
                $crack->Victim['password_encryptor_level']
            );
            $crack->status = rand(1, 100) <= $successChance ? Crack::SUCCESSFUL : Crack::FAILED;
            $crack->save();
            if ($crack->status === Crack::SUCCESSFUL) {
                ExpActions::addExp('crack_successful', null, true, 'crack_' . $crack->id);
                $difficultAction = $crack->Victim->password_encryptor_level > $crack->User->password_cracker_level;
                ReputationActions::addReputation('crack_successful', null, true, 'crack_' . $crack->id, $difficultAction);
                // Check if user re-hacked this crack
                if (Crack::where('user_id', $crack->User->id)->where('victim_id', $crack->Victim->id)->where('available', false)->exists()) ReputationActions::addReputation('rehack_crack_successful', null, true, 'rehack_crack_' . $crack->id, $difficultAction);
            }
        }
        return $crack;
    }
    static function calculateSuccessChance(int $passwordCrackerLevel, int $passwordEncryptorLevel): int {
        $diff = $passwordEncryptorLevel - $passwordCrackerLevel;
        // Crack level penalty (more high, more difficult)ç
        $progressPenalty = min(config('core.multiplicators.crack_success_chance.crack_penalty.from'), $passwordCrackerLevel * config('core.multiplicators.crack_success_chance.crack_penalty.level_multiplicator'));
        // Base chance for equal level players
        $baseChance = config('core.multiplicators.crack_success_chance.equal_level_players_base');
        // Level diff modificator
        // If diff > 0 (password encryptor higher), decrease chance
        // If diff < 0 (password cracker higher), increase chance
        $levelModifier = -($diff * config('core.multiplicators.crack_success_chance.level_diff')); // 8% per level diff
        // Apply progress penalty (higher levels less chance)
        $adjustedChance = ($baseChance + $levelModifier) * (1 - $progressPenalty);
        // Limit chances
        return max(config('core.multiplicators.crack_success_chance.min_chance'), min(config('core.multiplicators.crack_success_chance.max_chance'), round($adjustedChance)));
    }
}
