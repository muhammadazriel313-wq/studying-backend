<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="header-action">
    <h2>Daftar Buku</h2>
    <a href="<?= base_url('/buku/create') ?>" class="btn btn-primary">Tambah Buku</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>ID Buku</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($buku as $b): ?>
        <tr>
            <td><?= htmlspecialchars($b['id_buku']) ?></td>
            <td><?= htmlspecialchars($b['judul']) ?></td>
            <td><?= htmlspecialchars($b['penulis']) ?></td>
            <td><?= htmlspecialchars($b['penerbit']) ?></td>
            <td><?= htmlspecialchars($b['tahun_terbit']) ?></td>
            <td><?= htmlspecialchars($b['stok']) ?></td>
            <td>
                <span class="badge <?= $b['status'] === 'tersedia' ? 'badge-success' : 'badge-danger' ?>">
                    <?= htmlspecialchars($b['status']) ?>
                </span>
            </td>
            <td>
                <a href="<?= base_url('/buku/detail/' . $b['id_buku']) ?>" class="btn btn-info btn-sm">Detail</a>
                <a href="<?= base_url('/buku/edit/' . $b['id_buku']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <form action="<?= base_url('/buku/delete/' . $b['id_buku']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Hapus buku ini?');">
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
