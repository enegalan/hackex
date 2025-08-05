<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Network extends Model {
    CONST NET_1 = 1;
    CONST NET_2 = 2;
    CONST NET_3 = 3;
    CONST NET_4 = 4;
    CONST NET_5 = 5;
    CONST NET_6 = 6;
    CONST NET_7 = 7;
    CONST NET_8 = 8;
    CONST NET_9 = 9;
    const NETWORKS = [
        self::NET_1 => [
            'id' => self::NET_1,
            'name' => '1G',
            'price' => 0,
            'download' => '250 Kbps',
            'upload' => '50 Kbps',
        ],
        self::NET_2 => [
            'id' => self::NET_2,
            'name' => '1GS',
            'price' => 3000,
            'download' => '500 Kbps',
            'upload' => '100 Kbps',
        ],
        self::NET_3 => [
            'id' => self::NET_3,
            'name' => '2G',
            'price' => 7000,
            'download' => '500 Kbps',
            'upload' => '100 Kbps',
        ],
        self::NET_4 => [
            'id' => self::NET_4,
            'name' => '2GS',
            'price' => 12000,
            'download' => '1 Mbps',
            'upload' => '0.2 Mbps',
        ],
        self::NET_5 => [
            'id' => self::NET_5,
            'name' => '3G',
            'price' => 20000,
            'download' => '2 Mbps',
            'upload' => '0.4 Mbps',
        ],
        self::NET_6 => [
            'id' => self::NET_6,
            'name' => '3GS',
            'price' => 30000,
            'download' => '3 Mbps',
            'upload' => '0.6 Mbps',
        ],
        self::NET_7 => [
            'id' => self::NET_7,
            'name' => '4G',
            'price' => 44000,
            'download' => '100 Mbps',
            'upload' => '50 Mbps',
        ],
        self::NET_8 => [
            'id' => self::NET_8,
            'name' => '4GS',
            'price' => 56000,
            'download' => '10 Gbps',
            'upload' => '2 Gbps',
        ],
        self::NET_9 => [
            'id' => self::NET_9,
            'name' => '5G',
            'price' => 75000,
            'download' => '14 Gbps',
            'upload' => '2.8 Gbps',
        ],
    ];
    public static function getNextLevelNetwork($network_name) {
        $found = false;
        foreach (self::NETWORKS as $platform) {
            if ($found) return $platform;
            $found = $platform['name'] === $network_name;
        }
        return null;
    }
}
