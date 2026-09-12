<?php
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Models/MahasiswaRepository.php';
require_once __DIR__ . '/../app/Models/ProdiRepository.php';
require_once __DIR__ . '/../app/Models/MatakuliahRepository.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/ProdiController.php';
require_once __DIR__ . '/../app/Controllers/MatakuliahController.php';
require_once __DIR__ . '/../routes/web.php';

$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}
$method = $_SERVER['REQUEST_METHOD'];

if (isset($_GET['route'])) {
    $uri = '/' . trim((string) $_GET['route'], '/');
}

ob_start();

if (isset($routes[$method][$uri])) {
    [$controllerName, $action] = $routes[$method][$uri]['controller'];
    $controllerClass = "App\\Controllers\\{$controllerName}";
    (new $controllerClass())->$action();
} else {
    http_response_code(404);
    echo '<div class="alert alert-warning">404 - Halaman tidak ditemukan.</div>';
}

$content = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acara 8 - PDO & Prepared Statements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="?/">SI Akademik</a>
            <div class="navbar-nav flex-row gap-3">
                <a class="nav-link" href="?/">Mahasiswa</a>
                <a class="nav-link" href="?route=prodi">Prodi</a>
                <a class="nav-link" href="?route=matakuliah">Mata Kuliah</a>
            </div>
        </div>
    </nav>
    <main class="container">
        <?= $content ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
