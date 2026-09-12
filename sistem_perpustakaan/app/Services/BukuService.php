<?php
require_once __DIR__ . '/../Repositories/buku_repository.php';
require_once __DIR__ . '/../Repositories/peminjaman_repository.php';
require_once __DIR__ . '/../Exceptions/buku_tidak_valid.php';
require_once __DIR__ . '/../Exceptions/buku_sedang_dipinjam.php';

class BukuService
{
    private BukuRepository $bukuRepository;
    private PeminjamanRepository $peminjamanRepository;

    public function __construct()
    {
        $this->bukuRepository = new BukuRepository();
        $this->peminjamanRepository = new PeminjamanRepository();
    }

    //Mengambil semua data buku
    public function getAll(): array
    {
        return $this->bukuRepository->getAll();
    }

    //Mengambil detail buku
    public function getById(string $idBuku): array
    {
        $buku = $this->bukuRepository->findById($idBuku);

        if ($buku === null) {
            throw new BukuTidakValid();
        }

        return $buku;
    }

    //Menambahkan buku baru
    public function create(array $data): bool
    {
        $idBuku = trim((string) ($data['id_buku'] ?? ''));

        if ($this->bukuRepository->findById($idBuku) !== null) {
            throw new InvalidArgumentException('ID Buku sudah digunakan. Gunakan ID Buku lain.');
        }

        $idBuku = trim((string) ($data['id_buku'] ?? ''));

        if ($this->bukuRepository->findById($idBuku) !== null) {
            throw new InvalidArgumentException('ID Buku sudah digunakan. Gunakan ID Buku lain.');
        }

        $stok = (int) $data['stok'];

        $data['status'] = $stok > 0
            ? 'tersedia'
            : 'habis';

        return $this->bukuRepository->create($data);
    }

    //Mengubah data buku
    public function update(
        string $idBuku,
        array $data
    ): bool {
    
        $buku = $this->bukuRepository->findById($idBuku);

        if ($buku === null) {
            throw new BukuTidakValid();
        }

        $stok = (int) $data['stok'];

        $data['status'] = $stok > 0
            ? 'tersedia'
            : 'habis';

        return $this->bukuRepository->update(
            $idBuku,
            $data
        );
    }

    //Menghapus buku
    public function delete(string $idBuku): bool
    {
        // 1. Pastikan buku ditemukan
        $buku = $this->bukuRepository->findById($idBuku);

        if ($buku === null) {
            throw new BukuTidakDitemukanException();
        }

        // 2. Cek apakah buku sedang dipinjam
        $jumlahDipinjam = $this->peminjamanRepository
            ->countActiveByBook($idBuku);

        if ($jumlahDipinjam > 0) {
            throw new BukuSedangDipinjam();
        }

        // 3. Hapus buku
        return $this->bukuRepository->delete($idBuku);
    }
}