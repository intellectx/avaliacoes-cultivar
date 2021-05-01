<?php

return [
    'driver' => 'argon',
    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
    ],
    'argon' => [
        'memory' => 1024,
        'threads' => 2,
        'time' => 2,
    ]
];
