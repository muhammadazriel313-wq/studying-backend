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
    private string $status;

    public function __construct(string $nim, string $nama, string $email, int $prodiId, int $angkatan, string $status = 'aktif', ?int $id = null)
    {
        $this->setId($id); $this->setNim($nim); $this->setNama($nama); $this->setEmail($email);
        $this->setProdiId($prodiId); $this->setAngkatan($angkatan); $this->setStatus($status);
    }
    public static function fromArray(array $d): self { return new self($d['nim'], $d['nama'], $d['email'], (int)$d['prodi_id'], (int)$d['angkatan'], $d['status'] ?? 'aktif', isset($d['id']) ? (int)$d['id'] : null); }
    public function getId(): ?int { return $this->id; } public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; } public function getEmail(): string { return $this->email; }
    public function getProdiId(): int { return $this->prodiId; } public function getAngkatan(): int { return $this->angkatan; }
    public function getStatus(): string { return $this->status; }
    public function setId(?int $id): void { $this->id = $id; }
    public function setNim(string $nim): void { $nim = trim($nim); if ($nim === '' || !ctype_digit($nim)) throw new InvalidArgumentException('NIM harus berupa angka.'); $this->nim = $nim; }
    public function setNama(string $nama): void { $nama = trim($nama); if ($nama === '') throw new InvalidArgumentException('Nama mahasiswa tidak boleh kosong.'); $this->nama = $nama; }
    public function setEmail(string $email): void { $this->email = trim($email); }
    public function setProdiId(int $id): void { if ($id < 1) throw new InvalidArgumentException('Prodi wajib dipilih.'); $this->prodiId = $id; }
    public function setAngkatan(int $angkatan): void { $this->angkatan = $angkatan; }
    public function setStatus(string $status): void { if (!in_array($status, ['aktif','cuti','lulus'], true)) throw new InvalidArgumentException('Status tidak valid.'); $this->status = $status; }
}
