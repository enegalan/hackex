<?php

namespace App\Http\Controllers;

use App\Enums\ExpActions;
use App\Enums\ReputationActions;
use App\Models\Transfer;
use Auth;
use Illuminate\Http\Request;

class TransferController extends Controller {
    public static function checkAndUpdateTransfer (Transfer $transfer) {
        if ($transfer->status === Transfer::WORKING && now()->greaterThanOrEqualTo($transfer->expires_at)) {
            $transfer->status = Transfer::SUCCESSFUL;
            $transfer->save();
            ExpActions::addExp($transfer->type . '_successful', null, true, 'transfer_' . $transfer->id);
            if ($transfer->type === Transfer::DOWNLOAD) {
                ReputationActions::addReputation('download_successful', null, true, 'download_' . $transfer->id);
            } elseif ($transfer->type === Transfer::UPLOAD) {
                ReputationActions::addReputation('upload_successful', null, true, 'upload_' . $transfer->id);
            }
            $app_name = $transfer->app_name;
            $app_name = $app_name . '_level';
            $level = $transfer->app_level;
            Auth::user()[$app_name] = $level;
            Auth::user()->save();
        }
        return $transfer;
    }
}
