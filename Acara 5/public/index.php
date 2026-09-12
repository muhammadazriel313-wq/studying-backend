<?php
// public/index.php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../routes/web.php';

// Memuat Controller secara manual
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Hilangkan base path secara dinamis untuk folder project apapun
$base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];
$routeFound = false;

// ==========================================
// Studi Kasus: Cek exact match rute sederhana
// ==========================================
if (isset($routes[$method][$uri])) {
    [$controllerName, $action] = $routes[$method][$uri];
    $controllerClass = "App\\Controllers\\{$controllerName}";
    $controller = new $controllerClass();
    $controller->$action();
    $routeFound = true;
} else {
    // ==========================================
    // Tugas Mandiri: Pengecekan route parameter regex
    // ==========================================
    if (isset($routes[$method])) {
        foreach ($routes[$method] as $route => $handler) {
            // Ubah {param} di route menjadi regex pattern misal (?<param>[a-zA-Z0-9_]+)
            $pattern = "#^" . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?<$1>[a-zA-Z0-9_]+)', $route) . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                [$controllerName, $action] = $handler;
                $controllerClass = "App\\Controllers\\{$controllerName}";
                $controller = new $controllerClass();

                // Ambil hanya parameter dengan key string dari matches regex
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Panggil method controller dengan passing parameter tersebut
                call_user_func_array([$controller, $action], array_values($params));
                $routeFound = true;
                break;
            }
        }
    }
}

if (!$routeFound) {
    http_response_code(404);
    echo "404 - Halaman tidak ditemukan";
}
