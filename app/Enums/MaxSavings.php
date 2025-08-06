<?php

namespace App\Enums;

use App\Models\Platform;

class MaxSavings {
    public const MAX_SAVINGS = [
        Platform::RAIDER_I => 3000,
        Platform::RAIDER_II => 6000,
        Platform::RAIDER_III => 9000,
        Platform::BOLT_I => 12000,
        Platform::BOLT_II => 16000,
        Platform::BOLT_III => 32225,
        Platform::NOVA_I => 64450,
        Platform::NOVA_II => 128900,
        Platform::NOVA_III => 257800,
    ];
    public static function getMaxSaving(int $platform = Platform::RAIDER_I): int {
        return self::MAX_SAVINGS[$platform] ?? 0;
    }
}
