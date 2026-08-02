<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/KPIController.php';

if (!isLogin()) {
    redirect('login.php');
}

if (userRole() != 'superadmin') {
    die('Akses ditolak.');
}

$controller = new KPIController();

$action = $_GET['action'] ?? 'index';

/*
|--------------------------------------------------------------------------
| PROSES ACTION
|--------------------------------------------------------------------------
*/

switch ($action) {

    case 'store':
        $controller->store();
        break;

    case 'update':
        $controller->update($_GET['id']);
        break;

    case 'delete':
        $controller->delete($_GET['id']);
        break;

}

/*
|--------------------------------------------------------------------------
| VIEW
|--------------------------------------------------------------------------
*/

ob_start();

switch ($action) {

    case 'create':

        include 'views/kpi/create.php';

        break;

    case 'edit':

        $kpi = $controller->edit($_GET['id']);

        include 'views/kpi/edit.php';

        break;

    default:

        $dataKPI = $controller->index();

        include 'views/kpi/index.php';

        break;

}

$content = ob_get_clean();

include 'views/layouts/master.php';