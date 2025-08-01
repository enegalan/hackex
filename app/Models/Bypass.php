<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bypass extends Model {
    protected $fillable = [
        'user_id',
        'victim_id',
        'expires_at',
        'status'
    ];
    public function User() {
        return $this->belongsTo(User::class);
    }
    public function Victim() {
        return $this->belongsTo(User::class, 'victim_id');
    }
}
