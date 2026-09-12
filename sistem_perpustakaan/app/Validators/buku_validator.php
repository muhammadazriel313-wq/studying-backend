<?php
class BukuValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        // Validasi ID Buku
        if (empty(trim($data['id_buku'] ?? ''))) {
            $errors['id_buku'] = 'ID Buku wajib diisi.';
        } elseif (strlen(trim($data['id_buku'])) > 20) {
            $errors['id_buku'] = 'ID Buku maksimal 20 karakter.';
        }

        // Validasi Judul
        if (empty(trim($data['judul'] ?? ''))) {
            $errors['judul'] = 'Judul buku wajib diisi.';
        }

        // Validasi Penulis
        if (empty(trim($data['penulis'] ?? ''))) {
            $errors['penulis'] = 'Penulis wajib diisi.';
        }

        // Validasi Penerbit
        if (empty(trim($data['penerbit'] ?? ''))) {
            $errors['penerbit'] = 'Penerbit wajib diisi.';
        }

        // Validasi Tahun Terbit
        $tahun = $data['tahun_terbit'] ?? '';

        if (empty($tahun)) {
            $errors['tahun_terbit'] = 'Tahun terbit wajib diisi.';
        } elseif (!filter_var($tahun, FILTER_VALIDATE_INT)) {
            $errors['tahun_terbit'] = 'Tahun terbit harus berupa angka.';
        }

        // Validasi Stok
        $stok = $data['stok'] ?? '';

        if ($stok === '') {
            $errors['stok'] = 'Stok wajib diisi.';
        } elseif (
            !filter_var($stok, FILTER_VALIDATE_INT) &&
            $stok !== '0' &&
            $stok !== 0
        ) {
            $errors['stok'] = 'Stok harus berupa angka.';
        } elseif ((int) $stok < 0) {
            $errors['stok'] = 'Stok tidak boleh kurang dari 0.';
        }

        return $errors;
    }
}