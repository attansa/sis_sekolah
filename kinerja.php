<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/KinerjaController.php';

if(!isLogin()){
    redirect('login.php');
}

$controller = new KinerjaController();

$action = $_GET['action'] ?? 'index';

ob_start();

switch($action){

    default:

        $result = $controller->index();

        extract($result);

        include 'views/kinerja/index.php';

    break;

}

$content = ob_get_clean();

include 'views/layouts/master.php';