<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';
require_once 'controllers/KelasController.php';

if(!isLogin())
{
    redirect("login.php");
}

if(userRole()!="superadmin")
{
    die("Akses ditolak");
}

$controller=new KelasController();

$controller->store();

ob_start();

include 'views/kelas/tambah.php';

$content=ob_get_clean();

include 'views/layouts/master.php';