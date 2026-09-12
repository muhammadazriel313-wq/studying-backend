<?php
namespace App\Controllers;

require_once __DIR__ . '/../Models/MahasiswaModel.php';

use App\Models\MahasiswaModel;

class MahasiswaController
{
    public function index()
    {
        $model = new MahasiswaModel();

        try {
            $mahasiswa = $model->all();
        } catch (\PDOException $e) {
            echo '<div class="alert alert-danger">Koneksi database gagal. Pastikan database <strong>si_akademik</strong> sudah dibuat.</div>';
            return;
        }

        echo '<h2>Daftar Mahasiswa</h2>';
        echo '<table class="table table-bordered table-striped">';
        echo '<thead class="table-dark"><tr><th>NIM</th><th>Nama</th><th>Email</th><th>Prodi</th><th>Status</th></tr></thead>';
        echo '<tbody>';

        foreach ($mahasiswa as $m) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($m['nim']) . '</td>';
            echo '<td>' . htmlspecialchars($m['nama']) . '</td>';
            echo '<td>' . htmlspecialchars($m['email']) . '</td>';
            echo '<td>' . htmlspecialchars($m['prodi_nama']) . '</td>';
            echo '<td>' . htmlspecialchars($m['status'] ?? 'aktif') . '</td>'; // Tugas Mandiri
            echo '</tr>';
        }

        echo '</tbody></table>';
    }
}
?>