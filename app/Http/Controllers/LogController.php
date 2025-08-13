<?php

namespace App\Http\Controllers;

use Auth;
use Exception;

class LogController extends Controller {
    public static $const;
    public static function buildConstants() {
        $DEVICE_SETUP = 'log.logs.device_setup'; // When player is created
        $LOGGED_IN = 'log.logs.logged_in'; // When player logs into a device
        $SECURITY_ALERT = 'log.logs.security_alert'; // When player logs into a bank account
        $DOWNLOADING = 'log.logs.downloading'; // When hacker downloads an app
        $UPLOADING = 'log.logs.uploading'; // When user uploads an app to someone
        $ACCESSED = 'log.logs.accessed'; // When auth user logs into another device
        $BYPASS = 'log.logs.bypass'; // When user bypasses a device
        $BYPASS_SUCCESSFUL = 'log.logs.bypass_successful'; // When user device bypass is successful
        $PURCHASED = 'log.logs.purchased';
        $TRANSFER = 'log.logs.transfer';
        $WITHDRAWAL = 'log.logs.withdrawal'; // When hackers transfers money to the their account
        self::$const = [
            'DEVICE_SETUP' => $DEVICE_SETUP,
            'LOGGED_IN' => $LOGGED_IN,
            'SECURITY_ALERT' => $SECURITY_ALERT,
            'DOWNLOADING' => $DOWNLOADING,
            'UPLOADING' => $UPLOADING,
            'ACCESSED' => $ACCESSED,
            'BYPASS' => $BYPASS,
            'BYPASS_SUCCESSFUL' => $BYPASS_SUCCESSFUL,
            'PURCHASED' => $PURCHASED,
            'TRANSFER' => $TRANSFER,
            'WITHDRAWAL' => $WITHDRAWAL,
        ];
    }
    public static function getConstant($constName, $locale = null) {
        if (self::$const === null) self::buildConstants();
        if (!isset(self::$const[$constName])) throw new Exception('Non-existent log constant: ' . $constName);
        return __(self::$const[$constName], [], $locale);
    }
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
