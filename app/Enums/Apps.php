<?php

namespace App\Enums;

class Apps {
    public const APPS = [
        'device' => 'Device',
        'network' => 'Network',
        'antivirus' => 'Antivirus',
        'spam' => 'Spam',
        'spyware' => 'Spyware',
        'firewall' => 'Firewall',
        'bypasser' => 'Bypasser',
        'password_cracker' => 'Password Cracker',
        'password_encryptor' => 'Password Encryptor',
    ];
    public const DESCRIPTIONS = [
        'device' => '',
        'network' => '',
        'antivirus' => '',
        'spam' => '',
        'spyware' => '',
        'firewall' => 'The Firewall is your protector from malicious devices emaking it more difficult for attackers to access your device.',
        'bypasser' => 'The Bypasser is your tool for bypassing Firewalls and accessing other devices.',
        'password_cracker' => 'The Password Cracker is a tool used for decrypting an encrypted password.',
        'password_encryptor' => 'The Password Encryptor is your last defense from keeping a hacker from accessing your bank account.',
    ];
    public const USES = [
        'device' => '',
        'network' => '',
        'antivirus' => '',
        'spam' => '',
        'spyware' => '',
        'firewall' => 'Attackers with a Bypasser level lower than your Firewall will take longer to bypass and have lower chance of a successful hack.',
        'bypasser' => 'Devices with a Firewall level higher than your Bypasser will take longer to bypass and have lower chance of a successful hack.',
        'password_cracker' => 'A victim\'s Password Encryptor level higher than your Password Cracker level will take longer to crack.',
        'password_encryptor' => 'A Password Encryptor level higher than a hacker\'s Password Cracker level will take longer for them to crack.',
    ];
    public static function getAppName(string $app_name): string {
        return self::APPS[$app_name] ?? '';
    }
    public static function getAppDescription(string $app_name): string {
        return self::DESCRIPTIONS[$app_name] ?? '';
    }
    public static function getAppUse(string $app_name): string {
        return self::USES[$app_name] ?? '';
    }
}
