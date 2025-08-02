<?php

namespace App\Console\Commands;

use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PaySpamUploads extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfers:pay-spam';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pay incomes per hour for Spam uploads';
    /**
     * Execute the console command.
     */
    public function handle() {
        $now = now();
        $transfers = Transfer::where('type', Transfer::UPLOAD)
            ->where('app_name', 'spam')
            ->where(function ($q) use ($now) {
                $q->whereNull('last_payment_at')
                ->orWhere('last_payment_at', '<', $now->subHour());
            })
            ->get();
        if ($transfers->count() === 0) $this->info("No transfer incomes to be payed...");
        foreach ($transfers as $transfer) {
            $user = $transfer->user;
            $lastPayment = Carbon::parse($transfer->last_payment_at ?? $transfer->created_at ?? $now);
            $hoursWithoutPay = max(1, $lastPayment->diffInHours($now));
            $incomePerHour = calculateIncomePerHour($transfer);
            $totalIncome = $incomePerHour * $hoursWithoutPay;
            $user->checking_bitcoins += $totalIncome;
            $user->save();
            $transfer->last_payment_at = now();
            $transfer->save();
            $this->info("Paying income to user {$user->ip} with $totalIncome bitcoins by Spam Upload level {$transfer->app_level} - Transfer ID {$transfer->id} ($hoursWithoutPay h)");
        }
    }
}
