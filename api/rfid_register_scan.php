<?php

header('Content-Type: application/json');

date_default_timezone_set('Asia/Jakarta');

require_once '../config/database.php';

$database = new Database();
$db = $database->connect();

$response = [
    'status' => false,
    'message' => ''
];

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    $response['message'] = 'Method tidak diizinkan';

    echo json_encode($response);
    exit;
}

$uid = strtoupper(trim($_POST['uid'] ?? ''));

if ($uid == '') {

    $response['message'] = 'UID kosong';

    echo json_encode($response);
    exit;
}

try {

    // Hapus UID lama
    $db->exec("DELETE FROM rfid_temp");

    // Simpan UID terbaru
    $stmt = $db->prepare("
        INSERT INTO rfid_temp
        (
            uid
        )
        VALUES
        (
            ?
        )
    ");

    $stmt->execute([$uid]);

    $response['status'] = true;
    $response['message'] = 'UID berhasil diterima';
    $response['uid'] = $uid;

} catch(Exception $e){

    $response['message']=$e->getMessage();

}

echo json_encode($response);