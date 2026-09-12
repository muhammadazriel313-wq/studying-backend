<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="header-action">
    <h2>Daftar Peminjaman</h2>
    <a href="<?= base_url('/peminjaman/create') ?>" class="btn btn-primary">Tambah Peminjaman</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($peminjaman as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['id_peminjaman']) ?></td>
            <td><?= htmlspecialchars($p['nim']) ?></td>
            <td><?= htmlspecialchars($p['id_buku']) ?></td>
            <td><?= htmlspecialchars($p['tanggal_pinjam']) ?></td>
            <td><?= htmlspecialchars($p['tanggal_kembali'] ?? '-') ?></td>
            <td>
                <span class="badge <?= $p['status_peminjaman'] === 'dipinjam' ? 'badge-warning' : 'badge-success' ?>">
                    <?= htmlspecialchars($p['status_peminjaman']) ?>
                </span>
            </td>
            <td>
                <a href="<?= base_url('/peminjaman/detail/' . $p['id_peminjaman']) ?>" class="btn btn-info btn-sm">Detail</a>
                <?php if ($p['status_peminjaman'] === 'dipinjam'): ?>
                <form action="<?= base_url('/peminjaman/return/' . $p['id_peminjaman']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Kembalikan buku ini?');">
                    <button type="submit" class="btn btn-success btn-sm">Kembalikan</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
