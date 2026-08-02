<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/TargetKPIController.php';


if (!isLogin()) {

    redirect('login.php');

}


if(userRole()!='superadmin'){

    die('Akses ditolak.');

}



$controller = new TargetKPIController();



$action = $_GET['action'] ?? 'index';



switch($action){


    case 'store':

        $controller->store();

        break;

}



ob_start();



switch($action){


    case 'create':

    $users = $controller->getUsers();

    $kpi = $controller->getKPI();

    $tahun = $controller->getTahunPelajaran();


    include 'views/target_kpi/tambah.php';

break;


        break;



    default:


        $dataTarget = $controller->index();


        include 'views/target_kpi/index.php';


        break;


}



$content = ob_get_clean();



include 'views/layouts/master.php';