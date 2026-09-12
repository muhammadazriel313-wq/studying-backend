<?php
namespace App\Controllers;
use App\Core\Controller;
class HomeController extends Controller
{
    public function index(): void { echo '<h1>Sistem Informasi Akademik</h1><p>Silakan <a href="'.$this->url('/login').'">login</a> untuk mengelola data.</p>'; }
    public function dashboard(): void { if(session_status()===PHP_SESSION_NONE)session_start(); if(isset($_SESSION['flash'])){echo '<div class="alert alert-success">'.htmlspecialchars($_SESSION['flash']).'</div>';unset($_SESSION['flash']);} echo '<h1>Dashboard</h1><p>Selamat datang, '.htmlspecialchars($_SESSION['user_name']).'.</p>'; }
}
