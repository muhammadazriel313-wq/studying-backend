<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Services/BukuService.php';
require_once __DIR__ . '/../Validators/buku_validator.php';

class BukuController extends Controller
{
    private BukuService $bukuService;

    public function __construct()
    {
        $this->bukuService = new BukuService();
    }

    public function index()
    {
        $buku = $this->bukuService->getAll();
        $this->view('buku/index', ['buku' => $buku]);
    }

    public function create()
    {
        $this->view('buku/create');
    }

    public function store()
    {
        $data = $_POST;
        $errors = BukuValidator::validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            $this->redirect('/buku/create');
        }

        try {
            $this->bukuService->create($data);
            $_SESSION['success'] = 'Buku berhasil ditambahkan.';
            $this->redirect('/buku');
        } catch (Exception $e) {
            $_SESSION['errors'] = ['system' => $e->getMessage()];
            $_SESSION['old'] = $data;
            $this->redirect('/buku/create');
        }
    }

    public function detail($idBuku)
    {
        try {
            $buku = $this->bukuService->getById($idBuku);
            $this->view('buku/detail', ['buku' => $buku]);
        } catch (Exception $e) {
            $_SESSION['errors'] = ['system' => $e->getMessage()];
            $this->redirect('/buku');
        }
    }

    public function edit($idBuku)
    {
        try {
            $buku = $this->bukuService->getById($idBuku);
            $this->view('buku/edit', ['buku' => $buku]);
        } catch (Exception $e) {
            $_SESSION['errors'] = ['system' => $e->getMessage()];
            $this->redirect('/buku');
        }
    }

    public function update($idBuku)
    {
        $data = $_POST;
        $data['id_buku'] = $idBuku; 
        $errors = BukuValidator::validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->redirect('/buku/edit/' . $idBuku);
        }

        try {
            $this->bukuService->update($idBuku, $data);
            $_SESSION['success'] = 'Data buku berhasil diubah.';
            $this->redirect('/buku');
        } catch (Exception $e) {
            $_SESSION['errors'] = ['system' => $e->getMessage()];
            $this->redirect('/buku/edit/' . $idBuku);
        }
    }

    public function delete($idBuku)
    {
        try {
            $this->bukuService->delete($idBuku);
            $_SESSION['success'] = 'Buku berhasil dihapus.';
        } catch (Exception $e) {
            $_SESSION['errors'] = ['system' => $e->getMessage()];
        }
        $this->redirect('/buku');
    }
}