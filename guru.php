<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/GuruController.php';

if (!isLogin()) {
    redirect('login.php');
}

if (userRole() != 'superadmin') {
    die('Akses ditolak.');
}

$controller = new GuruController();

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
        $jabatan = $controller->getJabatan();
        include 'views/guru/tambah.php';
        break;

   case 'edit':
        $guru = $controller->edit($_GET['id']);
        $jabatan = $controller->getJabatan();
        include 'views/guru/edit.php';

break;

    default:
        $dataGuru = $controller->index();
        include 'views/guru/index.php';
        break;

}

$content = ob_get_clean();

include 'views/layouts/master.php';