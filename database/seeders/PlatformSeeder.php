<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Raiders
        Platform::create([
            'id' => Platform::RAIDER_I,
            'name' => Platform::PLATFORMS[Platform::RAIDER_I]['name'],
            'price' => Platform::PLATFORMS[Platform::RAIDER_I]['price'],
            'processor' => Platform::PLATFORMS[Platform::RAIDER_I]['processor'],
        ]);
        Platform::create([
            'id' => Platform::RAIDER_II,
            'name' => Platform::PLATFORMS[Platform::RAIDER_II]['name'],
            'price' => Platform::PLATFORMS[Platform::RAIDER_II]['price'],
            'processor' => Platform::PLATFORMS[Platform::RAIDER_II]['processor'],
        ]);
        Platform::create([
            'id' => Platform::RAIDER_III,
            'name' => Platform::PLATFORMS[Platform::RAIDER_III]['name'],
            'price' => Platform::PLATFORMS[Platform::RAIDER_III]['price'],
            'processor' => Platform::PLATFORMS[Platform::RAIDER_III]['processor'],
        ]);
        // Bolt
        Platform::create([
            'id' => Platform::BOLT_I,
            'name' => Platform::PLATFORMS[Platform::BOLT_I]['name'],
            'price' => Platform::PLATFORMS[Platform::BOLT_I]['price'],
            'processor' => Platform::PLATFORMS[Platform::BOLT_I]['processor'],
        ]);
        Platform::create([
            'id' => Platform::BOLT_II,
            'name' => Platform::PLATFORMS[Platform::BOLT_II]['name'],
            'price' => Platform::PLATFORMS[Platform::BOLT_II]['price'],
            'processor' => Platform::PLATFORMS[Platform::BOLT_II]['processor'],
        ]);
        Platform::create([
            'id' => Platform::BOLT_III,
            'name' => Platform::PLATFORMS[Platform::BOLT_III]['name'],
            'price' => Platform::PLATFORMS[Platform::BOLT_III]['price'],
            'processor' => Platform::PLATFORMS[Platform::BOLT_III]['processor'],
        ]);
        // Nova
        Platform::create([
            'id' => Platform::NOVA_I,
            'name' => Platform::PLATFORMS[Platform::NOVA_I]['name'],
            'price' => Platform::PLATFORMS[Platform::NOVA_I]['price'],
            'processor' => Platform::PLATFORMS[Platform::NOVA_I]['processor'],
        ]);
        Platform::create([
            'id' => Platform::NOVA_II,
            'name' => Platform::PLATFORMS[Platform::NOVA_II]['name'],
            'price' => Platform::PLATFORMS[Platform::NOVA_II]['price'],
            'processor' => Platform::PLATFORMS[Platform::NOVA_II]['processor'],
        ]);
        Platform::create([
            'id' => Platform::NOVA_III,
            'name' => Platform::PLATFORMS[Platform::NOVA_III]['name'],
            'price' => Platform::PLATFORMS[Platform::NOVA_III]['price'],
            'processor' => Platform::PLATFORMS[Platform::NOVA_III]['processor'],
        ]);
    }
}
