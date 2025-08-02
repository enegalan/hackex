<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bypass extends Model {
    protected $fillable = [
        'user_id',
        'victim_id',
        'expires_at',
        'status',
        'available',
    ];
    public const WORKING = 0;
    public const SUCCESSFUL = 1;
    public const FAILED = 2;
    public function User() {
        return $this->belongsTo(User::class);
    }
    public function Victim() {
        return $this->belongsTo(User::class, 'victim_id');
    }
}
