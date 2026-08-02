<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/TahunPelajaranController.php';


if(!isLogin()){

    redirect('login.php');

}


if(userRole()!='superadmin'){

    die('Akses ditolak.');

}


$controller = new TahunPelajaranController();


$action = $_GET['action'] ?? 'index';



switch($action){


    case 'store':

        $controller->store();

        break;


    case 'delete':

        $controller->delete($_GET['id']);

        break;


}



ob_start();



$dataTahun = $controller->index();


include 'views/tahun_pelajaran/index.php';



$content = ob_get_clean();



include 'views/layouts/master.php';