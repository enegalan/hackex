<?php

namespace App\Enums;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ExpActions {
    // Mapa con experiencia acumulada necesaria por nivel (del 1 al 100)
    public static array $expMap = [];

    // Genera el mapa de experiencia necesaria para cada nivel
    public static function buildExpMap(int $maxLevel = 100): void
    {
        self::$expMap = [1 => 0]; // Nivel 1 comienza en 0 exp
        for ($level = 2; $level <= $maxLevel; $level++) {
            $expRequired = intval(100 * pow($level - 1, 1.5)); // fórmula progresiva
            self::$expMap[$level] = self::$expMap[$level - 1] + $expRequired;
        }
    }
    const EXP_PER_ACTIONS = [
        'bypass_successful' => [
            'base' => 100,
            'level_multiplicator' => 0.25,
        ],
        'crack_successful' => [
            'base' => 500,
            'level_multiplicator' => 0.75,
        ],
        'upload_successful' => [
            'base' => 250,
            'level_multiplicator' => 0.55,
        ],
        'download_successful' => [
            'base' => 250,
            'level_multiplicator' => 0.55,
        ],
        'purchased_items' => [
            'device' => [
                'base' => 15000,
                'level_multiplicator' => 2.5,
            ],
            'network' => [
                'base' => 5000,
                'level_multiplicator' => 2.5,
            ],
            'antivirus' => [
                'base' => 550,
                'level_multiplicator' => 0.8,
            ],
            'spam' => [
                'base' => 750,
                'level_multiplicator' => 0.75,
            ],
            'spyware' => [
                'base' => 450,
                'level_multiplicator' => 0.8,
            ],
            'firewall' => [
                'base' => 450,
                'level_multiplicator' => 0.8,
            ],
            'bypasser' => [
                'base' => 450,
                'level_multiplicator' => 0.8,
            ],
            'password_cracker' => [
                'base' => 900,
                'level_multiplicator' => 0.65,
            ],
            'password_encryptor' => [
                'base' => 900,
                'level_multiplicator' => 0.65,
            ],
        ]
    ];
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
            $base = $actionExp['base'];
            $levelMultiplicator = $actionExp['level_multiplicator'];
            $level = 1;
            if ($actionKey === 'purchase_items' && $subkey) {
                $property = $subkey . '_level';
                $level = $user->$property ?? 1;
            } else {
                $level = $user->level; // If not purchase, use user level
            }
            $gainedExp = intval($base + $level * $levelMultiplicator);
            $user->exp += $gainedExp;
            $user->save();
            $exp = [
                'id' => $uniqueId,
                'user_id' => Auth::id(),
                'key' => $actionKey,
                'subkey' => $actionKey,
            ];
            if (!$addedExp) {
                session()->put('addedExp', [$exp]);
            } else {
                $addedExp[] = $exp;
                session()->put('addedExp', $addedExp);
            }
            return $gainedExp;
        }
        return 0;
    }
    public static function getUserLevel(User $user) {
        if (empty(self::$expMap)) {
            self::buildExpMap();
        }
        $exp = $user->exp;
        $level = max(array_keys(self::$expMap));
        foreach (self::$expMap as $level => $requiredExp) {
            if ($exp < $requiredExp) {
                $level = $level - 1;
                $user->level = $level;
                $user->save();
                return $level;
            }
        }
        return $level;
    }
    public static function getExpToNextLevel(User $user): int {
        if (empty(self::$expMap)) {
            self::buildExpMap();
        }
        $exp = $user->exp;
        $level = self::getUserLevel($user);
        $nextLevel = $level + 1;
        if (!isset(self::$expMap[$nextLevel])) {
            return 0; // Max level
        }
        return self::$expMap[$nextLevel] - $exp;
    }
    public static function getNextLevelExpGoal(User $user): int {
        if (empty(self::$expMap)) {
            self::buildExpMap();
        }
        $level = self::getUserLevel($user);
        $nextLevel = $level + 1;
        if (!isset(self::$expMap[$nextLevel])) {
            return 0; // Max level
        }
        return self::$expMap[$nextLevel];
    }
    public static function getActionExp($actionKey, $subkey = null) {
        if (!isset(self::EXP_PER_ACTIONS[$actionKey])) return null;
        $config = self::EXP_PER_ACTIONS[$actionKey];
        if ($subkey === null) return $config;
        return $config[$subkey] ?? null;
    }
}
