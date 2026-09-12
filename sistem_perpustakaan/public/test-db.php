<?php

require_once __DIR__ . '/../app/Core/Database.php';

try {
    $db = Database::getConnection();

    echo "<h1 style='font-family: Arial; color: green;'>";
    echo "✓ Koneksi database berhasil!";
    echo "</h1>";

    echo "<p style='font-family: Arial;'>";
    echo "Database: perpustakaan";
    echo "</p>";
} catch (Exception $e) {
    echo "<h1 style='font-family: Arial; color: red;'>";
    echo "✗ Koneksi gagal!";
    echo "</h1>";

    echo "<p>";
    echo $e->getMessage();
    echo "</p>";
}