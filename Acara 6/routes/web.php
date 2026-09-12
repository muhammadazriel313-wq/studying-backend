<?php
$routes = [
    'GET' => [
        '/' => [
            'controller' => ['HomeController', 'index']
        ],
        '/dashboard' => [
            'controller' => ['HomeController', 'dashboard'],
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],
        '/mahasiswa' => [
            'controller' => ['MahasiswaController', 'index'],
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],
        '/login' => [
            'controller' => ['AuthController', 'loginForm']
        ],
        '/logout' => [
            'controller' => ['AuthController', 'logout']
        ]
    ],
    'POST' => [
        '/login' => [
            'controller' => ['AuthController', 'login']
        ],
    ],
];
