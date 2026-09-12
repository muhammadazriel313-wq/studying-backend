<?php
namespace App\Controllers;

class HomeController
{
    public function index()
    {
        echo '<h2>Halaman Home</h2>';
        echo '<p><a href="dashboard" class="btn btn-primary">Ke Dashboard (butuh login)</a></p>';
    }

    // Studi Kasus: Tambahan untuk Dashboard Admin
    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        echo '<h2>Dashboard Admin</h2>';

        // Tugas Mandiri: Menampilkan Flash Message
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-success">' . $_SESSION['flash'] . '</div>';
            unset($_SESSION['flash']);
        }

        echo '<p>Selamat datang di dashboard, <strong>' . $_SESSION['user_name'] . '</strong></p>';
        echo '<a href="logout" class="btn btn-outline-danger btn-sm">Logout</a>';
    }
}
?>