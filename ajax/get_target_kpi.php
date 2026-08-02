<?php

require_once '../config/database.php';

$database = new Database();
$db = $database->connect();

$id = $_GET['id'] ?? 0;
$jabatan = $_SESSION['jabatan_id'] ?? 0;

// kalau memakai session
require_once '../config/session.php';

$stmt = $db->prepare("
    SELECT
        target
    FROM kpi_jabatan
    WHERE kpi_id = ?
    AND jabatan_id = ?
    LIMIT 1
");

$stmt->execute([$id, $jabatan]);

echo json_encode(
    $stmt->fetch(PDO::FETCH_ASSOC)
);