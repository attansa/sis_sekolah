<?php

header('Content-Type: application/json');

require_once '../models/Absensi.php';

$absensi = new Absensi();

$data = $absensi->lastAttendance();

if (!$data) {

    echo json_encode([
        'status' => false
    ]);

    exit;
}

echo json_encode([
    'status' => true,
    'data' => $data
]);