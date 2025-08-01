<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Network;

class NetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Network::create([
            'name' => '1G',
            'download' => '250 Kbps',
            'upload' => '50 Kbps',
            'price' => 0,
        ]);
        Network::create([
            'name' => '1GS',
            'download' => '500 Kbps',
            'upload' => '100 Kbps',
            'price' => 3000,
        ]);
        Network::create([
            'name' => '2G',
            'download' => '500 Kbps',
            'upload' => '100 Kbps',
            'price' => 7000,
        ]);
        Network::create([
            'name' => '2GS',
            'download' => '1 Mbps',
            'upload' => '0.2 Mbps',
            'price' => 12000,
        ]);
        Network::create([
            'name' => '3G',
            'download' => '2 Mbps',
            'upload' => '0.4 Mbps',
            'price' => 20000,
        ]);
        Network::create([
            'name' => '3GS',
            'download' => '3 Mbps',
            'upload' => '0.6 Mbps',
            'price' => 30000,
        ]);
        Network::create([
            'name' => '4G',
            'download' => '100 Mbps',
            'upload' => '50 Mbps',
            'price' => 44000,
        ]);
        Network::create([
            'name' => '4GS',
            'download' => '10 Gbps',
            'upload' => '2 Gbps',
            'price' => 56000,
        ]);
        Network::create([
            'name' => '5G',
            'download' => '14 Gbps',
            'upload' => '2.8 Gbps',
            'price' => 75000,
        ]);
    }
}
