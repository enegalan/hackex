<?php

namespace App\Enums;

class MaxLogSizes {
    public static function getMaxLogSize(int $level = 1, $formated = false): int|string {
        $baseSize = 4000; // bytes
        $logSize = $baseSize * $level;
        if ($formated) return self::formatBytesForHumans($logSize);
        return $logSize;
    }
    public static function formatBytesForHumans($bytes, $precision = 2): string {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $bytes = max(0, (float)$bytes);
        if ($bytes < 1000) {
            return $bytes . 'B';
        }
        $power = floor(log($bytes, 1000));
        $power = min($power, count($units) - 1); // do not exceed array
        $value = $bytes / pow(1000, $power);
        return round($value, $precision) . $units[$power];
    }
}
