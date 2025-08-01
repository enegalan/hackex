<?php

namespace Database\Seeders;

use App\Http\Controllers\UserController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TestingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
        User::create([
            'username' => 'username',
            'email' => Hash::make(rand(0, 100)) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => 1,
            'network_id' => 1,
        ]);
    }
}
