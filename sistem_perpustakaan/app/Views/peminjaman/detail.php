<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2>Detail Peminjaman</h2>
<div class="card">
    <table class="table">
        <tr>
            <th style="width: 200px;">ID Peminjaman</th>
            <td><?= htmlspecialchars($peminjaman['id_peminjaman']) ?></td>
        </tr>
        <tr>
            <th>NIM</th>
            <td><?= htmlspecialchars($peminjaman['nim']) ?></td>
        </tr>
        <tr>
            <th>ID Buku</th>
            <td><?= htmlspecialchars($peminjaman['id_buku']) ?></td>
        </tr>
        <tr>
            <th>Tanggal Pinjam</th>
            <td><?= htmlspecialchars($peminjaman['tanggal_pinjam']) ?></td>
        </tr>
        <tr>
            <th>Tanggal Kembali</th>
            <td><?= htmlspecialchars($peminjaman['tanggal_kembali'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="badge <?= $peminjaman['status_peminjaman'] === 'dipinjam' ? 'badge-warning' : 'badge-success' ?>">
                    <?= htmlspecialchars($peminjaman['status_peminjaman']) ?>
                </span>
            </td>
        </tr>
    </table>
</div>
<a href="<?= base_url('/peminjaman') ?>" class="btn btn-secondary" style="margin-top: 15px; display: inline-block;">Kembali</a>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
