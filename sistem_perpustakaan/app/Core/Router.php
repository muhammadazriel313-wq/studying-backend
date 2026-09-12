<?php
class Router
{
    private array $routes = [];
    public function add(string $method, string $path, string $controller, string $action): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $basePath = '/Studying%20Backend/sistem_perpustakaan/public';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        
        if ($uri === '' || $uri === null) {
            $uri = '/';
        }
        
        if ($uri !== '/' && substr($uri, -1) === '/') {
            $uri = rtrim($uri, '/');
        }

        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_-]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                $controllerFile = strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '_', $route['controller']));
                require_once __DIR__ . '/../Controllers/' . $controllerFile . '.php';
                $controllerInstance = new $route['controller']();
                call_user_func_array([$controllerInstance, $route['action']], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found: " . htmlspecialchars($uri);
    }
}