<?php
namespace App\Models;

use InvalidArgumentException;

class Mahasiswa
{
    private ?int $id = null;
    private string $nim;
    private string $nama;
    private string $email;
    private int $prodiId;
    private int $angkatan;

    public function __construct(
        string $nim,
        string $nama,
        string $email,
        int $prodiId,
        int $angkatan,
        ?int $id = null
    ) {
        $this->setId($id);
        $this->setNim($nim);
        $this->setNama($nama);
        $this->setEmail($email);
        $this->setProdiId($prodiId);
        $this->setAngkatan($angkatan);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['nim'],
            $data['nama'],
            $data['email'],
            (int) $data['prodi_id'],
            (int) $data['angkatan'],
            isset($data['id']) ? (int) $data['id'] : null
        );
    }

    public function getId(): ?int { return $this->id; }
    public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; }
    public function getEmail(): string { return $this->email; }
    public function getProdiId(): int { return $this->prodiId; }
    public function getAngkatan(): int { return $this->angkatan; }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setNim(string $nim): void
    {
        if ($nim === '' || !ctype_digit($nim)) {
            throw new InvalidArgumentException('NIM harus berupa angka.');
        }
        $this->nim = $nim;
    }

    public function setNama(string $nama): void
    {
        $nama = trim($nama);
        if ($nama === '') {
            throw new InvalidArgumentException('Nama mahasiswa tidak boleh kosong.');
        }
        $this->nama = $nama;
    }

    public function setEmail(string $email): void { $this->email = trim($email); }
    public function setProdiId(int $prodiId): void { $this->prodiId = $prodiId; }
    public function setAngkatan(int $angkatan): void { $this->angkatan = $angkatan; }
}