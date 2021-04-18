<?php

return [
    'paths' => [
        base_path('frontend')
    ],
    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),
];
