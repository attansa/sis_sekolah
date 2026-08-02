<?php

header('Content-Type: application/json');

require_once '../models/Absensi.php';

$absensi = new Absensi();

echo json_encode([

    'last' => $absensi->lastScan(),

    'riwayat' => $absensi->riwayatHariIni()

]);