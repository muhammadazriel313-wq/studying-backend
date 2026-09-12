<?php include __DIR__ . '/../layouts/header.php'; ?>

<h1>Dashboard</h1>
<div class="dashboard-cards">
    <div class="card">
        <h3>Total Buku</h3>
        <p><?= $totalBuku ?></p>
    </div>
    <div class="card">
        <h3>Total Peminjaman</h3>
        <p><?= $totalPeminjaman ?></p>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
