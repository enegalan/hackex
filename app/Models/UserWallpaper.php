<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWallpaper extends Model {
    protected $fillable = [
        'user_id',
        'wallpaper_id',
    ];
    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Wallpaper() {
        return $this->belongsTo(Wallpaper::class);
    }
}
