<?php
session_start();
function base_url($path = '') {
    $base = '/Studying%20Backend/sistem_perpustakaan/public';
    return rtrim($base, '/') . '/' . ltrim($path, '/');
}

require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Controller.php';

$router = new Router();
require_once __DIR__ . '/../routes/web.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST' && isset($_POST['_method'])) {
    $method = strtoupper($_POST['_method']);
}

// Get URI dari parameter _url dari .htaccess atau langsung dari REQUEST_URI
$uri = isset($_GET['_url']) ? '/' . $_GET['_url'] : $_SERVER['REQUEST_URI'];
if ($uri === '') {
    $uri = '/';
}

$router->dispatch($method, $uri);