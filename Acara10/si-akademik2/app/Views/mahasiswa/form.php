<?php 
$errors = $errors ?? [];

$v = fn($k, $def='') => htmlspecialchars($mahasiswa[$k] ?? $def);
$inv = fn($k) => isset($errors[$k]) ? 'is-invalid' : '';
$err = fn($k) => isset($errors[$k]) ? "<div class='invalid-feedback'>{$errors[$k]}</div>" : '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?> | Acara 10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="?url=mahasiswa">Sistem Informasi Akademik</a>
        </div>
    </nav>
    
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="d-flex justify-content-between mb-3">
                    <h1 class="h3"><?= htmlspecialchars($title) ?></h1>
                    <a href="?url=mahasiswa" class="btn btn-outline-secondary">Kembali</a>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form method="post" action="?url=<?= htmlspecialchars($action) ?>" novalidate>
                            <div class="row g-3">
                                
                                <div class="col-md-6">
                                    <label class="form-label">NIM *</label>
                                    <input class="form-control <?= $inv('nim') ?>" name="nim" value="<?= $v('nim') ?>" required>
                                    <?= $err('nim') ?>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Nama *</label>
                                    <input class="form-control <?= $inv('nama') ?>" name="nama" value="<?= $v('nama') ?>" required>
                                    <?= $err('nama') ?>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control <?= $inv('email') ?>" name="email" value="<?= $v('email') ?>" required>
                                    <?= $err('email') ?>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Program Studi *</label>
                                    <select class="form-select <?= $inv('prodi') ?>" name="prodi" required>
                                        <option value="">Pilih program studi</option>
                                        <?php $pId = $mahasiswa['prodi_id'] ?? $mahasiswa['prodi'] ?? ''; ?>
                                        <?php foreach([1=>'Teknik Informatika', 2=>'Sistem Informasi', 3=>'Teknik Komputer'] as $id => $nama): ?>
                                            <option value="<?= $id ?>" <?= $pId == $id ? 'selected' : '' ?>><?= $nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= $err('prodi') ?>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Angkatan *</label>
                                    <input type="number" class="form-control <?= $inv('angkatan') ?>" name="angkatan" value="<?= $v('angkatan', date('Y')) ?>" required>
                                    <?= $err('angkatan') ?>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Status *</label>
                                    <select class="form-select" name="status">
                                        <?php foreach(['aktif'=>'Aktif', 'cuti'=>'Cuti', 'lulus'=>'Lulus'] as $val => $lbl): ?>
                                            <option value="<?= $val ?>" <?= $v('status') === $val ? 'selected' : '' ?>><?= $lbl ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>
                            
                            <div class="mt-4 d-flex gap-2">
                                <button class="btn btn-primary" type="submit">Simpan Data</button>
                                <a class="btn btn-light" href="?url=mahasiswa">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>