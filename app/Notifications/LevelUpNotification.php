<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class LevelUpNotification extends Notification {
    use Queueable;
    public function __construct(public int $level, public int $max_savings, public int $oc) {}
    public function via($notifiable) {
        return ['broadcast'];
    }
    public function toBroadcast($notifiable) {
        return new BroadcastMessage([
            'level' => $this->level,
            'max_savings' => $this->max_savings,
            'oc' => $this->oc,
        ]);
    }
}
