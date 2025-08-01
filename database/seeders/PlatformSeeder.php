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
            'name' => 'Raider I',
            'price' => 0,
            'processor' => '1.0GHz',
        ]);
        Platform::create([
            'name' => 'Raider II',
            'price' => 4000,
            'processor' => '1.5GHz',
        ]);
        Platform::create([
            'name' => 'Raider III',
            'price' => 9000,
            'processor' => '2.25GHz',
        ]);
        // Bolt
        Platform::create([
            'name' => 'Bolt I',
            'price' => 18000,
            'processor' => '1.5GHz Dual Core',
        ]);
        Platform::create([
            'name' => 'Bolt II',
            'price' => 28000,
            'processor' => '2.25GHz Dual Core',
        ]);
        Platform::create([
            'name' => 'Bolt III',
            'price' => 40000,
            'processor' => '3.25GHz Dual Core',
        ]);
        // Nova
        Platform::create([
            'name' => 'Nova I',
            'price' => 56000,
            'processor' => '20GHz',
        ]);
        Platform::create([
            'name' => 'Nova II',
            'price' => 82000,
            'processor' => '2.75GHz Quad Core',
        ]);
        Platform::create([
            'name' => 'Nova III',
            'price' => 110000,
            'processor' => '3.75GHz Quad Core',
        ]);
    }
}
