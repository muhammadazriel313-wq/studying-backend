<?php 
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
include __DIR__ . '/../layouts/header.php'; 
?>
<h2>Edit Buku</h2>
<form action="<?= base_url('/buku/update/' . $buku['id_buku']) ?>" method="POST" class="form">
    <div class="form-group">
        <label>ID Buku</label>
        <input type="text" name="id_buku" value="<?= htmlspecialchars($buku['id_buku']) ?>" disabled>
        <small class="text-muted">ID Buku tidak dapat diubah</small>
    </div>
    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($old['judul'] ?? $buku['judul']) ?>">
        <?php if(isset($errors['judul'])): ?><small class="text-danger"><?= $errors['judul'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Penulis</label>
        <input type="text" name="penulis" value="<?= htmlspecialchars($old['penulis'] ?? $buku['penulis']) ?>">
        <?php if(isset($errors['penulis'])): ?><small class="text-danger"><?= $errors['penulis'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Penerbit</label>
        <input type="text" name="penerbit" value="<?= htmlspecialchars($old['penerbit'] ?? $buku['penerbit']) ?>">
        <?php if(isset($errors['penerbit'])): ?><small class="text-danger"><?= $errors['penerbit'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="<?= htmlspecialchars($old['tahun_terbit'] ?? $buku['tahun_terbit']) ?>">
        <?php if(isset($errors['tahun_terbit'])): ?><small class="text-danger"><?= $errors['tahun_terbit'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" value="<?= htmlspecialchars($old['stok'] ?? $buku['stok']) ?>">
        <?php if(isset($errors['stok'])): ?><small class="text-danger"><?= $errors['stok'] ?></small><?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="<?= base_url('/buku') ?>" class="btn btn-secondary">Batal</a>
</form>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
