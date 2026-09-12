<?php

class PeminjamanMelebihi extends Exception
{
    public function __construct(
        string $message = 'Mahasiswa telah mencapai batas maksimal peminjaman.'
    ) {
        parent::__construct($message);
    }
}
