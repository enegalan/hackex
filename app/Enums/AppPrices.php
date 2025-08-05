<?php

namespace App\Enums;

class AppPrices {
    public const BASE_PRICES = [
        'device' => 4000,
        'network' => 3000,
        'firewall' => 800,
        'bypasser' => 800,
        'password_cracker' => 1100,
        'password_encryptor' => 1100,
        'antivirus' => 1000,
        'spam' => 1400,
        'spyware' => 800,
        'notepad' => 15000,
    ];

    public static function getPrice(string $app, int $level = 1): int {
        $base = self::BASE_PRICES[$app] ?? 0;
        return $base * $level;
    }
}
