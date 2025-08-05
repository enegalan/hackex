<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallpaper extends Model {
    const RAIDER = [
        1 => Platform::PLATFORMS[Platform::RAIDER_I]['name'],
        2 => Platform::PLATFORMS[Platform::RAIDER_II]['name'],
        3 => Platform::PLATFORMS[Platform::RAIDER_III]['name'],
    ];
    const BOLT = [
        1 => Platform::PLATFORMS[Platform::BOLT_I]['name'],
        2 => Platform::PLATFORMS[Platform::BOLT_II]['name'],
        3 => Platform::PLATFORMS[Platform::BOLT_III]['name'],
    ];
    const NOVA = [
        1 => Platform::PLATFORMS[Platform::NOVA_I]['name'],
        2 => Platform::PLATFORMS[Platform::NOVA_II]['name'],
        3 => Platform::PLATFORMS[Platform::NOVA_III]['name'],
    ];
}
