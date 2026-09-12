<?php

require_once __DIR__ . '/../Core/Database.php';

class BukuRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM buku ORDER BY judul ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    public function findById(string $idBuku): ?array
    {
        $sql = "SELECT * FROM buku WHERE id_buku = :id_buku";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_buku' => $idBuku
        ]);

        $buku = $stmt->fetch();

        return $buku ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO buku (
                id_buku,
                judul,
                penulis,
                penerbit,
                tahun_terbit,
                stok,
                status
            )
            VALUES (
                :id_buku,
                :judul,
                :penulis,
                :penerbit,
                :tahun_terbit,
                :stok,
                :status
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_buku' => $data['id_buku'],
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'tahun_terbit' => $data['tahun_terbit'],
            'stok' => $data['stok'],
            'status' => $data['status']
        ]);
    }

    public function update(string $idBuku, array $data): bool
    {
        $sql = "
            UPDATE buku
            SET
                judul = :judul,
                penulis = :penulis,
                penerbit = :penerbit,
                tahun_terbit = :tahun_terbit,
                stok = :stok,
                status = :status
            WHERE id_buku = :id_buku
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_buku' => $idBuku,
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'tahun_terbit' => $data['tahun_terbit'],
            'stok' => $data['stok'],
            'status' => $data['status']
        ]);
    }

    public function delete(string $idBuku): bool
    {
        $sql = "DELETE FROM buku WHERE id_buku = :id_buku";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_buku' => $idBuku
        ]);
    }

    public function updateStok(string $idBuku, int $stok): bool
    {
        $status = $stok > 0 ? 'tersedia' : 'habis';

        $sql = "
            UPDATE buku
            SET
                stok = :stok,
                status = :status
            WHERE id_buku = :id_buku
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_buku' => $idBuku,
            'stok' => $stok,
            'status' => $status
        ]);
    }
}
