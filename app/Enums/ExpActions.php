<?php

namespace App\Enums;

use App\Models\User;
use App\Notifications\LevelUpNotification;
use Auth;

class ExpActions {
    public static array $expMap = [];
    public static function buildExpMap($maxLevel = null): void {
        if (!$maxLevel) $maxLevel = config('core.max_level');
        self::$expMap = [1 => 0]; // Level 1 starts with 0 exp
        for ($level = 2; $level <= $maxLevel; $level++) {
            $expRequired = intval(100 * pow($level - 1, 1.5)); // progressive formula
            self::$expMap[$level] = self::$expMap[$level - 1] + $expRequired;
        }
    }
    public static $EXP_PER_ACTIONS;
    public static function buildExpPerActions() {
        self::$EXP_PER_ACTIONS = config('core.earnings.exp');
    }
    public static function addExp($actionKey, $subkey = null, $addOnce = true, $uniqueId = null) {
        $user = Auth::user();
        if (!$user) return false;
        $actionExp = self::getActionExp($actionKey, $subkey);
        if (!$actionExp) return false;
        $added = false;
        $addedExp = [];
        if ($addOnce) {
            $addedExp = session()->get('addedExp');
            if ($addedExp) {
                foreach ($addedExp as $log) {
                    if ($log['user_id'] == Auth::id() && $log['key'] == $actionKey && $log['subkey'] == $subkey) {
                        if ($log['id'] && $uniqueId && $log['id'] == $uniqueId) $added = true;
                        else $added = true;
                        break;
                    }
                }
            }
        }
        if (!$added) {
            $base = $actionExp['base'];
            $levelMultiplicator = $actionExp['level_multiplicator'];
            $level = 1;
            if ($actionKey === 'purchased_items' && $subkey) {
                $property = $subkey . '_level';
                $level = $user->$property ?? 1;
            } else $level = $user->level; // If not purchase, use user level
            $gainedExp = intval($base + $level * $levelMultiplicator);
            $user->exp += $gainedExp;
            $user->save();
            self::getUserLevel($user); // Ensure user level is updated and notified
            $exp = [
                'id' => $uniqueId,
                'user_id' => Auth::id(),
                'key' => $actionKey,
                'subkey' => $actionKey,
            ];
            if (!$addedExp) session()->put('addedExp', [$exp]);
            else {
                $addedExp[] = $exp;
                session()->put('addedExp', $addedExp);
            }
            return $gainedExp;
        }
        return 0;
    }
    public static function getUserLevel(User $user) {
        if (empty(self::$expMap)) self::buildExpMap();
        $exp = $user->exp;
        $level = max(array_keys(self::$expMap));
        foreach (self::$expMap as $level => $requiredExp) {
            if ($exp < $requiredExp) {
                $level = $level - 1;
                $user->level = $level;
                $user->save();
                if ($user->wasChanged('level')) {
                    $max_savings = $level * config('core.multiplicators.level_up.max_savings');
                    $user->max_savings += $max_savings;
                    $oc = $level * config('core.multiplicators.level_up.oc');
                    $user->oc += $oc;
                    // Update score
                    $user->score = $user->level * $user->reputation;
                    $user->monthly_score = $user->score;
                    $user->save();
                    $user->notify(new LevelUpNotification($level, $max_savings, $oc));
                }
                return $level;
            }
        }
        return $level;
    }
    public static function getExpToNextLevel(User $user): int {
        if (empty(self::$expMap)) self::buildExpMap();
        $exp = $user->exp;
        $level = self::getUserLevel($user);
        $nextLevel = $level + 1;
        if (!isset(self::$expMap[$nextLevel])) return 0; // Max level
        return self::$expMap[$nextLevel] - $exp;
    }
    public static function getNextLevelExpGoal(User $user): int {
        if (empty(self::$expMap)) self::buildExpMap();
        $level = self::getUserLevel($user);
        $nextLevel = $level + 1;
        if (!isset(self::$expMap[$nextLevel])) return 0; // Max level
        return self::$expMap[$nextLevel];
    }
    public static function getActionExp($actionKey, $subkey = null) {
        if (!self::$EXP_PER_ACTIONS) self::buildExpPerActions();
        if (!isset(self::$EXP_PER_ACTIONS[$actionKey])) return null;
        $config = self::$EXP_PER_ACTIONS[$actionKey];
        if ($subkey === null) return $config;
        return $config[$subkey] ?? null;
    }
}
