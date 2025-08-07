<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LogController extends Controller {
    CONST DEVICE_SETUP = '%username%\'s device set up successfully.'; // When player is created
    const LOGGED_IN = '%ip% logged in.'; // When player logs into a device
    const SECURITY_ALERT = 'Alert from PNT Bank: Account may be compromised. Access attempted by %ip%'; // When player logs into a bank account
    const DOWNLOADING = 'Level %app_level% %app_name% downloading to %ip%'; // When hacker downloads an app
    const UPLOADING = 'Level %app_level% %app_name% uploading to %ip%'; // When user uploads an app to someone
    const ACCESSED = 'Accessed device at %ip%'; // When auth user logs into another device
    const BYPASS = 'Bypass of device at %ip%'; // When user bypasses a device
    const BYPASS_SUCCESSFUL = 'Bypass of device at %ip% successful'; // When user device bypass is successful
    const PURCHASED = 'Purchased level %app_level% %app_name%';
    const TRANSFER = 'Transfer of %bitcoins% Cryptocoins to savings.';
    const WITHDRAWAL = 'Withdrawal of %bitcoins% Cryptocoins to account at %ip%'; // When hackers transfers money to the their account
    public static function generateMessage($typeMessage, $data) {
        $message = "[" . date('Y-m-d H:i') . "] ";
        $parsedMessage = $typeMessage;
        foreach ($data as $key => $value) {
            $parsedMessage = str_replace("%{$key}%", $value, $parsedMessage);
        }
        $message .= $parsedMessage;
        return $message;
    }
    public static function forgetLog ($to, $log_type = null) {
        $autoAddedLogs = session()->get('autoAddedLogs');
        if (!$autoAddedLogs) return true;
        foreach ($autoAddedLogs as &$log) {
            if ($log['from_id'] == Auth::id() && $log['to_id'] == $to->id) {
                if ($log_type) {
                    if ($log['type'] == $log_type) {
                        unset($log);
                    }
                } else {
                    unset($log);
                }
                break;
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
            if (!$autoAddedLogs) {
                session()->put('autoAddedLogs', [$autoAddedLog]);
            } else {
                $autoAddedLogs[] = $autoAddedLog;
                session()->put('autoAddedLogs', $autoAddedLogs);
            }
        }
    }
}
