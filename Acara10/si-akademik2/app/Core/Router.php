<?php

class Router
{
    private array $routes = ['GET' => [], 'POST' => []];

    public function get(string $url, string $action): void
    {
        $this->routes['GET'][$url] = $action;
    }

    public function post(string $url, string $action): void
    {
        $this->routes['POST'][$url] = $action;
    }

    public function dispatch(): void
    {
        $url = trim($_GET['url'] ?? 'mahasiswa', '/');
        $action = $this->routes[$_SERVER['REQUEST_METHOD']][$url] ?? null;

        if ($action === null) {
            http_response_code(404);
            exit('404 - Halaman tidak ditemukan');
        }

        [$controller, $method] = explode('@', $action);
        (new $controller())->$method();
    }
}
