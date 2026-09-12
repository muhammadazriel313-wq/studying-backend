<?php
// routes/web.php
$routes = [
    'GET' => [
       
        '/' => ['HomeController', 'index'],
        '/mahasiswa' => ['MahasiswaController', 'index'],
        '/mahasiswa/create' => ['MahasiswaController', 'create'],
        '/login' => ['AuthController', 'loginForm'],

        '/mahasiswa/{id}' => ['MahasiswaController', 'show'],
    ],
    'POST' => [
      
        '/mahasiswa' => ['MahasiswaController', 'store'],
        '/login' => ['AuthController', 'login'],
    ],
];