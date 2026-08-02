<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">

<li class="nav-item">

<a class="nav-link" data-widget="pushmenu" href="#">

<i class="fas fa-bars"></i>

</a>

</li>

</ul>

<ul class="navbar-nav ml-auto">

<li class="nav-item dropdown">

<a class="nav-link" data-toggle="dropdown" href="#">

<i class="fas fa-user-circle"></i>

<?= userName(); ?>

</a>

<div class="dropdown-menu dropdown-menu-right">

<span class="dropdown-item-text">

Role :

<b><?= ucfirst(userRole()) ?></b>

</span>

<div class="dropdown-divider"></div>

<a href="<?= base_url('logout.php')?>"
class="dropdown-item">

<i class="fas fa-sign-out-alt"></i>

Logout

</a>

</div>

</li>

</ul>

</nav>