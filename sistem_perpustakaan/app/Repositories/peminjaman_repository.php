<?php

require_once __DIR__ . '/../Core/Database.php';

class PeminjamanRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Mengambil semua data peminjaman
     */
    public function getAll(): array
    {
        $sql = "
            SELECT 
                p.id_peminjaman,
                p.nim,
                p.id_buku,
                b.judul,
                p.tanggal_pinjam,
                p.tanggal_kembali,
                p.status_peminjaman
            FROM peminjaman p
            INNER JOIN buku b 
                ON p.id_buku = b.id_buku
            ORDER BY p.id_peminjaman DESC
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    /**
     * Mencari peminjaman berdasarkan ID
     */
    public function findById(int $idPeminjaman): ?array
    {
        $sql = "
            SELECT 
                p.id_peminjaman,
                p.nim,
                p.id_buku,
                b.judul,
                p.tanggal_pinjam,
                p.tanggal_kembali,
                p.status_peminjaman
            FROM peminjaman p
            INNER JOIN buku b 
                ON p.id_buku = b.id_buku
            WHERE p.id_peminjaman = :id_peminjaman
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id_peminjaman' => $idPeminjaman
        ]);

        $peminjaman = $stmt->fetch();

        return $peminjaman ?: null;
    }

    /**
     * Menghitung jumlah buku yang sedang dipinjam mahasiswa
     */
    public function countActiveByNim(string $nim): int
    {
        $sql = "
            SELECT COUNT(*) 
            FROM peminjaman
            WHERE nim = :nim
            AND status_peminjaman = 'dipinjam'
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'nim' => $nim
        ]);

        return (int) $stmt->fetchColumn();
    }

    /**
     * Menambahkan transaksi peminjaman
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO peminjaman (
                nim,
                id_buku,
                tanggal_pinjam,
                tanggal_kembali,
                status_peminjaman
            )
            VALUES (
                :nim,
                :id_buku,
                :tanggal_pinjam,
                :tanggal_kembali,
                :status_peminjaman
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nim' => $data['nim'],
            'id_buku' => $data['id_buku'],
            'tanggal_pinjam' => $data['tanggal_pinjam'],
            'tanggal_kembali' => $data['tanggal_kembali'] ?? null,
            'status_peminjaman' => $data['status_peminjaman'] ?? 'dipinjam'
        ]);
    }

    /**
     * Mengubah status menjadi dikembalikan
     */
    public function returnBook(
        int $idPeminjaman,
        string $tanggalKembali
    ): bool {
        $sql = "
            UPDATE peminjaman
            SET
                tanggal_kembali = :tanggal_kembali,
                status_peminjaman = 'dikembalikan'
            WHERE id_peminjaman = :id_peminjaman
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'tanggal_kembali' => $tanggalKembali,
            'id_peminjaman' => $idPeminjaman
        ]);
    }

    /**
     * Mengecek apakah sebuah buku sedang dipinjam
     */
    public function countActiveByBook(string $idBuku): int
    {
        $sql = "
            SELECT COUNT(*)
            FROM peminjaman
            WHERE id_buku = :id_buku
            AND status_peminjaman = 'dipinjam'
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id_buku' => $idBuku
        ]);

        return (int) $stmt->fetchColumn();
    }
}
