<?php

header('Content-Type: application/json');

require_once '../config/database.php';

if($_SERVER['REQUEST_METHOD']!='POST'){
    exit;
}

$uid=strtoupper(trim($_POST['uid']));

if($uid==''){
    exit;
}

$cek=$pdo->query("SELECT COUNT(*) total FROM rfid_temp")->fetch();

if($cek['total']==0){

    $stmt=$pdo->prepare("

    INSERT INTO rfid_temp(uid)

    VALUES(?)

    ");

    $stmt->execute([$uid]);

}else{

    $stmt=$pdo->prepare("

    UPDATE rfid_temp

    SET

    uid=?,

    created_at=NOW()

    WHERE id=1

    ");

    $stmt->execute([$uid]);

}

echo json_encode([

    'status'=>true

]);