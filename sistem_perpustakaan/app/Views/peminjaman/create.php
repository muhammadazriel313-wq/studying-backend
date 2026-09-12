<?php 
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
include __DIR__ . '/../layouts/header.php'; 
?>
<h2>Tambah Peminjaman</h2>
<form action="<?= base_url('/peminjaman/store') ?>" method="POST" class="form">
    <div class="form-group">
        <label>NIM Mahasiswa</label>
        <input type="text" name="nim" value="<?= htmlspecialchars($old['nim'] ?? '') ?>">
        <?php if(isset($errors['nim'])): ?><small class="text-danger"><?= $errors['nim'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Buku</label>
        <select name="id_buku" class="form-control">
            <option value="">-- Pilih Buku --</option>
            <?php foreach($buku as $b): ?>
                <?php $selected = (($old['id_buku'] ?? '') == $b['id_buku']) ? 'selected' : ''; ?>
                <option value="<?= htmlspecialchars($b['id_buku']) ?>" <?= $selected ?>>
                    <?= htmlspecialchars($b['id_buku'] . ' - ' . $b['judul'] . ' (Stok: ' . $b['stok'] . ')') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if(isset($errors['id_buku'])): ?><small class="text-danger"><?= $errors['id_buku'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Tanggal Peminjaman</label>
        <input type="date" name="tanggal_pinjam" value="<?= htmlspecialchars($old['tanggal_pinjam'] ?? date('Y-m-d')) ?>">
        <?php if(isset($errors['tanggal_pinjam'])): ?><small class="text-danger"><?= $errors['tanggal_pinjam'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Tanggal Kembali (Estimasi)</label>
        <input type="date" name="tanggal_kembali" value="<?= htmlspecialchars($old['tanggal_kembali'] ?? '') ?>">
        <?php if(isset($errors['tanggal_kembali'])): ?><small class="text-danger"><?= $errors['tanggal_kembali'] ?></small><?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('/peminjaman') ?>" class="btn btn-secondary">Batal</a>
</form>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
