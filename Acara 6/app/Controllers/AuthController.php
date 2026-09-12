<?php
namespace App\Controllers;

class AuthController
{
    public function loginForm()
    {
        echo '<h2>Form Login</h2>';
        echo '<form method="POST" action="" class="mt-3" style="max-width:400px">';
        echo '  <div class="mb-3">';
        echo '    <label class="form-label">Username</label>';
        echo '    <input type="text" name="username" class="form-control" required>';
        echo '  </div>';
        echo '  <div class="mb-3">';
        echo '    <label class="form-label">Password</label>';
        echo '    <input type="password" name="password" class="form-control" required>';
        echo '  </div>';
        echo '  <button type="submit" class="btn btn-primary">Login</button>';
        echo '</form>';
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_name'] = 'Admin';

            // Tugas Mandiri: Flash message
            $_SESSION['flash'] = "Selamat datang, Admin";

            $base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
            $base = str_replace('/index.php', '', $base);
            header("Location: $base/dashboard");
            exit;
        } else {
            echo '<div class="alert alert-danger">Login Gagal. Username atau password salah.</div>';
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();

        session_start();
        // Tugas Mandiri: Flash message logout
        $_SESSION['flash'] = "Anda telah logout";

        $base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $base = str_replace('/index.php', '', $base);
        header("Location: $base/login");
        exit;
    }
}
?>