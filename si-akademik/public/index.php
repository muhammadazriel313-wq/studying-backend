<?php
declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (str_starts_with($class, $prefix)) {
        $file = __DIR__ . '/../app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
        if (is_file($file)) require_once $file;
    }
});
require __DIR__ . '/../routes/web.php';

use App\Core\Database;
use App\Models\MahasiswaRepository;
use App\Models\ProdiRepository;
use App\Models\MatakuliahRepository;

$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
if ($base !== '' && str_starts_with($uri, $base)) $uri = substr($uri, strlen($base)) ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

ob_start();
if (!isset($routes[$method][$uri])) {
    http_response_code(404); echo '<div class="alert alert-warning">404 - Halaman tidak ditemukan.</div>';
} else {
    $route = $routes[$method][$uri];
    foreach ($route['middleware'] ?? [] as $middleware) (new $middleware())->handle();
    [$name, $action] = $route['controller'];
    $class = 'App\\Controllers\\' . $name;
    $controller = match ($name) {
        'MahasiswaController' => (function () use ($class) {
            $database = new Database();
            return new $class(new MahasiswaRepository($database));
        })(),
        'ProdiController' => (function () use ($class) {
            $pdo = (new Database())->getConnection();
            return new $class(new ProdiRepository($pdo));
        })(),
        'MatakuliahController' => (function () use ($class) {
            $pdo = (new Database())->getConnection();
            return new $class(new MatakuliahRepository($pdo), new ProdiRepository($pdo));
        })(),
        default => new $class(),
    };
    $controller->$action();
}
$content = ob_get_clean();
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>SI Akademik</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body><nav class="navbar navbar-dark bg-dark mb-4"><div class="container"><a class="navbar-brand" href="<?= htmlspecialchars($base) ?>/dashboard">SI Akademik</a><div class="navbar-nav flex-row gap-3"><a class="nav-link" href="<?= htmlspecialchars($base) ?>/mahasiswa">Mahasiswa</a><a class="nav-link" href="<?= htmlspecialchars($base) ?>/prodi">Prodi</a><a class="nav-link" href="<?= htmlspecialchars($base) ?>/matakuliah">Mata Kuliah</a><a class="nav-link" href="<?= htmlspecialchars($base) ?>/logout">Logout</a></div></div></nav><main class="container"><?= $content ?></main></body></html>
