<?php
$router->add('GET', '/', 'HomeController', 'index');

// Buku
$router->add('GET', '/buku', 'BukuController', 'index');
$router->add('GET', '/buku/create', 'BukuController', 'create');
$router->add('POST', '/buku/store', 'BukuController', 'store');
$router->add('GET', '/buku/detail/{id}', 'BukuController', 'detail');
$router->add('GET', '/buku/edit/{id}', 'BukuController', 'edit');
$router->add('POST', '/buku/update/{id}', 'BukuController', 'update');
$router->add('POST', '/buku/delete/{id}', 'BukuController', 'delete');

// Peminjaman
$router->add('GET', '/peminjaman', 'PeminjamanController', 'index');
$router->add('GET', '/peminjaman/create', 'PeminjamanController', 'create');
$router->add('POST', '/peminjaman/store', 'PeminjamanController', 'store');
$router->add('GET', '/peminjaman/detail/{id}', 'PeminjamanController', 'detail');
$router->add('POST', '/peminjaman/return/{id}', 'PeminjamanController', 'returnBook');