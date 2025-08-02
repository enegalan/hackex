<?php

namespace App\Enums;

class MaxSavings {
    public const MAX_SAVINGS = [
        1 => 3000,
        2 => 6000,
        3 => 9000,
        4 => 12000,
        5 => 16000,
        6 => 32225,
        7 => 64450,
        8 => 128900,
        9 => 257800,
    ];

    public static function getMaxSaving(int $platform = 1): int {
        return self::MAX_SAVINGS[$platform] ?? 0;
    }
}
