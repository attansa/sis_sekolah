<?php

require_once '../config/database.php';

header('Content-Type: application/json');

$uid = trim($_GET['uid'] ?? '');

if($uid==''){

    echo json_encode([
        'status'=>false
    ]);

    exit;
}

$db=(new Database())->connect();

$stmt=$db->prepare("
SELECT
users.id,
users.nama,
users.role
FROM rfid_cards
JOIN users
ON users.id=rfid_cards.user_id
WHERE rfid_cards.uid=?
AND rfid_cards.status='aktif'
LIMIT 1
");

$stmt->execute([$uid]);

$data=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$data){

    echo json_encode([
        'status'=>false
    ]);

    exit;
}

echo json_encode([
    'status'=>true,
    'user'=>$data
]);