<?php
namespace App\Core;

class Controller
{
    protected function url(string $path = '/'): string
    {
        $base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    protected function redirect(string $path): never
    {
        header('Location: ' . $this->url($path));
        exit;
    }
}
