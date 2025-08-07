<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class WipeMonthlyScores extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wipe:monthly-scores';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set all monthly scores to 0';
    /**
     * Execute the console command.
     */
    public function handle() {
        $users = User::where('monthly_score', '>', '0')->get();
        if ($users->count() === 0) $this->info("No monthly scores to be set to 0...");
        foreach ($users as $user) {
            $user->monthly_score = 0;
            $user->save();
            $this->info("User {$user->ip} monthly score has been set to 0.");
        }
    }
}
