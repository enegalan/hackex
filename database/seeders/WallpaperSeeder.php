<?php

namespace Database\Seeders;

use App\Models\Wallpaper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WallpaperSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Raiders
        Wallpaper::create([
            'name' => Wallpaper::RAIDER[1],
            'url' => 'wallpapers/raider_i.webp',
        ]);
        Wallpaper::create([
            'name' => Wallpaper::RAIDER[2],
            'url' => 'wallpapers/raider_ii.webp',
        ]);
        Wallpaper::create([
            'name' => Wallpaper::RAIDER[3],
            'url' => 'wallpapers/raider_iii.webp',
        ]);
        // Bolt
        Wallpaper::create([
            'name' => Wallpaper::BOLT[1],
            'url' => 'wallpapers/bolt_i.webp',
        ]);
        Wallpaper::create([
            'name' => Wallpaper::BOLT[2],
            'url' => 'wallpapers/bolt_ii.webp',
        ]);
        Wallpaper::create([
            'name' => Wallpaper::BOLT[3],
            'url' => 'wallpapers/bolt_iii.webp',
        ]);
        // Nova
        Wallpaper::create([
            'name' => Wallpaper::NOVA[1],
            'url' => 'wallpapers/nova_i.webp',
        ]);
        Wallpaper::create([
            'name' => Wallpaper::NOVA[2],
            'url' => 'wallpapers/nova_ii.webp',
        ]);
        Wallpaper::create([
            'name' => Wallpaper::NOVA[3],
            'url' => 'wallpapers/nova_iii.webp',
        ]);
    }
}
