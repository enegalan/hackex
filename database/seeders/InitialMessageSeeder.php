<?php

namespace Database\Seeders;

use App\Http\Controllers\MessageController;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = User::all();
        $admin_id = 101;
        foreach ($users as $user) {
            Message::create([
                'sender_id' => $admin_id,
                'receiver_id' => $user->id,
                'subject' => 'Transmission Intercepted',
                'message' => MessageController::INITIAL_MESSAGE,
                'from_hackex' => true,
            ]);
        }
        Message::create([
            'sender_id' => $admin_id,
            'receiver_id' => $admin_id,
            'subject' => 'Transmission Intercepted',
            'message' => MessageController::INITIAL_MESSAGE,
            'from_hackex' => true,
        ]);
    }
}
