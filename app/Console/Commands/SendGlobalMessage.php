<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Models\User;
use Illuminate\Console\Command;

class SendGlobalMessage extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:global {--message=}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a global message for all users';
    /**
     * Execute the console command.
     */
    public function handle() {
        $text = $this->option('message') ?? $this->ask('Write the global message.');
        if (!$text) {
            $this->error('Message can not be empty.');
            return;
        }
        $senderId = 101;
        $users = User::all();
        $bar = $this->output->createProgressBar($users->count());
        $bar->start();
        foreach ($users as $user) {
            Message::create([
                'sender_id'   => $senderId,
                'receiver_id' => $user->id,
                'message'     => $text,
                'from_hackex' => true,
            ]);
            $bar->advance();
        }
        $bar->finish();
        $this->newLine(2);
        $this->info("Message sent to {$users->count()} users.");
    }
}
