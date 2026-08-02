<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

if(!isLogin()){
    redirect('login.php');
}

require_once 'controllers/KPILaporanController.php';

$controller = new KPILaporanController();

$action = $_GET['action'] ?? 'index';

ob_start();

switch($action){

    case 'detail':

        $detail = $controller->detail($_GET['id']);

        include 'views/kpi_laporan/detail.php';

    break;

    default:
        $summary = $controller->summary();
        $laporan = $controller->index();

        include 'views/kpi_laporan/index.php';

    break;

}

$content = ob_get_clean();

include 'views/layouts/master.php';