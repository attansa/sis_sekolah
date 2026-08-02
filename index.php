<?php

require_once 'config/constants.php';
require_once 'config/session.php';

if (isset($_SESSION['login'])) {

    header("Location: dashboard.php");

} else {

    header("Location: login.php");

}