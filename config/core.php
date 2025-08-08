<?php

return [
    'multiplicators' => [
        'level_up' => [
            'max_savings' => env('MAX_SAVINGS_MULTIPLICATOR', 200),
            'oc' => env('OC_MULTIPLICATOR', 5),
        ],
    ],
    'admin_id' => env('ADMIN_ID', 101),
    'costs' => [
        'change_ip' => 200, // oc
    ],
    'earnings' => [
        'spam_income_per_hour_base' => 20, // bitcoins
        'daily_login' => 28, // oc
    ]
];
