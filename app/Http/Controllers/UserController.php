<?php

namespace App\Http\Controllers;

use App\Enums\MaxLogSizes;
use App\Models\Bypass;
use App\Models\Crack;
use App\Models\Transfer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller {
    static function getAvailableIp() {
        $usedIps = User::pluck('ip')->toArray();
        $ip = null;
        $attempts = 0;
        $max_attempts = 5000;
        while ($attempts < $max_attempts) {
            $ip = rand(1, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(1, 254);
            if (!in_array($ip, $usedIps)) return $ip;
            $attempts++;
        }
        return $ip;
    }
    function disconnect() {
        session()->put('isHacked', false);
        $hackedUser = session()->get('hackedUser');
        session()->remove('hackedUser');
        if (!$hackedUser) return view('home');
        return redirect()->route('home')->with('access_boot', __('common.disconnect_device', ['ip' => $hackedUser->ip]));
    }
    function transfer() {
        if (session()->get('isHacked')) {
            // Transfer victim's checking_bitcoins to session user's checking_bitcoins
            $victim = session()->get('hackedUser');
            $checking_bitcoins = $victim['checking_bitcoins'];
            $auth_user = Auth::user();
            // First, set victims's checking_bitcoins to 0
            $victim['checking_bitcoins'] = 0;
            // Then, add victim's checking_bitcoins to auth_user checking_bitcoins
            $auth_user['checking_bitcoins'] += $checking_bitcoins;
            // Finaly save both models
            $victim->save();
            $auth_user->save();
            LogController::doLog(LogController::getConstant('WITHDRAWAL', $victim->locale), $victim, ['bitcoins' => $checking_bitcoins, 'ip' => $auth_user->ip]);
            return view('bank-account')->with('success', __('notifies.user.hacker_transfered', ['bitcoins' => $checking_bitcoins]));
        } else {
            // Transfer session user's checking_bitcoins to secured_bitcoins
            $user = Auth::user();
            $maxSaving = $user->max_savings;
            $currentSecured = $user->secured_bitcoins;
            // Calculate how much bitcoins can be transfered
            $spaceLeft = $maxSaving - $currentSecured;
            if ($spaceLeft <= 0) {
                return BankController::autoLoginBankAccount(['error' => __('errors.user.max_savings_limit')]);
            }
            if ($user->checking_bitcoins == 0) {
                return BankController::autoLoginBankAccount(['error' => __('errors.user.no_crypto_to_transfer')]);
            }
            // Calculate how much bitcoins will be transfered from checking
            $transferAmount = min($user->checking_bitcoins, $spaceLeft);
            // Transfer
            $user->checking_bitcoins -= $transferAmount;
            $user->secured_bitcoins += $transferAmount;
            $user->save();
            LogController::doLog(LogController::getConstant('TRANSFER', $user->locale), $user, ['bitcoins' => $transferAmount]);
            return BankController::autoLoginBankAccount(['success' => __('notifies.user.user_transfered')]);
        }
    }
    function saveLog (Request $request) {
        $log = $request->input('log');
        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);
        return self::setLog($log, $user, true);
    }
    public static function addLog ($log, $user) {
        $addedLog = $log . "\n" . $user['log'];
        return self::setLog($addedLog, $user, false);
    }
    public static function setLog ($log, $user, $notify) {
        $level = $user->notepad_level;
        $maxLength = MaxLogSizes::getMaxLogSize($level, false);
        // Truncate if exceedes limits
        if (mb_strlen($log, '8bit') > $maxLength) {
            while (mb_strlen($log, '8bit') > $maxLength) {
                $log = mb_substr($log, 0, -1);
            }
        }
        $user->log = $log;
        $success = $user->save();
        $data = [];
        if ($notify) {
            if ($success) $data['success'] = __('notifies.user.log_saved');
            else $data['error'] = __('errors.user.log_error');
        }
        return redirect()->back()->with($data);
    }
    function download (Request $request) {
        $app_name = $request->input('app_name');
        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);
        $auth_user = Auth::user();
        // For security reasons, check if auth user is allowed to download this user's apps
        if (!$auth_user->Bypass()
        ->where('victim_id', $user_id)
        ->where('status', Bypass::SUCCESSFUL)
        ->exists()) return redirect()->back()->with('error', __('errors.user.download_error'));
        $app_level = $user[$app_name.'_level'];
        $auth_user->Transfer()->create([
            'victim_id' => $user_id,
            'type' => Transfer::DOWNLOAD,
            'app_name' => $app_name,
            'app_level' => $app_level,
            'expires_at' => calculateDownloadExpiration($user, $app_name),
            'visible' => 1,
        ]);
        LogController::doLog(LogController::getConstant('DOWNLOADING', $user->locale), $user, ['app_level' => $app_level, 'app_name' => $app_name, 'ip' => $auth_user->ip], false);
        return redirect()->back()->with('message', __('notifies.user.download_started'));
    }
    function upload ($app_name, Request $request) {
        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);
        $auth_user = Auth::user();
        $app_level = $auth_user[$app_name.'_level'];
        // For security reasons, check if auth user is allowed to upload to this user's device
        if (!$auth_user->Bypass()
        ->where('victim_id', $user_id)
        ->where('status', Bypass::SUCCESSFUL)
        ->exists()) return redirect()->back()->with('error', __('errors.user.upload_error'));
        // Check if user has already uploaded this app - level
        $hasAlreadyUploaded = $auth_user->Transfer()
        ->where('victim_id', $user_id)
        ->where('type', Transfer::UPLOAD)
        ->where('app_name', $app_name)
        ->where('app_level', $app_level)->exists();
        if ($hasAlreadyUploaded) {
            $isUploading = $auth_user->Transfer()
            ->where('victim_id', $user_id)
            ->where('type', Transfer::UPLOAD)
            ->where('app_name', $app_name)
            ->where('app_level', $app_level)
            ->where('status', Transfer::WORKING)->exists();
            if ($isUploading) return redirect()->back()->with('error', __('errors.user.virus_uploading'));
            else return redirect()->back()->with('error', __('errors.user.virus_uploaded', ['level' => $app_level]));
        }
        $auth_user->Transfer()->create([
            'victim_id' => $user_id,
            'type' => Transfer::UPLOAD,
            'app_name' => $app_name,
            'app_level' => $app_level,
            'expires_at' => calculateUploadExpiration($auth_user, $app_name),
            'visible' => 1,
        ]);
        LogController::doLog(LogController::getConstant('UPLOADING'), $auth_user, ['app_level' => $app_level, 'app_name' => $app_name, 'ip' => $user->ip], false);
        return redirect()->back()->with('message', __('notifies.user.upload_started'));
    }
    function processRemove(Request $request) {
        $process_id = $request->input('process_id');
        $type = $request->input('type');
        return $this->private__processRemove($process_id, $type);
    }
    private function private__processRemove($process_id, $type, $back_return = true) {
        $model = null;
        $virtual = false;
        switch ($type) {
            case 'bypass':
                $model = Bypass::class;
                $virtual = true;
                break;
            case 'crack':
                $model = Crack::class;
                $virtual = true;
                break;
            case 'transfer':
                $model = Transfer::class;
                $virtual = true;
                break;
        }
        $process = $model::findOrFail($process_id);
        if ($process && $process->User->id == Auth::id()) {
            if (!$virtual) {
                $success = $process->delete();
            } else {
                $process['visible'] = false;
                $success = $process->save();
            }
            LogController::forgetLog($process->Victim);
            if ($back_return) {
                if ($success) {
                    return back()->with('success', __('notifies.user.process_deleted'));
                }
                return back()->with('error', __('errors.user.process_remove_error'));
            }
            return $success;
        }
        if ($back_return) return back()->with('error', __('errors.user.process_unexpected'));
        return false;
    }
    function multiProcessRemove(Request $request) {
        $data = $request->all();
        foreach ($data as $item) {
            $processId = $item['process_id'] ?? null;
            $processType = $item['process_type'] ?? null;
            if ($processId && $processType) {
                $this->private__processRemove($processId, $processType, false);
            }
        }
    }
    function processShorten(Request $request) {
        $process_id = $request->input('process_id');
        $type = $request->input('type');
        $model = null;
        switch ($type) {
            case 'bypass':
                $model = Bypass::class;
                break;
            case 'crack':
                $model = Crack::class;
                break;
            case 'transfer':
                $model = Transfer::class;
                break;
        }
        $process = $model::findOrFail($process_id);
        if ($process && $process->User->id == Auth::id()) {
            $oc_value = BuyOCController::generateFinishValueOC($process->expires_at);
            $success = BuyOCController::purchase($oc_value);
            if ($success === true) {
                $process->expires_at = now();
                $process->save();
                return back()->with('success', __('notifies.user.process_shortened'));
            } else return back()->with('error', __('errors.user.process_shorten_error'));
        }
        return back()->with('error', __('errors.user.process_unexpected'));
    }
    function processRetry(Request $request) {
        $process_id = $request->input('process_id');
        $type = $request->input('type');
        $model = null;
        switch ($type) {
            case 'bypass':
                $model = Bypass::class;
                $process = $model::findOrFail($process_id);
                $expires_at = calculateBypassExpiration($process->Victim->firewall_level, $process->User->bypasser_level);
                break;
            case 'crack':
                $model = Crack::class;
                $process = $model::findOrFail($process_id);
                $expires_at = calculateCrackExpiration($process->Victim->password_encryptor_level, $process->User->password_cracker_level);
                break;
            case 'transfer':
                $model = Transfer::class;
                $process = $model::findOrFail($process_id);
                if ($process->type === Transfer::UPLOAD) {
                    $expires_at = calculateUploadExpiration($process->Victim, $process->app_name);
                } else {
                    $expires_at = calculateDownloadExpiration($process->Victim, $process->app_name);
                }
                break;
        }
        if ($process && $process->User->id == Auth::id()) {
            $process->expires_at = $expires_at;
            $process->status = Transfer::WORKING;
            $success = $process->save();
            if ($success) return back()->with('message', __('notifies.user.process_retry'));
            else return back()->with('error', __('errors.user.process_shorten_error'));
        }
        return back()->with('error', __('errors.user.process_unexpected'));
    }
    function hackRedirect() {
        return redirect()->route('home');
    }
    function hack(Request $request) {
        $bypass_id = $request->input('process_id');
        $bypass = Bypass::findOrFail($bypass_id);
        if ($bypass && $bypass->User['id'] == Auth::id()) {
            // Check bypass status
            if ($bypass['available'] === 0) return back()->with('warning', __('errors.user.bypass_warning'));
            if ($bypass['status'] === Bypass::SUCCESSFUL) {
                LogController::doLog(LogController::getConstant('LOGGED_IN', $bypass->Victim->locale), $bypass->Victim, ['ip' => $bypass->User->ip]);
                LogController::doLog(LogController::getConstant('ACCESSED', $bypass->User->locale), $bypass->User, ['ip' => $bypass->Victim->ip]);
                return redirect()->route('home')->with(['victim_id' => $bypass->Victim['id'], 'access_boot' => __('common.access_device', ['ip' => $bypass->Victim->ip])]);
            }
        }
        return back()->with('error', __('errors.user.bypass_error'));
    }
    function changeIp(Request $request) {
        $user = Auth::user();
        $changeIpCost = config('core.costs.oc.change_ip');
        $sucess = BuyOCController::purchase($changeIpCost);
        if (!$sucess) return $sucess;
        // Change IP
        $user->ip = UserController::getAvailableIp();
        $user->save();
        // Do transfers and bypasses unavailable where user is the victim
        Transfer::where('victim_id', $user->id)->update([
            'available' => 0,
        ]);
        Bypass::where('victim_id', $user->id)->update([
            'available' => 0,
        ]);
        Crack::where('victim_id', $user->id)->update([
            'available' => 0,
        ]);
        return back()->with('success', __('notifies.user.ip_changed'));
    }
}
