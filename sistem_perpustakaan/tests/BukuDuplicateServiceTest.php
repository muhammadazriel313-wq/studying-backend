<?php
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Repositories/BukuRepository.php';
require_once __DIR__ . '/../app/Repositories/PeminjamanRepository.php';
require_once __DIR__ . '/../app/Exceptions/buku_tidak_valid.php';
require_once __DIR__ . '/../app/Exceptions/buku_sedang_dipinjam.php';
require_once __DIR__ . '/../app/Services/BukuService.php';

$service = new BukuService();
$data = [
    'id_buku' => 'B001',
    'judul' => 'Judul Baru',
    'penulis' => 'Penulis Baru',
    'penerbit' => 'Penerbit Baru',
    'tahun_terbit' => 2026,
    'stok' => 2,
];

try {
    $service->create($data);
    echo "FAIL: insert seharusnya ditolak ketika id_buku sudah ada\n";
    exit(1);
} catch (Exception $e) {
    $message = $e->getMessage();
    if (strpos($message, 'ID Buku sudah digunakan') !== false) {
        echo "PASS: duplicate id_buku ditangani dengan pesan yang jelas\n";
        exit(0);
    }

    echo "FAIL: pesan yang muncul tidak sesuai: {$message}\n";
    exit(1);
}
