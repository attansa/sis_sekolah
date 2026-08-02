<?php

require_once 'config/constants.php';
require_once 'config/session.php';
require_once 'core/Functions.php';

if(!isLogin()){
    redirect('login.php');
}
// if(userRole()=="kepsek"){

//     $kinerja = new KinerjaController();

//     $dashboard = $kinerja->dashboardKepsek();

// }
require_once 'controllers/DashboardController.php';

$controller = new DashboardController();
$controller->index();