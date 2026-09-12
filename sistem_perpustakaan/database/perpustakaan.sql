-- Skema database perpustakaan.
CREATE DATABASE IF NOT EXISTS perpustakaan;

USE perpustakaan;

CREATE TABLE buku (
    id_buku VARCHAR(20) PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit YEAR NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    status ENUM('tersedia', 'habis') NOT NULL DEFAULT 'tersedia'
);

CREATE TABLE peminjaman (
    id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL,
    id_buku VARCHAR(20) NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE NULL,
    status_peminjaman ENUM('dipinjam', 'dikembalikan') NOT NULL DEFAULT 'dipinjam',

    CONSTRAINT fk_peminjaman_buku
        FOREIGN KEY (id_buku)
        REFERENCES buku(id_buku)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

INSERT INTO buku
(id_buku, judul, penulis, penerbit, tahun_terbit, stok, status)
VALUES
('B001', 'Pemrograman PHP Dasar', 'Andi', 'Informatika', 2023, 5, 'tersedia'),
('B002', 'Algoritma dan Struktur Data', 'Budi', 'Elex Media', 2022, 3, 'tersedia'),
('B003', 'Basis Data MySQL', 'Citra', 'Andi Publisher', 2024, 2, 'tersedia'),
('B004', 'Pemrograman Web MVC', 'Dani', 'Informatika', 2023, 1, 'tersedia'),
('B005', 'Keamanan Aplikasi Web', 'Eko', 'Gramedia', 2024, 0, 'habis');