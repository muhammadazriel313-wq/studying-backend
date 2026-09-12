<?php
class MahasiswaController extends Controller
{
    private MahasiswaModel $model;

    public function __construct()
    {
        $this->model = new MahasiswaModel(Database::getConnection());
    }

    public function index(): void
    {
        $search = trim($_GET['search'] ?? '');
        $this->view('mahasiswa/index', [
            'mahasiswa' => $this->model->all($search),
            'search'    => $search
        ]);
    }

    public function create(): void
    {
        $this->view('mahasiswa/form', [
            'title'     => 'Tambah Mahasiswa',
            'mahasiswa' => $this->emptyData(),
            'action'    => 'mahasiswa/store'
        ]);
    }

    public function store(): void
    {
        $this->persist();
    }

    public function edit(): void
    {
        $data = $this->model->find((int) ($_GET['id'] ?? 0));
        if ($data === null) {
            $this->flash('danger', 'Data mahasiswa tidak ditemukan.');
            $this->redirect();
        }

        $this->view('mahasiswa/form', [
            'title'     => 'Ubah Mahasiswa',
            'mahasiswa' => $data,
            'action'    => 'mahasiswa/update&id=' . $data['id']
        ]);
    }

    public function update(): void
    {
        $this->persist((int) ($_GET['id'] ?? 0));
    }

    public function destroy(): void
    {
        $this->model->delete((int) ($_POST['id'] ?? 0));
        $this->flash('success', 'Data mahasiswa berhasil dihapus.');
        $this->redirect();
    }

    private function persist(?int $id = null): void
    {
        $data = $this->cleanInput();
        $errors = $this->validate($data);

        if ($errors !== []) {
            $this->view('mahasiswa/form', [
                'title'     => $id ? 'Ubah Mahasiswa' : 'Tambah Mahasiswa',
                'mahasiswa' => $data,
                'action'    => $id ? 'mahasiswa/update&id=' . $id : 'mahasiswa/store',
                'errors'    => $errors
            ]);
            return;
        }

        try {
            $this->model->save($data, $id);
            $this->flash('success', $id ? 'Data mahasiswa berhasil diubah.' : 'Data mahasiswa berhasil ditambahkan.');
            $this->redirect();
        } catch (PDOException $e) {
            $this->view('mahasiswa/form', [
                'title'     => $id ? 'Ubah Mahasiswa' : 'Tambah Mahasiswa',
                'mahasiswa' => $data,
                'action'    => $id ? 'mahasiswa/update&id=' . $id : 'mahasiswa/store',
                'errors'    => ['nim' => 'NIM sudah digunakan.']
            ]);
        }
    }

    private function cleanInput(): array
    {
        return [
            'nim'      => trim($_POST['nim'] ?? ''),
            'nama'     => trim($_POST['nama'] ?? ''),
            'email'    => trim($_POST['email'] ?? ''),
            'prodi'    => trim($_POST['prodi'] ?? ''),
            'angkatan' => trim($_POST['angkatan'] ?? ''),
            'status'   => $_POST['status'] ?? 'aktif'
        ];
    }

    private function validate(array $data): array
    {
        $errors = [];
        
        if (!ctype_digit($data['nim']) || strlen($data['nim']) < 8) {
            $errors['nim'] = 'NIM harus berupa angka minimal 8 digit.';
        }
        if ($data['nama'] === '') {
            $errors['nama'] = 'Nama wajib diisi.';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Masukkan alamat email yang valid.';
        }
        if ($data['prodi'] === '') {
            $errors['prodi'] = 'Pilih program studi.';
        }
        if (!ctype_digit($data['angkatan']) || (int) $data['angkatan'] < 2000 || (int) $data['angkatan'] > (int) date('Y')) {
            $errors['angkatan'] = 'Masukkan tahun angkatan yang valid.';
        }
        if (!in_array($data['status'], ['aktif', 'cuti', 'lulus'], true)) {
            $errors['status'] = 'Status tidak valid.';
        }
        
        return $errors;
    }

    private function emptyData(): array
    {
        return [
            'nim'      => '',
            'nama'     => '',
            'email'    => '',
            'prodi'    => '',
            'angkatan' => date('Y'),
            'status'   => 'aktif'
        ];
    }
}