<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/SiswaController.php';

if (!isLogin()) {
    redirect('login.php');
}

if (userRole() != 'superadmin') {
    redirect('dashboard.php');
}

$controller = new SiswaController();

$action = $_GET['action'] ?? 'index';

ob_start();

switch ($action) {

    case 'create':

        $kelas = $controller->getKelas();

        include 'views/siswa/tambah.php';

    break;

    case 'store':

        $controller->store();

    break;

    case 'edit':

        $siswa = $controller->edit($_GET['id']);

        $kelas = $controller->getKelas();

        include 'views/siswa/edit.php';

    break;

    case 'update':

        $controller->update($_GET['id']);

    break;

    case 'delete':

        $controller->delete($_GET['id']);

    break;

    default:

        $siswa = $controller->index();

        include 'views/siswa/index.php';

    break;
}

$content = ob_get_clean();

include 'views/layouts/master.php';