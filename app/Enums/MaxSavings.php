<?php

namespace App\Enums;

use App\Models\Platform;

class MaxSavings {
    public static $MAX_SAVINGS;
    public static function getMaxSaving(int $platform = Platform::RAIDER_I): int {
        if (!self::$MAX_SAVINGS) self::$MAX_SAVINGS = config('core.max_savings');
        return self::$MAX_SAVINGS[$platform] ?? 0;
    }
}
