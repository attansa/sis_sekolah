<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';

$database = new Database();
$db = $database->connect();

$response = [
    'status' => false,
    'uid' => ''
];

try {

    $stmt = $db->prepare("
        SELECT uid
        FROM rfid_temp
        ORDER BY id DESC
        LIMIT 1
    ");

    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $response['status'] = true;
        $response['uid'] = $data['uid'];
    }

} catch (Exception $e) {

    $response['status'] = false;
    $response['message'] = $e->getMessage();

}

echo json_encode($response);