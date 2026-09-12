<?php

class BukuTidakValid extends Exception
{
    public function __construct(
        string $message = 'Data buku tidak ditemukan.'
    ) {
        parent::__construct($message);
    }
}
