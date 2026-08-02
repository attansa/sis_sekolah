<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/JurnalController.php';

if (!isLogin()) {
    redirect('login.php');
}

$controller = new JurnalController();

$action = $_GET['action'] ?? 'index';

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

ob_start();

switch ($action) {

    case 'create':

        $kelas = $controller->getKelas();

        include 'views/jurnal/tambah.php';

        break;


    case 'edit':

        $jurnal = $controller->edit($_GET['id']);

        $kelas = $controller->getKelas();

        include 'views/jurnal/edit.php';

        break;


    default:

        $dataJurnal = $controller->index();

        include 'views/jurnal/index.php';

        break;

}

$content = ob_get_clean();

include 'views/layouts/master.php';