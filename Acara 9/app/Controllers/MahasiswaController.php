<?php
namespace App\Controllers;

use App\Models\Mahasiswa;
use App\Models\MahasiswaRepository;
use InvalidArgumentException;

class MahasiswaController
{
    private MahasiswaRepository $repo;

    public function __construct(MahasiswaRepository $repo)
    {
        $this->repo = $repo;
    }

    private function url(string $path): string
    {
        return str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . $path;
    }

    public function index(): void
    {
        echo '<div class="d-flex justify-content-between align-items-center mb-4">';
        echo '<h2>Daftar Mahasiswa</h2>';
        echo '<a class="btn btn-primary" href="' . $this->url('/mahasiswa/create') . '">Tambah Mahasiswa</a>';
        echo '</div>';

        echo '<table class="table table-bordered table-striped">';
        echo '<thead class="table-dark">';
        echo '<tr><th>NIM</th><th>Nama</th><th>Email</th><th>Prodi</th><th>Angkatan</th><th>Aksi</th></tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($this->repo->all() as $data) {
            $m  = Mahasiswa::fromArray($data);
            $id = (int) $m->getId();
            echo '<tr>';
            echo '<td>' . htmlspecialchars($m->getNim()) . '</td>';
            echo '<td>' . htmlspecialchars($m->getNama()) . '</td>';
            echo '<td>' . htmlspecialchars($m->getEmail()) . '</td>';
            echo '<td>' . htmlspecialchars($data['prodi_nama']) . '</td>';
            echo '<td>' . $m->getAngkatan() . '</td>';
            echo '<td>';
            echo '<a class="btn btn-warning btn-sm" href="' . $this->url('/mahasiswa/edit?id=' . $id) . '">Edit</a> ';
            echo '<form method="POST" action="' . $this->url('/mahasiswa/delete?id=' . $id) . '" class="d-inline">';
            echo '<button class="btn btn-danger btn-sm" type="submit">Hapus</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    }

    public function create(): void
    {
        $this->form(
            'Tambah Mahasiswa',
            $this->url('/mahasiswa/store'),
            ['nim' => '', 'nama' => '', 'email' => '', 'prodi_id' => '', 'angkatan' => date('Y')]
        );
    }

    public function edit(): void
    {
        $data = $this->repo->find((int) ($_GET['id'] ?? 0));
        if (!$data) {
            echo 'Data mahasiswa tidak ditemukan.';
            return;
        }
        $this->form('Ubah Mahasiswa', $this->url('/mahasiswa/update?id=' . (int) $data['id']), $data);
    }

    private function form(string $title, string $action, array $data): void
    {
        echo '<h2>' . $title . '</h2>';
        echo '<form class="mt-4" method="POST" action="' . $action . '">';

        echo '<div class="mb-3">';
        echo '<label class="form-label">NIM</label>';
        echo '<input class="form-control" name="nim" required value="' . htmlspecialchars($data['nim']) . '">';
        echo '</div>';

        echo '<div class="mb-3">';
        echo '<label class="form-label">Nama</label>';
        echo '<input class="form-control" name="nama" required value="' . htmlspecialchars($data['nama']) . '">';
        echo '</div>';

        echo '<div class="mb-3">';
        echo '<label class="form-label">Email</label>';
        echo '<input class="form-control" type="email" name="email" required value="' . htmlspecialchars($data['email']) . '">';
        echo '</div>';

        echo '<div class="mb-3">';
        echo '<label class="form-label">Prodi</label>';
        echo '<select class="form-select" name="prodi_id" required>';
        echo '<option value="">-- Pilih Prodi --</option>';
        foreach ($this->repo->getProdis() as $prodi) {
            $selected = ((int) $data['prodi_id'] === (int) $prodi['id']) ? ' selected' : '';
            echo '<option value="' . (int) $prodi['id'] . '"' . $selected . '>' . htmlspecialchars($prodi['nama']) . '</option>';
        }
        echo '</select>';
        echo '</div>';

        echo '<div class="mb-3">';
        echo '<label class="form-label">Angkatan</label>';
        echo '<input class="form-control" type="number" name="angkatan" required value="' . htmlspecialchars((string) $data['angkatan']) . '">';
        echo '</div>';

        echo '<button class="btn btn-primary" type="submit">Simpan</button> ';
        echo '<a class="btn btn-secondary" href="' . $this->url('/') . '">Batal</a>';
        echo '</form>';
    }

    public function store(): void
    {
        $this->save(null);
    }

    public function update(): void
    {
        $this->save((int) ($_GET['id'] ?? 0));
    }

    private function save(?int $id): void
    {
        try {
            $m = new Mahasiswa(
                (string) ($_POST['nim'] ?? ''),
                (string) ($_POST['nama'] ?? ''),
                (string) ($_POST['email'] ?? ''),
                (int) ($_POST['prodi_id'] ?? 0),
                (int) ($_POST['angkatan'] ?? 0),
                $id
            );
            $id ? $this->repo->update($m) : $this->repo->create($m);
            header('Location: ' . $this->url('/'));
            exit;
        } catch (InvalidArgumentException $e) {
            echo htmlspecialchars($e->getMessage());
        }
    }

    public function delete(): void
    {
        $this->repo->delete((int) ($_GET['id'] ?? 0));
        header('Location: ' . $this->url('/'));
        exit;
    }
}