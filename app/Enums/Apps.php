<?php

namespace App\Enums;

class Apps {
    public static $APPS;
    public static $DESCRIPTIONS;
    public static $USES;
    public static function buildApps() {
        self::$APPS = [
            'device' => __('apps.device'),
            'network' => __('apps.network'),
            'antivirus' => __('apps.antivirus'),
            'spam' => __('apps.spam'),
            'spyware' => __('apps.spyware'),
            'firewall' => __('apps.firewall'),
            'bypasser' => __('apps.bypasser'),
            'password_cracker' => __('apps.password_cracker'),
            'password_encryptor' => __('apps.password_encryptor'),
        ];
    }
    public static function buildDescriptions() {
        self::$DESCRIPTIONS = [
            'device' => __('apps.descriptions.device'),
            'network' => __('apps.descriptions.network'),
            'antivirus' => __('apps.descriptions.antivirus'),
            'spam' => __('apps.descriptions.spam'),
            'spyware' => __('apps.descriptions.spyware'),
            'firewall' => __('apps.descriptions.firewall'),
            'bypasser' => __('apps.descriptions.bypasser'),
            'password_cracker' => __('apps.descriptions.password_cracker'),
            'password_encryptor' => __('apps.descriptions.password_encryptor'),
        ];
    }
    public static function buildUses() {
        self::$USES = [
            'device' => __('apps.uses.device'),
            'network' => __('apps.uses.network'),
            'antivirus' => __('apps.uses.antivirus'),
            'spam' => __('apps.uses.spam'),
            'spyware' => __('apps.uses.spyware'),
            'firewall' => __('apps.uses.firewall'),
            'bypasser' => __('apps.uses.bypasser'),
            'password_cracker' => __('apps.uses.password_cracker'),
            'password_encryptor' => __('apps.uses.password_encryptor'),
        ];
    }
    public static function getAppName(string $app_name): string {
        if (!self::$APPS) self::buildApps();
        return self::$APPS[$app_name] ?? '';
    }
    public static function getAppDescription(string $app_name): string {
        if (!self::$DESCRIPTIONS) self::buildDescriptions();
        return self::$DESCRIPTIONS[$app_name] ?? '';
    }
    public static function getAppUse(string $app_name): string {
        if (!self::$USES) self::buildUses();
        return self::$USES[$app_name] ?? '';
    }
}
