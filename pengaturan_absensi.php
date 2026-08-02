<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/PengaturanAbsensiController.php';

if (!isLogin()) {
    redirect('login.php');
}

$controller = new PengaturanAbsensiController();

$action = $_GET['action'] ?? 'index';

switch ($action) {

    case 'update':
        $controller->update();
        break;

    default:
        $controller->index();
        break;
}