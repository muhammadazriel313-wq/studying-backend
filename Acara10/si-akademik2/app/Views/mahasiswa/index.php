<?php 
    $flash = $_SESSION['flash'] ?? null; 
    unset($_SESSION['flash']); 
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa - Acara 10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Sistem Informasi Akademik</span>
            <span class="text-white-50"></span>
        </div>
    </nav>
    
    <main class="container py-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="h3 mb-1">Data Mahasiswa</h1>
                <p class="text-secondary mb-0"></p>
            </div>
            <a href="?url=mahasiswa/create" class="btn btn-primary">+ Tambah Mahasiswa</a>
        </div>

        <?php if ($flash): ?>
            <div class="alert alert-<?= htmlspecialchars($flash['type']) ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($flash['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form class="row g-2 mb-4" method="get">
                    <input type="hidden" name="url" value="mahasiswa">
                    <div class="col-md-8">
                        <input class="form-control" type="search" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari NIM, nama, atau program studi">
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-outline-primary w-100" type="submit">Cari</button>
                    </div>
                    <div class="col-md-auto">
                        <a class="btn btn-outline-secondary w-100" href="?url=mahasiswa">Reset</a>
                    </div>
                </form>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($mahasiswa === []): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-secondary">Belum ada data mahasiswa.</td>
                                </tr>
                            <?php else: foreach ($mahasiswa as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($item['nim']) ?></td>
                                    <td>
                                        <strong><?= htmlspecialchars($item['nama']) ?></strong><br>
                                        <small class="text-secondary"><?= htmlspecialchars($item['email']) ?></small>
                                    </td>
                                    <td><?= htmlspecialchars($item['nama_prodi'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($item['angkatan']) ?></td>
                                    <td>
                                        <span class="badge text-bg-<?= $item['status'] === 'aktif' ? 'success' : ($item['status'] === 'cuti' ? 'warning' : 'secondary') ?>">
                                            <?= htmlspecialchars(ucfirst($item['status'])) ?>
                                        </span>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <a class="btn btn-sm btn-warning" href="?url=mahasiswa/edit&id=<?= $item['id'] ?>">Ubah</a>
                                        <form class="d-inline" method="post" action="?url=mahasiswa/delete" onsubmit="return confirm('Hapus data <?= htmlspecialchars($item['nama'], ENT_QUOTES) ?>?')">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>