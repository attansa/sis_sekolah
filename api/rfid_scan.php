<?php

header('Content-Type: application/json');

date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . '/../config/database.php';

$database = new Database();
$db = $database->connect();

$response = [
    'status'  => false,
    'message' => '',
    'data'    => []
];

// ==========================================
// Hanya menerima POST
// ==========================================
if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    $response['message'] = 'Method tidak diizinkan';

    echo json_encode($response);
    exit;
}

// ==========================================
// Ambil UID
// ==========================================
$uid = strtoupper(trim($_POST['uid'] ?? ''));

if ($uid == '') {

    $response['message'] = 'UID kosong';

    echo json_encode($response);
    exit;
}

try {

    // ==========================================
    // Cari RFID
    // ==========================================
    $stmt = $db->prepare("
        SELECT
            r.user_id,
            u.nama,
            u.role
        FROM rfid_cards r
        INNER JOIN users u
            ON u.id = r.user_id
        WHERE
            r.uid = ?
        AND
            r.status = 'aktif'
        LIMIT 1
    ");

    $stmt->execute([$uid]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {

        $response['message'] = 'Kartu belum terdaftar';

        echo json_encode($response);
        exit;
    }

    // ==========================================
    // Waktu Sekarang
    // ==========================================
    $tanggal = date('Y-m-d');
    $jam     = date('H:i:s');

    // ==========================================
    // Ambil Pengaturan Absensi
    // ==========================================
    $set = $db->query("
        SELECT *
        FROM pengaturan_absensi
        LIMIT 1
    ")->fetch(PDO::FETCH_ASSOC);

    $jamMasuk       = $set['jam_masuk'];
    $batasTerlambat = $set['batas_terlambat'];
    $jamPulang      = $set['jam_pulang'];

    // ==========================================
    // Cek Absensi Hari Ini
    // ==========================================
    $cek = $db->prepare("
        SELECT *
        FROM absensi
        WHERE
            user_id = ?
        AND
            tanggal = ?
        LIMIT 1
    ");

    $cek->execute([
        $user['user_id'],
        $tanggal
    ]);

    $absen = $cek->fetch(PDO::FETCH_ASSOC);

    // ==========================================
    // ABSEN MASUK
    // ==========================================
    if (!$absen) {

        $status = ($jam <= $batasTerlambat)
            ? 'hadir'
            : 'terlambat';

        $insert = $db->prepare("
            INSERT INTO absensi
            (
                user_id,
                tanggal,
                jam_masuk,
                status,
                status_pulang
            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                'belum'
            )
        ");

        $insert->execute([

            $user['user_id'],
            $tanggal,
            $jam,
            $status

        ]);

        $response['status'] = true;

        $response['message'] = 'Absen Masuk';

        $response['data'] = [

            'nama'   => $user['nama'],
            'role'   => $user['role'],
            'mode'   => 'masuk',
            'status' => $status,
            'jam'    => $jam

        ];

        echo json_encode($response);
        exit;
    }

    // ==========================================
    // ABSEN PULANG
    // ==========================================
    if (empty($absen['jam_keluar'])) {

        $statusPulang = ($jam < $jamPulang)
            ? 'pulang_cepat'
            : 'pulang';

        $update = $db->prepare("
            UPDATE absensi
            SET
                jam_keluar = ?,
                status_pulang = ?
            WHERE id = ?
        ");

        $update->execute([

            $jam,
            $statusPulang,
            $absen['id']

        ]);

        $response['status'] = true;

        $response['message'] = 'Absen Pulang';

        $response['data'] = [

            'nama'            => $user['nama'],
            'role'            => $user['role'],
            'mode'            => 'pulang',
            'status_pulang'   => $statusPulang,
            'jam'             => $jam

        ];

        echo json_encode($response);
        exit;
    }

    // ==========================================
    // Sudah Absen Masuk & Pulang
    // ==========================================
    $response['status'] = false;

    $response['message'] = 'Hari ini sudah melakukan absensi masuk dan pulang';

    $response['data'] = [

        'nama' => $user['nama']

    ];

    echo json_encode($response);

} catch (Exception $e) {

    $response['status'] = false;

    $response['message'] = $e->getMessage();

    echo json_encode($response);
}