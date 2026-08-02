<?php

require_once '../config/database.php';

header('Content-Type: application/json');

$db = (new Database())->connect();

$stmt = $db->query("
SELECT *
FROM rfid_logs
ORDER BY id DESC
LIMIT 1
");

$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {

    echo json_encode([
        'uid' => ''
    ]);

    exit;
}

echo json_encode([
    'uid' => $data['uid']
]);