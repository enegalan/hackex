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
            'id' => Network::NET_1,
            'name' => Network::NETWORKS[Network::NET_1]['name'],
            'download' => Network::NETWORKS[Network::NET_1]['download'],
            'upload' => Network::NETWORKS[Network::NET_1]['upload'],
            'price' => Network::NETWORKS[Network::NET_1]['price'],
        ]);
        Network::create([
            'id' => Network::NET_2,
            'name' => Network::NETWORKS[Network::NET_2]['name'],
            'download' => Network::NETWORKS[Network::NET_2]['download'],
            'upload' => Network::NETWORKS[Network::NET_2]['upload'],
            'price' => Network::NETWORKS[Network::NET_2]['price'],
        ]);
        Network::create([
            'id' => Network::NET_3,
            'name' => Network::NETWORKS[Network::NET_3]['name'],
            'download' => Network::NETWORKS[Network::NET_3]['download'],
            'upload' => Network::NETWORKS[Network::NET_3]['upload'],
            'price' => Network::NETWORKS[Network::NET_3]['price'],
        ]);
        Network::create([
            'id' => Network::NET_4,
            'name' => Network::NETWORKS[Network::NET_4]['name'],
            'download' => Network::NETWORKS[Network::NET_4]['download'],
            'upload' => Network::NETWORKS[Network::NET_4]['upload'],
            'price' => Network::NETWORKS[Network::NET_4]['price'],
        ]);
        Network::create([
            'id' => Network::NET_5,
            'name' => Network::NETWORKS[Network::NET_5]['name'],
            'download' => Network::NETWORKS[Network::NET_5]['download'],
            'upload' => Network::NETWORKS[Network::NET_5]['upload'],
            'price' => Network::NETWORKS[Network::NET_5]['price'],
        ]);
        Network::create([
            'id' => Network::NET_6,
            'name' => Network::NETWORKS[Network::NET_6]['name'],
            'download' => Network::NETWORKS[Network::NET_6]['download'],
            'upload' => Network::NETWORKS[Network::NET_6]['upload'],
            'price' => Network::NETWORKS[Network::NET_6]['price'],
        ]);
        Network::create([
            'id' => Network::NET_7,
            'name' => Network::NETWORKS[Network::NET_7]['name'],
            'download' => Network::NETWORKS[Network::NET_7]['download'],
            'upload' => Network::NETWORKS[Network::NET_7]['upload'],
            'price' => Network::NETWORKS[Network::NET_7]['price'],
        ]);
        Network::create([
            'id' => Network::NET_8,
            'name' => Network::NETWORKS[Network::NET_8]['name'],
            'download' => Network::NETWORKS[Network::NET_8]['download'],
            'upload' => Network::NETWORKS[Network::NET_8]['upload'],
            'price' => Network::NETWORKS[Network::NET_8]['price'],
        ]);
        Network::create([
            'id' => Network::NET_9,
            'name' => Network::NETWORKS[Network::NET_9]['name'],
            'download' => Network::NETWORKS[Network::NET_9]['download'],
            'upload' => Network::NETWORKS[Network::NET_9]['upload'],
            'price' => Network::NETWORKS[Network::NET_9]['price'],
        ]);
    }
}
