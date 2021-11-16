<?php

return [
    'database' => [
        'name' => 'todo',
        'username' => 'chocom01',
        'password' => '1415',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
