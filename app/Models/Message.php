<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'message',
        'from_hackex',
        'read',
    ];
    public function Sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function Receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
