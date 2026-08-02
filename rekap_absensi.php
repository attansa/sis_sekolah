<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

require_once 'controllers/AbsensiController.php';

if(!isLogin()){
    redirect('login.php');
}

$controller = new AbsensiController();

$controller->rekap();