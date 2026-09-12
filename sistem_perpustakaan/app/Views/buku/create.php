<?php 
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
include __DIR__ . '/../layouts/header.php'; 
?>
<?php if (!empty($errors['system'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($errors['system']) ?>
    </div>
<?php endif; ?>
<?php if (!empty($errors['system'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($errors['system']) ?>
    </div>
<?php endif; ?>
<h2>Tambah Buku</h2>
<form action="<?= base_url('/buku/store') ?>" method="POST" class="form">
    <div class="form-group">
        <label>ID Buku</label>
        <input type="text" name="id_buku" value="<?= htmlspecialchars($old['id_buku'] ?? '') ?>">
        <?php if(isset($errors['id_buku'])): ?><small class="text-danger"><?= $errors['id_buku'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($old['judul'] ?? '') ?>">
        <?php if(isset($errors['judul'])): ?><small class="text-danger"><?= $errors['judul'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Penulis</label>
        <input type="text" name="penulis" value="<?= htmlspecialchars($old['penulis'] ?? '') ?>">
        <?php if(isset($errors['penulis'])): ?><small class="text-danger"><?= $errors['penulis'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Penerbit</label>
        <input type="text" name="penerbit" value="<?= htmlspecialchars($old['penerbit'] ?? '') ?>">
        <?php if(isset($errors['penerbit'])): ?><small class="text-danger"><?= $errors['penerbit'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="<?= htmlspecialchars($old['tahun_terbit'] ?? '') ?>">
        <?php if(isset($errors['tahun_terbit'])): ?><small class="text-danger"><?= $errors['tahun_terbit'] ?></small><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" value="<?= htmlspecialchars($old['stok'] ?? '') ?>">
        <?php if(isset($errors['stok'])): ?><small class="text-danger"><?= $errors['stok'] ?></small><?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('/buku') ?>" class="btn btn-secondary">Batal</a>
</form>
<?php include __DIR__ . '/../layouts/footer.php'; 
?>