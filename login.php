<?php
// die(__FILE__);
require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';
require_once 'controllers/AuthController.php';

if (isLogin()) {
    redirect('dashboard.php');
}

$auth = new AuthController();
$auth->login();

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Login BUBS</title>

<link rel="stylesheet"
href="assets/adminlte/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet"
href="assets/adminlte/dist/css/adminlte.min.css">

</head>

<body class="hold-transition login-page">

<div class="login-box">

<div class="card card-primary">

<div class="card-header text-center">

<h3>BUBS V1</h3>

</div>

<div class="card-body">

<?php

if(isset($_SESSION['error']))
{

echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';

unset($_SESSION['error']);

}

?>

<form method="POST">

<div class="form-group">

<input
type="text"
name="username"
class="form-control"
placeholder="Username"
required>

</div>

<div class="form-group">

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required>

</div>

<button
class="btn btn-primary btn-block">

Login

</button>

</form>

</div>

</div>

</div>

<script src="assets/adminlte/plugins/jquery/jquery.min.js"></script>

<script src="assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>