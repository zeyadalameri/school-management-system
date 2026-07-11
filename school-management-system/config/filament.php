<?php

use Filament\Widgets;

return [
    'brand' => env('APP_NAME', 'نظام إدارة المدرسة'),

    'google_fonts' => null,

    'widgets' => [
        'register' => [
            Widgets\AccountWidget::class,
        ],
    ],
];
