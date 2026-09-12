<?php

class Buku
{
    private string $idBuku;
    private string $judul;
    private string $penulis;
    private string $penerbit;
    private int $tahunTerbit;
    private int $stok;
    private string $status;

    public function __construct(
        string $idBuku,
        string $judul,
        string $penulis,
        string $penerbit,
        int $tahunTerbit,
        int $stok,
        string $status
    ) {
        $this->idBuku = $idBuku;
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->tahunTerbit = $tahunTerbit;
        $this->stok = $stok;
        $this->status = $status;
    }

    public function getIdBuku(): string
    {
        return $this->idBuku;
    }

    public function getJudul(): string
    {
        return $this->judul;
    }

    public function getPenulis(): string
    {
        return $this->penulis;
    }

    public function getPenerbit(): string
    {
        return $this->penerbit;
    }

    public function getTahunTerbit(): int
    {
        return $this->tahunTerbit;
    }

    public function getStok(): int
    {
        return $this->stok;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}