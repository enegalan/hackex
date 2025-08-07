<?php

namespace App\Enums;

use App\Models\User;
use App\Notifications\LevelUpNotification;
use Auth;
use Illuminate\Http\Request;
use Log;

class ReputationActions {
    const REPUTATION_PER_ACTIONS = [
        'bypass_successful' => [
            'base' => 150,
            'level_multiplicator' => 1.20,
            'difficult_multiplicator' => 1.05,
        ],
        'rehack_bypass_successful' => [
            'base' => 200,
            'level_multiplicator' => 1.40,
            'difficult_multiplicator' => 1.6,
        ],
        'crack_successful' => [
            'base' => 200,
            'level_multiplicator' => 1.30,
            'difficult_multiplicator' => 1.10,
        ],
        'crack_bypass_successful' => [
            'base' => 250,
            'level_multiplicator' => 1.50,
            'difficult_multiplicator' => 1.65,
        ],
        'upload_successful' => [
            'base' => 100,
            'level_multiplicator' => 1.10,
            'difficult_multiplicator' => null,
        ],
        'download_successful' => [
            'base' => 50,
            'level_multiplicator' => 1.00,
            'difficult_multiplicator' => null,
        ],
    ];
    public static function addReputation($actionKey, $subkey = null, $addOnce = true, $uniqueId = null, $difficultAction = false) {
        $user = Auth::user();
        if (!$user) return false;
        $actionReputation = self::getActionReputation($actionKey, $subkey);
        if (!$actionReputation) return false;
        $added = false;
        $addedReputation = [];
        if ($addOnce) {
            $addedReputation = session()->get('addedReputation');
            if ($addedReputation) {
                foreach ($addedReputation as $log) {
                    if ($log['user_id'] == Auth::id() && $log['key'] == $actionKey && $log['subkey'] == $subkey) {
                        if ($log['id'] && $uniqueId && $log['id'] == $uniqueId) {
                            $added = true;
                        } else {
                            $added = true;
                        }
                        break;
                    }
                }
            }
        }
        if (!$added) {
            $base = $actionReputation['base'];
            $levelMultiplicator = $actionReputation['level_multiplicator'];
            if ($difficultAction && $actionReputation['difficult_multiplicator']) {
                $levelMultiplicator += $actionReputation['difficult_multiplicator'];
            }
            $gainedReputation = intval($base * $levelMultiplicator);
            $user->reputation += $gainedReputation;
            $user->score = $user->level * $user->reputation;
            $user->save();
            $reputation = [
                'id' => $uniqueId,
                'user_id' => Auth::id(),
                'key' => $actionKey,
                'subkey' => $actionKey,
            ];
            if (!$addedReputation) {
                session()->put('addedReputation', [$reputation]);
            } else {
                $addedReputation[] = $reputation;
                session()->put('addedReputation', $addedReputation);
            }
            return $gainedReputation;
        }
        return 0;
    }
    public static function getActionReputation($actionKey, $subkey = null) {
        if (!isset(self::REPUTATION_PER_ACTIONS[$actionKey])) return null;
        $config = self::REPUTATION_PER_ACTIONS[$actionKey];
        if ($subkey === null) return $config;
        return $config[$subkey] ?? null;
    }
}
