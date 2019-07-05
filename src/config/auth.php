<?php

return [
    'guards' => [
        'admin' => [
            'driver' => 'passport',
            'provider' => 'admins',
        ]
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],
];