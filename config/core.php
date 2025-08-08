<?php

use App\Models\Network;
use App\Models\Platform;

return [
    'multiplicators' => [
        'level_up' => [
            'max_savings' => env('MAX_SAVINGS_MULTIPLICATOR', 200),
            'oc' => env('OC_MULTIPLICATOR', 5),
        ],
        'bypass_success_chance' => [
            'bypasser_penalty' => [
                'from' => 0.5, // -50%
                'level_multiplicator' => 0.2,
            ],
            'equal_level_players_base' => 80,
            'level_diff' => 8, // -8% per level diff
            'min_chance' => 5,
            'max_chance' => 95,
        ],
        'crack_success_chance' => [
            'crack_penalty' => [
                'from' => 0.5, // -50%
                'level_multiplicator' => 0.2,
            ],
            'equal_level_players_base' => 80,
            'level_diff' => 8, // -8% per level diff
            'min_chance' => 5,
            'max_chance' => 95,
        ],
        'expirations' => [
            'bypass_min' => 2, // minutes
            'crack_min' => 4, // minutes
            'download_fallback' => 15, // minutes
            'download_base_size' => 50, // KB
            'upload_fallback' => 15, // minutes
            'upload_base_size' => 10, // KB
        ]
    ],
    'admin_id' => env('ADMIN_ID', 101),
    'costs' => [
        'oc' => [
            'change_ip' => 200,
            'finish_process_per_second' => 0.0111152555
        ],
        'bitcoin' => [
            'device' => 4000,
            'network' => 3000,
            'firewall' => 800,
            'bypasser' => 800,
            'password_cracker' => 1100,
            'password_encryptor' => 1100,
            'antivirus' => 1000,
            'spam' => 1400,
            'spyware' => 800,
            'notepad' => 15000,
        ],
    ],
    'max_level' => 100,
    'max_log_base_size' => 4000, // bytes
    'max_savings' => [
        Platform::RAIDER_I => 3000,
        Platform::RAIDER_II => 6000,
        Platform::RAIDER_III => 9000,
        Platform::BOLT_I => 12000,
        Platform::BOLT_II => 16000,
        Platform::BOLT_III => 32225,
        Platform::NOVA_I => 64450,
        Platform::NOVA_II => 128900,
        Platform::NOVA_III => 257800,
    ],
    'background_stages' => [
        1 => 'initial',   // Round blue
        5 => 'basic',   // Round blue with borders
        10 => 'medium',    // Round orange
        15 => 'advanced',    // Round with black and green background
        20 => 'expert',   // Upward green arrow
        30 => 'anonymous',  // Anonymous
    ],
    'earnings' => [
        'bitcoin' => [
            'spam_income_per_hour_base' => 20,
        ],
        'oc' => [
            'daily_login' => 28,
            'deposits' => [
                1 => [
                    'id' => 1,
                    'oc' => 400,
                    'value' => 10000,
                ],
                2 => [
                    'id' => 2,
                    'oc' => 1200,
                    'value' => 26000,
                ],
                3 => [
                    'id' => 3,
                    'oc' => 2000,
                    'value' => 60000,
                ],
                4 => [
                    'id' => 4,
                    'oc' => 4600,
                    'value' => 150000,
                ],
            ],
        ],
        'exp' => [
            'bypass_successful' => [
                'base' => 100,
                'level_multiplicator' => 1.25,
            ],
            'crack_successful' => [
                'base' => 500,
                'level_multiplicator' => 1.75,
            ],
            'upload_successful' => [
                'base' => 250,
                'level_multiplicator' => 1.55,
            ],
            'download_successful' => [
                'base' => 250,
                'level_multiplicator' => 1.55,
            ],
            'purchased_items' => [
                'device' => [
                    'base' => 15000,
                    'level_multiplicator' => 3.5,
                ],
                'network' => [
                    'base' => 5000,
                    'level_multiplicator' => 3.5,
                ],
                'antivirus' => [
                    'base' => 550,
                    'level_multiplicator' => 1.8,
                ],
                'spam' => [
                    'base' => 750,
                    'level_multiplicator' => 1.75,
                ],
                'spyware' => [
                    'base' => 450,
                    'level_multiplicator' => 1.8,
                ],
                'firewall' => [
                    'base' => 450,
                    'level_multiplicator' => 1.8,
                ],
                'bypasser' => [
                    'base' => 450,
                    'level_multiplicator' => 1.8,
                ],
                'password_cracker' => [
                    'base' => 900,
                    'level_multiplicator' => 1.65,
                ],
                'password_encryptor' => [
                    'base' => 900,
                    'level_multiplicator' => 1.65,
                ],
            ],
        ],
        'reputation' => [
            'bypass_successful' => [
                'base' => 150,
                'level_multiplicator' => 1.20,
                'difficult_multiplicator' => 1.05,
            ],
            'rehack_bypass_successful' => [
                'base' => 200,
                'level_multiplicator' => 1.40,
                'difficult_multiplicator' => 1.6,
            ],
            'crack_successful' => [
                'base' => 200,
                'level_multiplicator' => 1.30,
                'difficult_multiplicator' => 1.10,
            ],
            'crack_bypass_successful' => [
                'base' => 250,
                'level_multiplicator' => 1.50,
                'difficult_multiplicator' => 1.65,
            ],
            'upload_successful' => [
                'base' => 100,
                'level_multiplicator' => 1.10,
                'difficult_multiplicator' => null,
            ],
            'download_successful' => [
                'base' => 50,
                'level_multiplicator' => 1.00,
                'difficult_multiplicator' => null,
            ],
        ],
    ],
];
