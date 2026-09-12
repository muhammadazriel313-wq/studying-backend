<?php
namespace App\Controllers;

class MahasiswaController {
    public function index() {
        echo "<h1>Daftar Mahasiswa (Area Terlindungi)</h1>";
        echo "<p><a href='logout'>Logout</a></p>";
    }
}
?>
