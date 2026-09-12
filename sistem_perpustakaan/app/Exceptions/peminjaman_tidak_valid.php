<?php

class PeminjamanTidakValid extends Exception
{
    public function __construct(
        string $message = 'Transaksi peminjaman tidak ditemukan.'
    ) {
        parent::__construct($message);
    }
}
