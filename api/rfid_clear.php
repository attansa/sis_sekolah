<?php

require_once '../config/database.php';

header('Content-Type: application/json');

$db = (new Database())->connect();

$db->exec("DELETE FROM rfid_logs");

echo json_encode([
    'status' => true
]);