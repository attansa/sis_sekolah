<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/KelasController.php';


if(!isLogin())
{
    redirect('login.php');
}


// hanya superadmin

if(userRole() != 'superadmin')
{
    redirect('dashboard.php');
}



$controller = new KelasController();



$action = $_GET['action'] ?? 'index';



ob_start();



switch($action)
{


case 'create':

    $guru = $controller->getGuru();

    include 'views/kelas/tambah.php';

break;



case 'store':

    $controller->store();

break;



case 'edit':

    $kelas = $controller->edit($_GET['id']);

    $guru = $controller->getGuru();

    include 'views/kelas/edit.php';

break;



case 'update':

    $controller->update($_GET['id']);

break;




case 'delete':

    $controller->delete($_GET['id']);

break;




default:

    $kelas = $controller->index();

    include 'views/kelas/index.php';

break;


}



$content = ob_get_clean();



include 'views/layouts/master.php';