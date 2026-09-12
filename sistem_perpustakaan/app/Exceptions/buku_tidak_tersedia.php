<?php

class BukuTidakTersedia extends Exception
{
    public function __construct(
        string $message = 'Buku tidak tersedia.'
    ) {
        parent::__construct($message);
    }
}
