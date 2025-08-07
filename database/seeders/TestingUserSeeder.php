<?php

namespace Database\Seeders;

use App\Http\Controllers\UserController;
use App\Models\Platform;
use App\Models\Wallpaper;
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
        $platform = Platform::where('name', Wallpaper::RAIDER[1])->first();
        $wallpaper = Wallpaper::where('name', Wallpaper::RAIDER[1])->first();
        $wallpaper = Wallpaper::where('name', Wallpaper::RAIDER[1])->first();
        $user = User::create([
            'id' => 101,
            'username' =>'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
        $user = User::create([
            'username' => substr(Hash::make(rand(0, 100)), 0, 20),
            'email' => substr(Hash::make(rand(0, 100)), 0, 20) . '@gmail.com',
            'password' => Hash::make('password'),
            'ip' => UserController::getAvailableIp(),
            'platform_id' => $platform->id,
            'network_id' => 1,
        ]);
        $user->UserWallpaper()->updateOrCreate([
            'user_id' => $user->id,
            'wallpaper_id' => $wallpaper->id,
        ]);
        $user->save();
    }
}
