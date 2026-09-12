<?php
namespace App\Controllers;
use App\Models\MahasiswaRepository;

class MahasiswaController
{
    private MahasiswaRepository $repo;

    public function __construct()
    {
        require_once __DIR__ . '/../Models/MahasiswaRepository.php';
        $this->repo = new MahasiswaRepository();
    }

    public function index()
    {
        $keyword = $_GET['keyword'] ?? '';

        if ($keyword !== '') {
            $mahasiswa = $this->repo->search($keyword);
        } else {
            $mahasiswa = $this->repo->all();
        }

        echo '<div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Mahasiswa</h2>
            <a href="?route=mahasiswa/create" class="btn btn-primary">Tambah Data</a>
        </div>';

        echo '<form method="GET" action="" class="mb-4">
    <div class="input-group">
        <input type="text" name="keyword" class="form-control" value="' . htmlspecialchars($keyword) . '" placeholder="Cari Nama atau NIM...">
        <button type="submit" class="btn btn-outline-secondary">Cari</button>
    </div>
</form>';

        echo '<table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr><th>NIM</th><th>Nama</th><th>Email</th><th>Prodi</th><th>Aksi</th></tr>
            </thead>
            <tbody>';
        foreach ($mahasiswa as $m) {
            echo '<tr>
                <td>' . htmlspecialchars($m['nim']) . '</td>
                <td>' . htmlspecialchars($m['nama']) . '</td>
                <td>' . htmlspecialchars($m['email']) . '</td>
                <td>' . htmlspecialchars($m['prodi_nama'] ?? '') . '</td>
                <td>
                    <a href="?route=mahasiswa/edit&id=' . $m['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                    <form action="?route=mahasiswa/delete&id=' . $m['id'] . '" method="POST" style="display:inline;" onsubmit="confirmDelete(event)">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>';
        }
        echo '</tbody></table>';
    }

    public function create()
    {
        $prodiList = $this->repo->getProdis();

        echo '<h2>Tambah Mahasiswa</h2>
        <form action="?route=mahasiswa/store" method="POST" class="mt-4">
            <div class="mb-3"><label>NIM</label><input type="text" name="nim" class="form-control" required></div>
            <div class="mb-3"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
            <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label>Prodi</label>
            <select name="prodi_id" class="form-select" required><option value="">-- Pilih Prodi --</option>';
        foreach ($prodiList as $p) {
            echo '<option value="' . $p['id'] . '">' . htmlspecialchars($p['nama']) . '</option>';
        }
        echo '</select></div>
            <div class="mb-3"><label>Angkatan</label><input type="number" name="angkatan" class="form-control" required></div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="?/" class="btn btn-secondary">Batal</a>
        </form>';
    }

    public function store()
    {
        $this->repo->create($_POST);
        header("Location: ?/");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? 0;
        $mahasiswa = $this->repo->find($id);
        $prodiList = $this->repo->getProdis();

        echo '<h2>Edit Mahasiswa</h2>
        <form action="?route=mahasiswa/update&id=' . $mahasiswa['id'] . '" method="POST" class="mt-4">
            <div class="mb-3"><label>NIM</label><input type="text" name="nim" class="form-control" value="' . htmlspecialchars($mahasiswa['nim']) . '" required></div>
            <div class="mb-3"><label>Nama</label><input type="text" name="nama" class="form-control" value="' . htmlspecialchars($mahasiswa['nama']) . '" required></div>
            <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" value="' . htmlspecialchars($mahasiswa['email']) . '" required></div>
            <div class="mb-3"><label>Prodi</label>
            <select name="prodi_id" class="form-select" required><option value="">-- Pilih Prodi --</option>';
        foreach ($prodiList as $p) {
            $selected = ($p['id'] == $mahasiswa['prodi_id']) ? 'selected' : '';
            echo '<option value="' . $p['id'] . '" ' . $selected . '>' . htmlspecialchars($p['nama']) . '</option>';
        }
        echo '</select></div>
            <div class="mb-3"><label>Angkatan</label><input type="number" name="angkatan" class="form-control" value="' . htmlspecialchars($mahasiswa['angkatan']) . '" required></div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="?/" class="btn btn-secondary">Batal</a>
        </form>';
    }

    public function update()
    {
        $id = $_GET['id'] ?? 0;
        $this->repo->update($id, $_POST);
        header("Location: ?/");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;
        $this->repo->delete($id);
        header("Location: ?/");
        exit;
    }
}
?>
