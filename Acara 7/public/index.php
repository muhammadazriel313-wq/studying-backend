<?php
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';

$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

ob_start();

if (isset($routes[$method][$uri])) {
    $route = $routes[$method][$uri];
    [$controllerName, $action] = $route['controller'];
    $controllerClass = "App\\Controllers\\{$controllerName}";
    $controller = new $controllerClass();
    $controller->$action();
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
    <title>Acara 7 - Model & Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="">SI Akademik - Acara 7</a>
        </div>
    </nav>
    <main class="container">
        <?= $content ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>