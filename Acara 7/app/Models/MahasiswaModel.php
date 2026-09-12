<?php
namespace App\Models;
use PDO;

class MahasiswaModel {
    private PDO $db;

    public function __construct() {
        $config = require __DIR__ . '/../../config/database.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        
        $this->db = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function all() {
        // Melakukan join tabel prodi
        $stmt = $this->db->query("SELECT m.*, p.nama AS prodi_nama FROM mahasiswa m JOIN prodi p ON m.prodi_id = p.id");
        return $stmt->fetchAll();
    }
}
?>