<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Friendship extends Model {
    protected $fillable = [
        'user_id',
        'friend_id',
        'accepted',
    ];
    public function User(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Friend(): BelongsTo {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
