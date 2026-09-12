<?php
namespace App\Controllers;
use App\Models\MatakuliahRepository;
use App\Models\ProdiRepository;

class MatakuliahController
{
    private MatakuliahRepository $repo;
    private ProdiRepository $prodiRepo;

    public function __construct()
    {
        require_once __DIR__ . '/../Models/MatakuliahRepository.php';
        require_once __DIR__ . '/../Models/ProdiRepository.php';
        $this->repo = new MatakuliahRepository();
        $this->prodiRepo = new ProdiRepository();
    }

    public function index()
    {
        $matakuliah = $this->repo->all();

        echo '<div class="d-flex justify-content-between align-items-center mb-4">';
        echo '<h2>Daftar Mata Kuliah</h2>';
        echo '<a href="?route=matakuliah/create" class="btn btn-primary">Tambah Data</a>';
        echo '</div>';

        echo '<table class="table table-bordered table-striped">';
        echo '<thead class="table-dark"><tr><th>Kode</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Prodi</th><th>Aksi</th></tr></thead>';
        echo '<tbody>';
        foreach ($matakuliah as $mk) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($mk['kode']) . '</td>';
            echo '<td>' . htmlspecialchars($mk['nama']) . '</td>';
            echo '<td>' . htmlspecialchars($mk['sks']) . '</td>';
            echo '<td>' . htmlspecialchars($mk['prodi_nama']) . '</td>';
            echo '<td>
                <a href="?route=matakuliah/edit&id=' . $mk['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                <form action="?route=matakuliah/delete&id=' . $mk['id'] . '" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin hapus?\')">
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    }

    public function create()
    {
        $prodiList = $this->prodiRepo->all();

        echo '<h2>Tambah Mata Kuliah</h2>';
        echo '<form action="?route=matakuliah/store" method="POST" class="mt-3" style="max-width:500px">';
        echo '<div class="mb-3"><label class="form-label">Kode</label><input type="text" name="kode" class="form-control" required></div>';
        echo '<div class="mb-3"><label class="form-label">Nama Mata Kuliah</label><input type="text" name="nama" class="form-control" required></div>';
        echo '<div class="mb-3"><label class="form-label">SKS</label><input type="number" name="sks" class="form-control" required></div>';
        echo '<div class="mb-3"><label class="form-label">Prodi</label><select name="prodi_id" class="form-select" required>';
        echo '<option value="">-- Pilih Prodi --</option>';
        foreach ($prodiList as $p) {
            echo '<option value="' . $p['id'] . '">' . htmlspecialchars($p['nama']) . '</option>';
        }
        echo '</select></div>';
        echo '<button type="submit" class="btn btn-primary">Simpan</button> ';
        echo '<a href="?route=matakuliah" class="btn btn-secondary">Batal</a>';
        echo '</form>';
    }

    public function store()
    {
        $this->repo->create($_POST);
        header("Location: ?route=matakuliah");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? 0;
        $matakuliah = $this->repo->find($id);
        $prodiList = $this->prodiRepo->all();

        echo '<h2>Edit Mata Kuliah</h2>';
        echo '<form action="?route=matakuliah/update&id=' . $matakuliah['id'] . '" method="POST" class="mt-3" style="max-width:500px">';
        echo '<div class="mb-3"><label class="form-label">Kode</label><input type="text" name="kode" class="form-control" value="' . htmlspecialchars($matakuliah['kode']) . '" required></div>';
        echo '<div class="mb-3"><label class="form-label">Nama Mata Kuliah</label><input type="text" name="nama" class="form-control" value="' . htmlspecialchars($matakuliah['nama']) . '" required></div>';
        echo '<div class="mb-3"><label class="form-label">SKS</label><input type="number" name="sks" class="form-control" value="' . htmlspecialchars($matakuliah['sks']) . '" required></div>';
        echo '<div class="mb-3"><label class="form-label">Prodi</label><select name="prodi_id" class="form-select" required>';
        echo '<option value="">-- Pilih Prodi --</option>';
        foreach ($prodiList as $p) {
            $selected = ($p['id'] == $matakuliah['prodi_id']) ? 'selected' : '';
            echo '<option value="' . $p['id'] . '" ' . $selected . '>' . htmlspecialchars($p['nama']) . '</option>';
        }
        echo '</select></div>';
        echo '<button type="submit" class="btn btn-primary">Update</button> ';
        echo '<a href="?route=matakuliah" class="btn btn-secondary">Batal</a>';
        echo '</form>';
    }

    public function update()
    {
        $id = $_GET['id'] ?? 0;
        $this->repo->update($id, $_POST);
        header("Location: ?route=matakuliah");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;
        $this->repo->delete($id);
        header("Location: ?route=matakuliah");
        exit;
    }
}
