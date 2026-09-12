<?php
namespace App\Controllers;

class MahasiswaController
{
    // Studi Kasus: Fungsi dasar untuk rute exact match
    public function index()
    {
        echo '<h2>Daftar Mahasiswa</h2>';
        echo '<p class="text-muted">Halaman ini menampilkan daftar mahasiswa dari route <code>/mahasiswa</code>.</p>';
    }

    public function create()
    {
        echo '<h2>Form Tambah Mahasiswa</h2>';
        echo '<p class="text-muted">Halaman ini menampilkan form tambah dari route <code>/mahasiswa/create</code>.</p>';
    }

    public function store()
    {
        echo '<h2>Proses Simpan Mahasiswa</h2>';
        echo '<p class="text-muted">Halaman ini memproses POST dari route <code>/mahasiswa/store</code>.</p>';
    }

    // Tugas Mandiri: Mendukung Parameter URL Sederhana
    public function show($id)
    {
        echo '<h2>Detail Mahasiswa</h2>';
        echo '<p>ID yang diterima dari URL: <strong>' . htmlspecialchars($id) . '</strong></p>';
    }
}
