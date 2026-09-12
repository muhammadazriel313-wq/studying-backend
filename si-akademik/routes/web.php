<?php
$auth = ['App\\Core\\Middleware\\AuthMiddleware'];
$routes = [
 'GET' => [
  '/' => ['controller'=>['HomeController','index']], '/login'=>['controller'=>['AuthController','loginForm']],
  '/dashboard'=>['controller'=>['HomeController','dashboard'],'middleware'=>$auth], '/logout'=>['controller'=>['AuthController','logout'],'middleware'=>$auth],
  '/mahasiswa'=>['controller'=>['MahasiswaController','index'],'middleware'=>$auth], '/mahasiswa/create'=>['controller'=>['MahasiswaController','create'],'middleware'=>$auth], '/mahasiswa/edit'=>['controller'=>['MahasiswaController','edit'],'middleware'=>$auth],
  '/prodi'=>['controller'=>['ProdiController','index'],'middleware'=>$auth], '/prodi/create'=>['controller'=>['ProdiController','create'],'middleware'=>$auth], '/prodi/edit'=>['controller'=>['ProdiController','edit'],'middleware'=>$auth],
  '/matakuliah'=>['controller'=>['MatakuliahController','index'],'middleware'=>$auth], '/matakuliah/create'=>['controller'=>['MatakuliahController','create'],'middleware'=>$auth], '/matakuliah/edit'=>['controller'=>['MatakuliahController','edit'],'middleware'=>$auth],
 ],
 'POST' => [
  '/login'=>['controller'=>['AuthController','login']], '/mahasiswa/store'=>['controller'=>['MahasiswaController','store'],'middleware'=>$auth], '/mahasiswa/update'=>['controller'=>['MahasiswaController','update'],'middleware'=>$auth], '/mahasiswa/delete'=>['controller'=>['MahasiswaController','delete'],'middleware'=>$auth],
  '/prodi/store'=>['controller'=>['ProdiController','store'],'middleware'=>$auth], '/prodi/update'=>['controller'=>['ProdiController','update'],'middleware'=>$auth], '/prodi/delete'=>['controller'=>['ProdiController','delete'],'middleware'=>$auth],
  '/matakuliah/store'=>['controller'=>['MatakuliahController','store'],'middleware'=>$auth], '/matakuliah/update'=>['controller'=>['MatakuliahController','update'],'middleware'=>$auth], '/matakuliah/delete'=>['controller'=>['MatakuliahController','delete'],'middleware'=>$auth],
 ]];
