<?php

class BukuSedangDipinjam extends Exception
{
    public function __construct(
        string $message = 'Buku sedang dipinjam dan tidak boleh dihapus.'
    ) {
        parent::__construct($message);
    }
}
