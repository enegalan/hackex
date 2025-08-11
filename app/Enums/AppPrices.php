<?php

namespace App\Enums;

class AppPrices {
    public static $BASE_PRICES;
    public static function buildBasePrices() {
        self::$BASE_PRICES = [
            'device' => config('core.costs.bitcoin.device'),
            'network' => config('core.costs.bitcoin.network'),
            'firewall' => config('core.costs.bitcoin.firewall'),
            'bypasser' => config('core.costs.bitcoin.bypasser'),
            'password_cracker' => config('core.costs.bitcoin.password_cracker'),
            'password_encryptor' => config('core.costs.bitcoin.password_encryptor'),
            'antivirus' => config('core.costs.bitcoin.antivirus'),
            'spam' => config('core.costs.bitcoin.spam'),
            'spyware' => config('core.costs.bitcoin.spyware'),
            'notepad' => config('core.costs.bitcoin.notepad'),
        ];
    }
    public static function getBasePrices() {
        if (!self::$BASE_PRICES) self::buildBasePrices();
        return self::$BASE_PRICES;
    }
    public static function getPrice(string $app, int $level = 1): int {
        $base = self::getBasePrices()[$app] ?? 0;
        return $base * $level;
    }
}
