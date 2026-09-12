<?php
$routes = [
    'GET' => ['/' => ['controller' => ['MahasiswaController', 'index']],
                     '/mahasiswa/create' => ['controller' => ['MahasiswaController', 'create']], 
                     '/mahasiswa/edit' => ['controller' => ['MahasiswaController', 'edit']]],
    'POST' => ['/mahasiswa/store' => ['controller' => ['MahasiswaController', 'store']],
               '/mahasiswa/update' => ['controller' => ['MahasiswaController', 'update']], 
               '/mahasiswa/delete' => ['controller' => ['MahasiswaController', 'delete']]],
];