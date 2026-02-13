<?php

return [
    'position' => env('TOAST_POSITION', 'bottom-right'),

    'expand' => env('TOAST_EXPAND', false),

    'visible_toasts' => (int) env('TOAST_VISIBLE_TOASTS', 3),

    'theme' => env('TOAST_THEME', 'light'),

    'rich_colors' => env('TOAST_RICH_COLORS', true),

    'close_button' => env('TOAST_CLOSE_BUTTON', false),

    'offset' => env('TOAST_OFFSET', 32),

    'mobile_offset' => env('TOAST_MOBILE_OFFSET', 16),

    'gap' => (int) env('TOAST_GAP', 14),

    'duration' => (int) env('TOAST_DURATION', 4000),

    'dismissible' => env('TOAST_DISMISSIBLE', true),

    'container_aria_label' => env('TOAST_ARIA_LABEL', 'Notifications'),

    'positions' => [
        'top-left',
        'top-center',
        'top-right',
        'bottom-left',
        'bottom-center',
        'bottom-right',
    ],
];
