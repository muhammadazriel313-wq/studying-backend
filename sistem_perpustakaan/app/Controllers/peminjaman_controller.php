<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Services/PeminjamanService.php';
require_once __DIR__ . '/../Services/BukuService.php';
require_once __DIR__ . '/../Validators/peminjaman_validator.php';

class PeminjamanController extends Controller
{
    private PeminjamanService $peminjamanService;
    private BukuService $bukuService;

    public function __construct()
    {
        $this->peminjamanService = new PeminjamanService();
        $this->bukuService = new BukuService();
    }

    public function index()
    {
        $peminjaman = $this->peminjamanService->getAll();
        $this->view('peminjaman/index', ['peminjaman' => $peminjaman]);
    }

    public function create()
    {
        $buku = $this->bukuService->getAll();
        $this->view('peminjaman/create', ['buku' => $buku]);
    }

    public function store()
    {
        $data = $_POST;
        $errors = PeminjamanValidator::validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            $this->redirect('/peminjaman/create');
        }

        try {
            $this->peminjamanService->borrow($data);
            $_SESSION['success'] = 'Peminjaman berhasil dicatat.';
            $this->redirect('/peminjaman');
        } catch (Exception $e) {
            $_SESSION['errors'] = ['system' => $e->getMessage()];
            $_SESSION['old'] = $data;
            $this->redirect('/peminjaman/create');
        }
    }

    public function detail($idPeminjaman)
    {
        try {
            $peminjaman = $this->peminjamanService->getById((int) $idPeminjaman);
            $this->view('peminjaman/detail', ['peminjaman' => $peminjaman]);
        } catch (Exception $e) {
            $_SESSION['errors'] = ['system' => $e->getMessage()];
            $this->redirect('/peminjaman');
        }
    }

    public function returnBook($idPeminjaman)
    {
        $tanggalKembali = $_POST['tanggal_kembali'] ?? date('Y-m-d');
        try {
            $this->peminjamanService->returnBook((int) $idPeminjaman, $tanggalKembali);
            $_SESSION['success'] = 'Buku berhasil dikembalikan.';
        } catch (Exception $e) {
            $_SESSION['errors'] = ['system' => $e->getMessage()];
        }
        $this->redirect('/peminjaman');
    }
}
