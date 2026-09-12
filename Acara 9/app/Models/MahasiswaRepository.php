<?php
namespace App\Models;
use App\Core\Database;
use PDO;
class MahasiswaRepository
{
    private PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getConnection();
    }

    public function all(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT m.*, p.nama AS prodi_nama FROM mahasiswa m JOIN prodi p ON p.id = m.prodi_id ORDER BY m.nim'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM mahasiswa WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function getProdis(): array
    {
        $stmt = $this->pdo->prepare('SELECT id, nama FROM prodi ORDER BY nama');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create(Mahasiswa $mahasiswa): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan) VALUES (:nim, :nama, :email, :prodi_id, :angkatan)'
        );
        $stmt->execute($this->values($mahasiswa));
    }

    public function update(Mahasiswa $mahasiswa): void
    {
        $values = $this->values($mahasiswa);
        $values['id'] = $mahasiswa->getId();
        $stmt = $this->pdo->prepare(
            'UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, prodi_id = :prodi_id, angkatan = :angkatan WHERE id = :id'
        );
        $stmt->execute($values);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM mahasiswa WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function values(Mahasiswa $m): array
    {
        return [
            'nim'      => $m->getNim(),
            'nama'     => $m->getNama(),
            'email'    => $m->getEmail(),
            'prodi_id' => $m->getProdiId(),
            'angkatan' => $m->getAngkatan(),
        ];
    }
}
