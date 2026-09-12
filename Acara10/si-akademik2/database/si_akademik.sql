CREATE DATABASE IF NOT EXISTS si_akademik_acara10 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE si_akademik_acara10;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    prodi VARCHAR(80) NOT NULL,
    angkatan YEAR NOT NULL,
    status ENUM('aktif', 'cuti', 'lulus') NOT NULL DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO mahasiswa (nim, nama, email, prodi, angkatan, status) VALUES
('E41252253', 'Muhamad Wahyu Mahardika', 'wahyu@example.com', 'Teknik Informatika', 2025, 'aktif'),
('E41252254', 'Aryasha Yusuf Pratama', 'arya@example.com', 'Teknik Informatika', 2025, 'aktif');
