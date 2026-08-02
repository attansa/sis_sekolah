<?php

header('Content-Type: application/json');

require_once '../models/Absensi.php';

$absensi=new Absensi();

echo json_encode([

'guru'=>$absensi->guruHadirHariIni(),

'siswa'=>$absensi->siswaHadirHariIni(),

'sudah'=>$absensi->sudahPulangHariIni(),

'belum'=>$absensi->belumPulangHariIni(),

'last'=>$absensi->lastScan(),

'riwayat'=>$absensi->riwayatHariIni()

]);