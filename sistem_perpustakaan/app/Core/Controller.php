<?php

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . base_url($url));
        exit;
    }
}
