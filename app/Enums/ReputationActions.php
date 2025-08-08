<?php

namespace App\Enums;

use Auth;

class ReputationActions {
    public static $REPUTATION_PER_ACTIONS;
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
                        if ($log['id'] && $uniqueId && $log['id'] == $uniqueId) $added = true;
                        else $added = true;
                        break;
                    }
                }
            }
        }
        if (!$added) {
            $base = $actionReputation['base'];
            $levelMultiplicator = $actionReputation['level_multiplicator'];
            if ($difficultAction && $actionReputation['difficult_multiplicator']) $levelMultiplicator += $actionReputation['difficult_multiplicator'];
            $gainedReputation = intval($base * $levelMultiplicator);
            $user->reputation += $gainedReputation;
            $user->score = $user->level * $user->reputation;
            $user->monthly_score = $user->score;
            $user->save();
            $reputation = [
                'id' => $uniqueId,
                'user_id' => Auth::id(),
                'key' => $actionKey,
                'subkey' => $actionKey,
            ];
            if (!$addedReputation) session()->put('addedReputation', [$reputation]);
            else {
                $addedReputation[] = $reputation;
                session()->put('addedReputation', $addedReputation);
            }
            return $gainedReputation;
        }
        return 0;
    }
    public static function getActionReputation($actionKey, $subkey = null) {
        if (!self::$REPUTATION_PER_ACTIONS) self::$REPUTATION_PER_ACTIONS = config('core.earnings.reputation');
        if (!isset(self::$REPUTATION_PER_ACTIONS[$actionKey])) return null;
        $config = self::$REPUTATION_PER_ACTIONS[$actionKey];
        if ($subkey === null) return $config;
        return $config[$subkey] ?? null;
    }
}
