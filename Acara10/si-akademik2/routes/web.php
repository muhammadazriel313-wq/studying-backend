<?php

$router->get('mahasiswa', 'MahasiswaController@index');
$router->get('mahasiswa/create', 'MahasiswaController@create');
$router->post('mahasiswa/store', 'MahasiswaController@store');
$router->get('mahasiswa/edit', 'MahasiswaController@edit');
$router->post('mahasiswa/update', 'MahasiswaController@update');
$router->post('mahasiswa/delete', 'MahasiswaController@destroy');