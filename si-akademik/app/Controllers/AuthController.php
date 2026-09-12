<?php
namespace App\Controllers;
use App\Core\Controller;
class AuthController extends Controller
{
    public function loginForm(): void { if(session_status()===PHP_SESSION_NONE)session_start(); $error=$_SESSION['error']??'';unset($_SESSION['error']); echo '<h1>Login</h1>'.($error?'<div class="alert alert-danger">'.htmlspecialchars($error).'</div>':'').'<form method="post" action="'.$this->url('/login').'"><div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required></div><div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div><button class="btn btn-primary">Login</button></form>'; }
    public function login(): void { if(session_status()===PHP_SESSION_NONE)session_start();if(($_POST['username']??'')==='admin'&&($_POST['password']??'')==='admin123'){$_SESSION['logged_in']=true;$_SESSION['user_name']='Admin';$_SESSION['flash']='Selamat datang, Admin';$this->redirect('/dashboard');}$_SESSION['error']='Username atau password salah.';$this->redirect('/login'); }
    public function logout(): void { if(session_status()===PHP_SESSION_NONE)session_start();$_SESSION=[];session_destroy();session_start();$_SESSION['flash']='Anda telah logout';$this->redirect('/login'); }
}
