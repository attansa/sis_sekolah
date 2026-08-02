<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
   public function login()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        return;
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user = new User();
    $data = $user->login($username, $password);

    if ($data) {

        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        // Tambahan
        $_SESSION['jabatan_id'] = $data['jabatan_id'];
        $_SESSION['jabatan'] = $data['nama_jabatan'];

        redirect('dashboard.php');

    } else {

        $_SESSION['error'] = "Username atau Password salah.";

        redirect('login.php');

    }
}
}