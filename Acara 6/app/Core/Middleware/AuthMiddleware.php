<?php
namespace App\Core\Middleware;

class AuthMiddleware
{
    public function handle(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            $base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
            $base = str_replace('/index.php', '', $base);
            header("Location: $base/login");
            exit;
        }
    }
}
?>
