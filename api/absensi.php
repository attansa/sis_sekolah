<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Absensi.php';

try {

    // ==========================
    // Ambil Data
    // ==========================
    $uid = isset($_POST['uid']) ? trim($_POST['uid']) : '';

    // Optional, untuk identitas alat RFID
    $device = isset($_POST['device']) ? trim($_POST['device']) : 'GERBANG_1';

    if ($uid == '') {

        echo json_encode([
            'status' => false,
            'message' => 'UID RFID kosong'
        ]);

        exit;
    }

    $database = new Database();
    $db = $database->connect();

    // ==========================
    // Cari User Berdasarkan RFID
    // ==========================
    $stmt = $db->prepare("
        SELECT
            users.id,
            users.nama,
            users.role
        FROM rfid_cards
        INNER JOIN users
            ON users.id = rfid_cards.user_id
        WHERE
            rfid_cards.uid = ?
        AND
            rfid_cards.status = 'aktif'
        LIMIT 1
    ");

    $stmt->execute([$uid]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {

        echo json_encode([
            'status' => false,
            'message' => 'Kartu belum terdaftar'
        ]);

        exit;
    }

    // ==========================
    // Proses Absensi
    // ==========================
    $absensi = new Absensi();

    $today = $absensi->today($user['id']);

    // ==========================
    // Belum Absen
    // ==========================
    if (!$today) {

        $absensi->masuk($user['id']);

        echo json_encode([
            'status' => true,
            'tipe' => 'masuk',
            'nama' => $user['nama'],
            'role' => $user['role'],
            'jam' => date('H:i:s'),
            'message' => 'Absen Masuk Berhasil'
        ]);

        exit;
    }

    // ==========================
    // Sudah Masuk, Belum Keluar
    // ==========================
    if (empty($today['jam_keluar'])) {

        $absensi->pulang($today['id']);

        echo json_encode([
            'status' => true,
            'tipe' => 'keluar',
            'nama' => $user['nama'],
            'role' => $user['role'],
            'jam' => date('H:i:s'),
            'message' => 'Absen Pulang Berhasil'
        ]);

        exit;
    }
// ==========================================
// Riwayat Absensi Saya
// ==========================================
public function riwayatSaya($user_id)
{
    $stmt = $this->db->prepare("
        SELECT
            a.*,
            u.nama,
            u.role
        FROM absensi a
        INNER JOIN users u
            ON u.id = a.user_id
        WHERE a.user_id = ?
        ORDER BY a.tanggal DESC, a.jam_masuk DESC
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    // ==========================
    // Sudah Absen Lengkap
    // ==========================
    echo json_encode([
        'status' => false,
        'nama' => $user['nama'],
        'message' => 'Anda sudah melakukan absensi hari ini.'
    ]);

} catch (Exception $e) {

    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ]);

}