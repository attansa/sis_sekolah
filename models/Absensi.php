<?php

require_once __DIR__ . '/../config/database.php';

class Absensi
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ==========================================
    // Ambil semua absensi
    // ==========================================
    public function all()
    {
        $stmt = $this->db->prepare("
            SELECT
                absensi.*,
                users.nama,
                users.role
            FROM absensi
            INNER JOIN users
                ON users.id = absensi.user_id
            ORDER BY
                absensi.tanggal DESC,
                absensi.jam_masuk DESC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==========================================
    // Cari absensi hari ini
    // ==========================================
    public function today($user_id)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM absensi
            WHERE user_id = ?
            AND tanggal = CURDATE()
            LIMIT 1
        ");

        $stmt->execute([$user_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ==========================================
    // Simpan Absen Masuk
    // ==========================================
   public function masuk($user_id)
{
    // Ambil pengaturan jam absensi
    $setting = $this->getPengaturan();

    // Default
    $status = "hadir";

    // Jam sekarang
    $jamSekarang = date("H:i:s");

    // Jika melewati batas terlambat
    if ($setting && $jamSekarang > $setting['batas_terlambat']) {
        $status = "terlambat";
    }

    $stmt = $this->db->prepare("
        INSERT INTO absensi
        (
            user_id,
            tanggal,
            jam_masuk,
            status
        )
        VALUES
        (
            ?,
            CURDATE(),
            CURTIME(),
            ?
        )
    ");

    return $stmt->execute([
        $user_id,
        $status
    ]);
}

    // ==========================================
    // Simpan Absen Keluar
    // ==========================================
    public function pulang($id)
    {
        $stmt = $this->db->prepare("
            UPDATE absensi
            SET jam_keluar = CURTIME()
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    // ==========================================
    // Cari berdasarkan ID
    // ==========================================
    public function find($id)
    {
        $stmt = $this->db->prepare("
            SELECT
                absensi.*,
                users.nama,
                users.role
            FROM absensi
            INNER JOIN users
                ON users.id = absensi.user_id
            WHERE absensi.id = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ==========================================
    // Absensi Hari Ini
    // ==========================================
    public function hariIni()
    {
        $stmt = $this->db->prepare("
            SELECT
                absensi.*,
                users.nama,
                users.role
            FROM absensi
            INNER JOIN users
                ON users.id = absensi.user_id
            WHERE absensi.tanggal = CURDATE()
            ORDER BY absensi.jam_masuk ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==========================================
    // Jumlah Hadir Hari Ini
    // ==========================================
    public function jumlahHariIni()
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM absensi
            WHERE tanggal = CURDATE()
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // ==========================================
    // Jumlah Terlambat
    // ==========================================
    public function jumlahTerlambat()
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM absensi
            WHERE tanggal = CURDATE()
            AND status = 'terlambat'
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // ==========================================
    // Riwayat User
    // ==========================================
    public function riwayatUser($user_id)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM absensi
            WHERE user_id = ?
            ORDER BY tanggal DESC
        ");

        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==========================================
    // Hapus Absensi
    // ==========================================
    public function delete($id)
    {
        $stmt = $this->db->prepare("
            DELETE FROM absensi
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }
    // ==========================================
// Ambil Absensi Terakhir
// ==========================================
public function lastAttendance()
{
    $stmt = $this->db->prepare("
        SELECT
            absensi.*,
            users.nama,
            users.role
        FROM absensi
        INNER JOIN users
            ON users.id = absensi.user_id
        ORDER BY absensi.id DESC
        LIMIT 1
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// ==========================================
// Guru Hadir Hari Ini
// ==========================================
public function guruHadirHariIni()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) AS total
        FROM absensi a
        INNER JOIN users u ON u.id=a.user_id
        WHERE a.tanggal=CURDATE()
        AND u.role='guru'
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// ==========================================
// Siswa Hadir Hari Ini
// ==========================================
public function siswaHadirHariIni()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) AS total
        FROM absensi a
        INNER JOIN users u ON u.id=a.user_id
        WHERE a.tanggal=CURDATE()
        AND u.role='siswa'
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// ==========================================
// Sudah Pulang
// ==========================================
public function sudahPulangHariIni()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) AS total
        FROM absensi
        WHERE tanggal=CURDATE()
        AND jam_keluar IS NOT NULL
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// ==========================================
// Belum Pulang
// ==========================================
public function belumPulangHariIni()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) AS total
        FROM absensi
        WHERE tanggal=CURDATE()
        AND jam_keluar IS NULL
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// ==========================================
// Scan Terakhir
// ==========================================
public function lastScan()
{
    $stmt = $this->db->prepare("
        SELECT
            a.*,
            u.nama,
            u.role
        FROM absensi a
        INNER JOIN users u
            ON u.id=a.user_id
        ORDER BY a.id DESC
        LIMIT 1
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// ==========================================
// Riwayat Hari Ini
// ==========================================
public function riwayatHariIni()
{
    $stmt = $this->db->prepare("
        SELECT
            a.*,
            u.nama,
            u.role
        FROM absensi a
        INNER JOIN users u
            ON u.id=a.user_id
        WHERE a.tanggal=CURDATE()
        ORDER BY a.jam_masuk DESC
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ==========================================
// Rekap Absensi
// ==========================================
public function rekap($mulai = '', $sampai = '')
{
    if ($mulai != '' && $sampai != '') {

        $stmt = $this->db->prepare("
            SELECT
                a.*,
                u.nama,
                u.role
            FROM absensi a
            INNER JOIN users u
                ON u.id=a.user_id
            WHERE a.tanggal BETWEEN ? AND ?
            ORDER BY a.tanggal DESC, a.jam_masuk DESC
        ");

        $stmt->execute([$mulai, $sampai]);

    } else {

        $stmt = $this->db->prepare("
            SELECT
                a.*,
                u.nama,
                u.role
            FROM absensi a
            INNER JOIN users u
                ON u.id=a.user_id
            ORDER BY a.tanggal DESC, a.jam_masuk DESC
        ");

        $stmt->execute();
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// ==========================================
// Grafik 7 Hari Terakhir
// ==========================================
public function grafik7Hari()
{
    $stmt = $this->db->prepare("
        SELECT
            tanggal,
            COUNT(*) total
        FROM absensi
        WHERE tanggal>=DATE_SUB(CURDATE(),INTERVAL 6 DAY)
        GROUP BY tanggal
        ORDER BY tanggal ASC
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getPengaturan()
{
    $stmt = $this->db->prepare("
        SELECT *
        FROM pengaturan_absensi
        LIMIT 1
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}