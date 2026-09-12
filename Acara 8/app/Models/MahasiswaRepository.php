<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class MahasiswaRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function all(): array
    {
        $stmt = $this->pdo->prepare("SELECT m.*, p.nama AS prodi_nama FROM mahasiswa m JOIN prodi p ON m.prodi_id = p.id ORDER BY m.nim");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProdis(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM prodi ORDER BY nama");
        return $stmt->fetchAll();
    }

    public function search(string $keyword): array
    {
        $stmt = $this->pdo->prepare("SELECT m.*, p.nama AS prodi_nama FROM mahasiswa m LEFT JOIN prodi p ON m.prodi_id = p.id WHERE m.nama LIKE :keyword_nama OR m.nim LIKE :keyword_nim ORDER BY m.nim");
        $stmt->execute([
            'keyword_nama' => "%$keyword%",
            'keyword_nim' => "%$keyword%"
        ]);
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan) VALUES (:nim, :nama, :email, :prodi_id, :angkatan)"
        );
        $stmt->execute([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'prodi_id' => $data['prodi_id'],
            'angkatan' => $data['angkatan'],
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, prodi_id = :prodi_id, angkatan = :angkatan WHERE id = :id"
        );
        $stmt->execute([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'prodi_id' => $data['prodi_id'],
            'angkatan' => $data['angkatan'],
            'id' => $id
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
?>
