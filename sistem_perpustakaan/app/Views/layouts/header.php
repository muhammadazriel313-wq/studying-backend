<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-PERPUS | Sistem Informasi Perpustakaan</title>
    <!-- Use a nicer font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/assets/css/style.css') ?>">
</head>
<body>
    <div class="sidebar">
        <div class="brand">
            <div class="brand-logo">📚</div>
            <h2>PERPUSTAKAAN</h2>
            <p class="brand-subtitle">Politeknik Negeri Jember</p>
        </div>
        <ul>
            <li><a href="<?= base_url('/') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('/buku') ?>">Data Buku</a></li>
            <li><a href="<?= base_url('/peminjaman') ?>">Data Peminjaman</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Sistem Informasi Manajemen Perpustakaan</div>
            <div class="topbar-user">Admin</div>
        </div>
        <div class="container">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <strong>Sukses!</strong> <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['errors']['system'])): ?>
                <div class="alert alert-danger">
                    <strong>Error!</strong> <?= htmlspecialchars($_SESSION['errors']['system']) ?>
                </div>
                <?php unset($_SESSION['errors']['system']); ?>
            <?php endif; ?>