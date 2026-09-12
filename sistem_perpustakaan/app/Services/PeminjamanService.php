<?php
require_once __DIR__ . '/../Repositories/peminjaman_repository.php';
require_once __DIR__ . '/../Repositories/buku_repository.php';
require_once __DIR__ . '/../Exceptions/buku_tidak_tersedia.php';
require_once __DIR__ . '/../Exceptions/peminjaman_melebihi.php';
require_once __DIR__ . '/../Exceptions/buku_tidak_valid.php';
require_once __DIR__ . '/../Exceptions/peminjaman_tidak_valid.php';

class PeminjamanService
{
    private PeminjamanRepository $peminjamanRepository;
    private BukuRepository $bukuRepository;

    public function __construct()
    {
        $this->peminjamanRepository = new PeminjamanRepository();
        $this->bukuRepository = new BukuRepository();
    }

    //Mengambil semua transaksi peminjaman

    public function getAll(): array
    {
        return $this->peminjamanRepository->getAll();
    }

    //Mengambil detail transaksi
    public function getById(int $idPeminjaman): array
    {
        $peminjaman = $this->peminjamanRepository
            ->findById($idPeminjaman);

        if ($peminjaman === null) {
            throw new PeminjamanTidakValid();
        }

        return $peminjaman;
    }

    //Proses peminjaman buku
    public function borrow(array $data): bool
    {
        $nim = trim($data['nim']);
        $idBuku = trim($data['id_buku']);
        $tanggalPinjam = $data['tanggal_pinjam'];
        $tanggalKembali = $data['tanggal_kembali'] ?? null;

        // 1. Cek apakah buku tersedia
        $buku = $this->bukuRepository->findById($idBuku);

        if ($buku === null) {
            throw new BukuTidakValid();
        }

        // 2. Cek stok buku
        if ((int) $buku['stok'] <= 0) {
            throw new BukuTidakTersedia();
        }

        // 3. Cek jumlah buku yang sedang dipinjam mahasiswa
        $jumlahDipinjam = $this->peminjamanRepository
            ->countActiveByNim($nim);

        if ($jumlahDipinjam >= 3) {
            throw new PeminjamanMelebihi();
        }

        // 4. Simpan transaksi peminjaman
        $berhasil = $this->peminjamanRepository->create([
            'nim' => $nim,
            'id_buku' => $idBuku,
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_kembali' => $tanggalKembali,
            'status_peminjaman' => 'dipinjam'
        ]);

        if (!$berhasil) {
            return false;
        }

        // 5. Kurangi stok buku
        $stokBaru = (int) $buku['stok'] - 1;

        $this->bukuRepository->updateStok(
            $idBuku,
            $stokBaru
        );

        // 6. Catat log peminjaman
        $this->writeLog(
            "Peminjaman berhasil | NIM: {$nim} | Buku: {$idBuku}"
        );

        return true;
    }

    //Proses pengembalian buku
    public function returnBook(
        int $idPeminjaman,
        string $tanggalKembali
    ): bool {
        // 1. Cari transaksi
        $peminjaman = $this->peminjamanRepository
            ->findById($idPeminjaman);

        if ($peminjaman === null) {
            throw new PeminjamanTidakValid();
        }

        // 2. Pastikan transaksi masih aktif
        if ($peminjaman['status_peminjaman'] === 'dikembalikan') {
            return false;
        }

        // 3. Kembalikan status transaksi
        $berhasil = $this->peminjamanRepository->returnBook(
            $idPeminjaman,
            $tanggalKembali
        );

        if (!$berhasil) {
            return false;
        }

        // 4. Ambil data buku
        $buku = $this->bukuRepository
            ->findById($peminjaman['id_buku']);

        if ($buku === null) {
            throw new BukuTidakValid();
        }

        // 5. Tambahkan stok buku
        $stokBaru = (int) $buku['stok'] + 1;

        $this->bukuRepository->updateStok(
            $peminjaman['id_buku'],
            $stokBaru
        );

        // 6. Catat log pengembalian
        $this->writeLog(
            "Pengembalian berhasil | ID Peminjaman: {$idPeminjaman} | "
            . "NIM: {$peminjaman['nim']} | Buku: {$peminjaman['id_buku']}"
        );

        return true;
    }

    // Menulis log aktivitas
    private function writeLog(string $message): void
    {
        $logDirectory = __DIR__ . '/../../logs';
        $logFile = $logDirectory . '/app.log';

        if (!is_dir($logDirectory)) {
            mkdir($logDirectory, 0777, true);
        }

        $date = date('Y-m-d H:i:s');

        file_put_contents(
            $logFile,
            "[{$date}] {$message}" . PHP_EOL,
            FILE_APPEND
        );
    }
}