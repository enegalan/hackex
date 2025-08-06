<?php

namespace App\Http\Controllers;

use App\Enums\ExpActions;
use App\Models\Crack;
use Illuminate\Http\Request;

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
            }
        }
        return $crack;
    }
    static function calculateSuccessChance(int $passwordCrackerLevel, int $passwordEncryptorLevel): int {
        $diff = $passwordEncryptorLevel - $passwordCrackerLevel;
        // Crack level penalty (more high, more difficult)
        $progressPenalty = min(0.5, $passwordCrackerLevel * 0.02); // to -50%
        // Base chance for equal level players
        $baseChance = 80;
        // Level diff modificator
        // If diff > 0 (password encryptor higher), decrease chance
        // Si diff < 0 (password cracker higher), increase chance
        $levelModifier = -($diff * 8); // 8% per level diff
        // Apply progress penalty (higher levels less chance)
        $adjustedChance = ($baseChance + $levelModifier) * (1 - $progressPenalty);
        // Limit between 5 to 95%
        return max(5, min(95, round($adjustedChance)));
    }
}
