<?php
namespace App\Controllers;
use App\Models\ProdiRepository;

class ProdiController
{
    private ProdiRepository $repo;

    public function __construct()
    {
        require_once __DIR__ . '/../Models/ProdiRepository.php';
        $this->repo = new ProdiRepository();
    }

    public function index()
    {
        $prodi = $this->repo->all();

        echo '<div class="d-flex justify-content-between align-items-center mb-4">';
        echo '<h2>Daftar Prodi</h2>';
        echo '<a href="?route=prodi/create" class="btn btn-primary">Tambah Data</a>';
        echo '</div>';

        echo '<table class="table table-bordered table-striped">';
        echo '<thead class="table-dark"><tr><th>Kode</th><th>Nama Prodi</th><th>Aksi</th></tr></thead>';
        echo '<tbody>';
        foreach ($prodi as $p) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($p['kode']) . '</td>';
            echo '<td>' . htmlspecialchars($p['nama']) . '</td>';
            echo '<td>
                <a href="?route=prodi/edit&id=' . $p['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                <form action="?route=prodi/delete&id=' . $p['id'] . '" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin hapus?\')">
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    }

    public function create()
    {
        echo '<h2>Tambah Prodi</h2>';
        echo '<form action="?route=prodi/store" method="POST" class="mt-3" style="max-width:500px">';
        echo '<div class="mb-3"><label class="form-label">Kode Prodi</label><input type="text" name="kode" class="form-control" required></div>';
        echo '<div class="mb-3"><label class="form-label">Nama Prodi</label><input type="text" name="nama" class="form-control" required></div>';
        echo '<button type="submit" class="btn btn-primary">Simpan</button> ';
        echo '<a href="?route=prodi" class="btn btn-secondary">Batal</a>';
        echo '</form>';
    }

    public function store()
    {
        $this->repo->create($_POST);
        header("Location: ?route=prodi");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? 0;
        $prodi = $this->repo->find($id);

        echo '<h2>Edit Prodi</h2>';
        echo '<form action="?route=prodi/update&id=' . $prodi['id'] . '" method="POST" class="mt-3" style="max-width:500px">';
        echo '<div class="mb-3"><label class="form-label">Kode Prodi</label><input type="text" name="kode" class="form-control" value="' . htmlspecialchars($prodi['kode']) . '" required></div>';
        echo '<div class="mb-3"><label class="form-label">Nama Prodi</label><input type="text" name="nama" class="form-control" value="' . htmlspecialchars($prodi['nama']) . '" required></div>';
        echo '<button type="submit" class="btn btn-primary">Update</button> ';
        echo '<a href="?route=prodi" class="btn btn-secondary">Batal</a>';
        echo '</form>';
    }

    public function update()
    {
        $id = $_GET['id'] ?? 0;
        $this->repo->update($id, $_POST);
        header("Location: ?route=prodi");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;
        $this->repo->delete($id);
        header("Location: ?route=prodi");
        exit;
    }
}
