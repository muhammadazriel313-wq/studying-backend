<?php

require_once __DIR__ . '/../app/Models/Mahasiswa.php';


$mahasiswa = [
    new Mahasiswa(
        "2401001",
        "Budi Santoso",
        "Teknik Informatika"
    ),

    new Mahasiswa(
        "2401002",
        "Andi Pratama",
        "Teknik Informatika"
    ),

    new Mahasiswa(
        "2401003",
        "Siti Aisyah",
        "Teknik Informatika"
    )
];


$content = __DIR__ . '/../app/Views/mahasiswa/index.php';


require_once __DIR__ . '/../app/Views/layouts/main.php';