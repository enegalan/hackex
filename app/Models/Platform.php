<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model {
    CONST RAIDER_I = 1;
    CONST RAIDER_II = 2;
    CONST RAIDER_III = 3;
    CONST BOLT_I = 4;
    CONST BOLT_II = 5;
    CONST BOLT_III = 6;
    CONST NOVA_I = 7;
    CONST NOVA_II = 8;
    CONST NOVA_III = 9;
    const PLATFORMS = [
        // Raiders
        self::RAIDER_I => [
            'id' => self::RAIDER_I,
            'name' => 'Raider I',
            'brand' => 'RAIDER',
            'price' => 0,
            'processor' => '1.0GHz',
        ],
        self::RAIDER_II => [
            'id' => self::RAIDER_II,
            'name' => 'Raider II',
            'brand' => 'RAIDER',
            'price' => 4000,
            'processor' => '1.5GHz',
        ],
        self::RAIDER_III => [
            'id' => self::RAIDER_III,
            'name' => 'Raider III',
            'brand' => 'RAIDER',
            'price' => 9000,
            'processor' => '2.25GHz',
        ],
        // Bolt
        self::BOLT_I => [
            'id' => self::BOLT_I,
            'name' => 'Bolt I',
            'brand' => 'BOLT',
            'price' => 18000,
            'processor' => '1.5GHz Dual Core',
        ],
        self::BOLT_II => [
            'id' => self::BOLT_II,
            'name' => 'Bolt II',
            'brand' => 'BOLT',
            'price' => 28000,
            'processor' => '2.25GHz Dual Core',
        ],
        self::BOLT_III => [
            'id' => self::BOLT_III,
            'name' => 'Bolt III',
            'brand' => 'BOLT',
            'price' => 40000,
            'processor' => '3.25GHz Dual Core',
        ],
        // Nova
        self::NOVA_I => [
            'id' => self::NOVA_I,
            'name' => 'Nova I',
            'brand' => 'NOVA',
            'price' => 56000,
            'processor' => '20GHz',
        ],
        self::NOVA_II => [
            'id' => self::NOVA_II,
            'name' => 'Nova II',
            'brand' => 'NOVA',
            'price' => 82000,
            'processor' => '2.75GHz Quad Core',
        ],
        self::NOVA_III => [
            'id' => self::NOVA_III,
            'name' => 'Nova III',
            'brand' => 'NOVA',
            'price' => 110000,
            'processor' => '3.75GHz Quad Core',
        ],
    ];
    public static function getNextLevelDevice($device_name) {
        $found = false;
        foreach (self::PLATFORMS as $platform) {
            if ($found) return $platform;
            $found = $platform['name'] === $device_name;
        }
        return null;
    }
}
