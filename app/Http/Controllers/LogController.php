<?php

namespace App\Http\Controllers;

use Auth;

class LogController extends Controller {
    CONST DEVICE_SETUP = __('log.logs.device_setup'); // When player is created
    const LOGGED_IN = __('log.logs.logged_in'); // When player logs into a device
    const SECURITY_ALERT = __('log.logs.security_alert'); // When player logs into a bank account
    const DOWNLOADING = __('log.logs.downloading'); // When hacker downloads an app
    const UPLOADING = __('log.logs.uploading'); // When user uploads an app to someone
    const ACCESSED = __('log.logs.accessed'); // When auth user logs into another device
    const BYPASS = __('log.logs.bypass'); // When user bypasses a device
    const BYPASS_SUCCESSFUL = __('log.logs.bypass_successful'); // When user device bypass is successful
    const PURCHASED = __('log.logs.purchased');
    const TRANSFER = __('log.logs.transfer');
    const WITHDRAWAL = __('log.logs.withdrawal'); // When hackers transfers money to the their account
    public static function generateMessage($typeMessage, $data) {
        $message = "[" . date('Y-m-d H:i') . "] ";
        $parsedMessage = $typeMessage;
        foreach ($data as $key => $value) $parsedMessage = str_replace("%{$key}%", $value, $parsedMessage);
        $message .= $parsedMessage;
        return $message;
    }
    public static function forgetLog ($to, $log_type = null) {
        $autoAddedLogs = session()->get('autoAddedLogs');
        if (!$autoAddedLogs) return true;
        foreach ($autoAddedLogs as $key => $log) {
            if ($log['from_id'] == Auth::id() && $log['to_id'] == $to->id) {
                if (!$log_type || $log['type'] == $log_type) {
                    unset($autoAddedLogs[$key]);
                    break;
                }
            }
        }
        session()->put('autoAddedLogs', $autoAddedLogs);
    }
    public static function doLog ($log_type, $to, $data = [], $sendOnce = true) {
        $sent = false;
        $autoAddedLogs = [];
        if ($sendOnce) {
            $autoAddedLogs = session()->get('autoAddedLogs');
            if ($autoAddedLogs) {
                foreach ($autoAddedLogs as $log) {
                    if ($log['to_id'] == $to->id && $log['type'] == $log_type) {
                        $sent = true;
                        break;
                    }
                }
            }
        }
        if (!$sent) {
            UserController::addLog(LogController::generateMessage($log_type, $data),$to);
            $autoAddedLog = [
                'from_id' => Auth::id(),
                'to_id' => $to->id,
                'type' => $log_type,
            ];
            if (!$autoAddedLogs) session()->put('autoAddedLogs', [$autoAddedLog]);
            else {
                $autoAddedLogs[] = $autoAddedLog;
                session()->put('autoAddedLogs', $autoAddedLogs);
            }
        }
    }
}
