<?php
class PeminjamanValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        // Validasi NIM
        $nim = trim($data['nim'] ?? '');

        if ($nim === '') {
            $errors['nim'] = 'NIM wajib diisi.';
        } elseif (!preg_match('/^[0-9]+$/', $nim)) {
            $errors['nim'] = 'NIM hanya boleh berisi angka.';
        } elseif (strlen($nim) < 5 || strlen($nim) > 20) {
            $errors['nim'] = 'NIM harus terdiri dari 5 sampai 20 angka.';
        }

        // Validasi ID Buku
        $idBuku = trim($data['id_buku'] ?? '');

        if ($idBuku === '') {
            $errors['id_buku'] = 'ID Buku wajib dipilih.';
        } elseif (strlen($idBuku) > 20) {
            $errors['id_buku'] = 'ID Buku maksimal 20 karakter.';
        }

        // Validasi tanggal peminjaman
        $tanggalPinjam = $data['tanggal_pinjam'] ?? '';

        if ($tanggalPinjam === '') {
            $errors['tanggal_pinjam'] = 'Tanggal peminjaman wajib diisi.';
        } elseif (!self::isValidDate($tanggalPinjam)) {
            $errors['tanggal_pinjam'] = 'Format tanggal peminjaman tidak valid.';
        }

        // Validasi tanggal pengembalian
        $tanggalKembali = $data['tanggal_kembali'] ?? '';

        if ($tanggalKembali !== '') {
            if (!self::isValidDate($tanggalKembali)) {
                $errors['tanggal_kembali'] =
                    'Format tanggal pengembalian tidak valid.';
            } elseif (
                $tanggalPinjam !== '' &&
                self::isValidDate($tanggalPinjam) &&
                $tanggalKembali < $tanggalPinjam
            ) {
                $errors['tanggal_kembali'] =
                    'Tanggal pengembalian tidak boleh sebelum tanggal peminjaman.';
            }
        }

        return $errors;
    }

    private static function isValidDate(string $date): bool
    {
        $format = 'Y-m-d';

        $dateObject = DateTime::createFromFormat($format, $date);

        return $dateObject !== false
            && $dateObject->format($format) === $date;
    }
}