<?php

namespace App\Models;

use App\Http\Controllers\BuyOCController;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Crack extends Model {
    protected $fillable = [
        'user_id',
        'victim_id',
        'expires_at',
        'status',
        'visible',
        'available',
    ];
    public const WORKING = 0;
    public const SUCCESSFUL = 1;
    public function User() {
        return $this->belongsTo(User::class);
    }
    public function Victim() {
        return $this->belongsTo(User::class, 'victim_id');
    }
    public static function hasCredentials($user_id) {
        $isHacked = session()->get('isHacked');
        return !$isHacked || ($isHacked && Auth::user()->Crack()->where('victim_id', $user_id)->where('status', \App\Models\Crack::SUCCESSFUL)->exists());
    }
    public static function generateCrackFinishValueOC(Crack $crack) {
        $expires_at = $crack->expires_at;
        return BuyOCController::generateFinishValueOC($expires_at);
    }
}
