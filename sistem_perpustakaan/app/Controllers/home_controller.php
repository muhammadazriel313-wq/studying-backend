<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Services/BukuService.php';
require_once __DIR__ . '/../Services/PeminjamanService.php';

class HomeController extends Controller
{
    public function index()
    {
        $bukuService = new BukuService();
        $peminjamanService = new PeminjamanService();

        $buku = $bukuService->getAll();
        $peminjaman = $peminjamanService->getAll();
        
        $totalBuku = count($buku);
        $totalPeminjaman = count(array_filter($peminjaman, function($p) {
            return $p['status_peminjaman'] === 'dipinjam';
        }));

        $this->view('home/index', [
            'totalBuku' => $totalBuku,
            'totalPeminjaman' => $totalPeminjaman
        ]);
    }
}