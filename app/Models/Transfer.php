<?php

namespace App\Models;

use App\Http\Controllers\BuyOCController;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model {
    protected $fillable = [
        'user_id',
        'victim_id',
        'expires_at',
        'status',
        'type',
        'app_name',
        'app_level',
        'visible',
        'last_payment_at',
    ];
    const DOWNLOAD = 0;
    const UPLOAD = 1;
    public const WORKING = 0;
    public const SUCCESSFUL = 1;
    public function User() {
        return $this->belongsTo(User::class);
    }
    public function Victim() {
        return $this->belongsTo(User::class, 'victim_id');
    }
    public static function generateTransferFinishValueOC(Transfer $transfer) {
        $expires_at = $transfer->expires_at;
        return BuyOCController::generateFinishValueOC($expires_at);
    }
}
