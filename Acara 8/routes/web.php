<?php

$routes = [
    'GET' => [
        '/' => ['controller' => ['MahasiswaController', 'index']],
        '/mahasiswa/create' => ['controller' => ['MahasiswaController', 'create']],
        '/mahasiswa/edit' => ['controller' => ['MahasiswaController', 'edit']],
        '/prodi' => ['controller' => ['ProdiController', 'index']],
        '/prodi/create' => ['controller' => ['ProdiController', 'create']],
        '/prodi/edit' => ['controller' => ['ProdiController', 'edit']],
        '/matakuliah' => ['controller' => ['MatakuliahController', 'index']],
        '/matakuliah/create' => ['controller' => ['MatakuliahController', 'create']],
        '/matakuliah/edit' => ['controller' => ['MatakuliahController', 'edit']],
    ],
    'POST' => [
        '/mahasiswa/store' => ['controller' => ['MahasiswaController', 'store']],
        '/mahasiswa/update' => ['controller' => ['MahasiswaController', 'update']],
        '/mahasiswa/delete' => ['controller' => ['MahasiswaController', 'delete']],
        '/prodi/store' => ['controller' => ['ProdiController', 'store']],
        '/prodi/update' => ['controller' => ['ProdiController', 'update']],
        '/prodi/delete' => ['controller' => ['ProdiController', 'delete']],
        '/matakuliah/store' => ['controller' => ['MatakuliahController', 'store']],
        '/matakuliah/update' => ['controller' => ['MatakuliahController', 'update']],
        '/matakuliah/delete' => ['controller' => ['MatakuliahController', 'delete']],
    ],
];
