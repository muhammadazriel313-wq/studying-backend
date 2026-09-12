<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2>Detail Buku</h2>
<div class="card">
    <table class="table">
        <tr>
            <th style="width: 200px;">ID Buku</th>
            <td><?= htmlspecialchars($buku['id_buku']) ?></td>
        </tr>
        <tr>
            <th>Judul</th>
            <td><?= htmlspecialchars($buku['judul']) ?></td>
        </tr>
        <tr>
            <th>Penulis</th>
            <td><?= htmlspecialchars($buku['penulis']) ?></td>
        </tr>
        <tr>
            <th>Penerbit</th>
            <td><?= htmlspecialchars($buku['penerbit']) ?></td>
        </tr>
        <tr>
            <th>Tahun Terbit</th>
            <td><?= htmlspecialchars($buku['tahun_terbit']) ?></td>
        </tr>
        <tr>
            <th>Stok</th>
            <td><?= htmlspecialchars($buku['stok']) ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="badge <?= $buku['status'] === 'tersedia' ? 'badge-success' : 'badge-danger' ?>">
                    <?= htmlspecialchars($buku['status']) ?>
                </span>
            </td>
        </tr>
    </table>
</div>
<a href="<?= base_url('/buku') ?>" class="btn btn-secondary" style="margin-top: 15px; display: inline-block;">Kembali</a>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
