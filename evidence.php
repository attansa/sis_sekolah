<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/EvidenceController.php';

if(!isLogin()){
    redirect('login.php');
}

$controller = new EvidenceController();

$action = $_GET['action'] ?? 'index';

/*
|--------------------------------------------------------------------------
| ACTION YANG MELAKUKAN PROSES
|--------------------------------------------------------------------------
*/

switch($action){

    case 'store':
        $controller->store();
        exit;

    case 'update':
        $controller->update($_GET['id']);
        exit;

    case 'approve':
        $controller->approve($_GET['id']);
        exit;

    case 'revisi':
        $controller->revisi($_GET['id']);
        exit;

    case 'tolak':
        $controller->tolak($_GET['id']);
        exit;

    case 'delete':
        $controller->delete($_GET['id']);
        exit;

}

/*
|--------------------------------------------------------------------------
| TAMPILKAN HALAMAN
|--------------------------------------------------------------------------
*/

ob_start();

switch($action){

    case 'create':

        $data = $controller->create();

        $user = $data['user'];

        $kpi = $data['kpi'];

        include 'views/evidence/create.php';

    break;

    case 'edit':

        $evidence = $controller->edit($_GET['id']);

        $kpi = $controller->getKPI();

        include 'views/evidence/edit.php';

    break;

    case 'detail':

        $evidence = $controller->detail($_GET['id']);

        include 'views/evidence/detail.php';

    break;

    case 'pending':

        $evidence = $controller->pending();

        include 'views/evidence/pending.php';

    break;

    default:

        $dataEvidence = $controller->index();

        include 'views/evidence/index.php';

    break;

}

$content = ob_get_clean();

include 'views/layouts/master.php';