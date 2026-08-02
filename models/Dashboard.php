<?php

require_once __DIR__.'/../config/database.php';

class Dashboard
{

    private $db;

    public function __construct()
    {
        $database=new Database();
        $this->db=$database->connect();
    }

    // ===============================
    // Total Guru
    // ===============================
    public function totalGuru()
    {

        $stmt=$this->db->prepare("
            SELECT COUNT(*) total

            FROM users

            WHERE role='guru'
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    }

    // ===============================
    // Total Siswa
    // ===============================
    public function totalSiswa()
    {

        $stmt=$this->db->prepare("
            SELECT COUNT(*) total

            FROM users

            WHERE role='siswa'
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    }

    // ===============================
    // Hadir Hari Ini
    // ===============================
    public function hadirHariIni()
    {

        $stmt=$this->db->prepare("
            SELECT COUNT(*) total

            FROM absensi

            WHERE tanggal=CURDATE()
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    }

    // ===============================
    // Pulang Hari Ini
    // ===============================
    public function pulangHariIni()
    {

        $stmt=$this->db->prepare("
            SELECT COUNT(*) total

            FROM absensi

            WHERE

                tanggal=CURDATE()

                AND

                jam_keluar IS NOT NULL
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    }

    // ===============================
    // KPI Aktif
    // ===============================
    public function totalKPI()
    {

        $stmt=$this->db->prepare("
            SELECT COUNT(*) total

            FROM master_kpi

            WHERE status='aktif'
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    }

    // ===============================
    // Total Jurnal Hari Ini
    // ===============================
    public function jurnalHariIni()
    {

        $stmt=$this->db->prepare("
            SELECT COUNT(*) total

            FROM jurnal_mengajar

            WHERE tanggal=CURDATE()
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    }

    // ===============================
    // Ranking Guru
    // ===============================
    public function rankingGuru()
    {

        $stmt=$this->db->prepare("
            SELECT

                users.nama,

                SUM(kpi_nilai.nilai) total

            FROM users

            INNER JOIN kpi_nilai

                ON users.id=kpi_nilai.user_id

            WHERE users.role='guru'

            GROUP BY users.id

            ORDER BY total DESC

            LIMIT 5
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
// ======================================
// Statistik Dashboard
// ======================================
public function statistik()
{

    $sql="

    SELECT

        (SELECT COUNT(*) FROM users WHERE role='guru') guru,

        (SELECT COUNT(*) FROM users WHERE role='siswa') siswa,

        (SELECT COUNT(*) FROM absensi
            WHERE tanggal=CURDATE()) hadir,

        (SELECT COUNT(*) FROM jurnal_mengajar
            WHERE tanggal=CURDATE()) jurnal

    ";

    $stmt=$this->db->prepare($sql);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);

}
// ======================================
// Grafik KPI
// ======================================
public function grafikKPI()
{

    $stmt=$this->db->prepare("

        SELECT

            mk.nama_kpi,

            ROUND(AVG(kn.nilai),2) rata

        FROM master_kpi mk

        LEFT JOIN kpi_nilai kn

            ON kn.kpi_id=mk.id

        GROUP BY mk.id

    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
// ======================================
// Top Guru
// ======================================
public function topGuru()
{

    $stmt=$this->db->prepare("

        SELECT

            u.nama,

            ROUND(SUM(kn.nilai),2) total

        FROM users u

        INNER JOIN kpi_nilai kn

            ON kn.user_id=u.id

        WHERE u.role='guru'

        GROUP BY u.id

        ORDER BY total DESC

        LIMIT 10

    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
// ======================================
// Aktivitas Terbaru
// ======================================
public function aktivitas()
{

    $stmt=$this->db->prepare("

        SELECT

            users.nama,

            absensi.jam_masuk,

            absensi.tanggal

        FROM absensi

        INNER JOIN users

            ON users.id=absensi.user_id

        ORDER BY absensi.id DESC

        LIMIT 10

    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

// ======================================
// Total Staff
// ======================================
public function totalStaff()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) total
        FROM users
        WHERE role='staff'
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// ======================================
// Evidence Pending
// ======================================
public function evidencePending()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) total
        FROM kpi_evidence
        WHERE status='pending'
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// ======================================
// Evidence Approve
// ======================================
public function evidenceApprove()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) total
        FROM kpi_evidence
        WHERE status='approve'
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

// ======================================
// Evidence Revisi
// ======================================
public function evidenceRevisi()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) total
        FROM kpi_evidence
        WHERE status='revisi'
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}
// ======================================
// Evidence Terbaru
// ======================================
public function evidenceTerbaru($user = null)
{

    if($user){

        $stmt = $this->db->prepare("
            SELECT
                e.*,
                u.nama
            FROM kpi_evidence e
            INNER JOIN users u
                ON u.id=e.user_id
            WHERE e.user_id=?
            ORDER BY e.id DESC
            LIMIT 10
        ");

        $stmt->execute([$user]);

    }else{

        $stmt = $this->db->prepare("
            SELECT
                e.*,
                u.nama
            FROM kpi_evidence e
            INNER JOIN users u
                ON u.id=e.user_id
            ORDER BY e.id DESC
            LIMIT 10
        ");

        $stmt->execute();

    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
// ======================================
// Rata-rata KPI
// ======================================
public function rataKPI()
{
    $stmt = $this->db->prepare("
        SELECT ROUND(AVG(nilai),2) rata
        FROM kpi_nilai
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['rata'] ?? 0;
}

// ======================================
// Dashboard Kepala Sekolah
// ======================================

public function statistikKepsek()
{

    $stmt = $this->db->prepare("

        SELECT

        (SELECT COUNT(*) FROM users WHERE role='guru') guru,

        (SELECT COUNT(*) FROM users WHERE role='staff') staff,

        (SELECT COUNT(*) FROM kpi_evidence) evidence,

        (SELECT COUNT(*) FROM kpi_evidence WHERE status='pending') pending,

        (SELECT COUNT(*) FROM kpi_evidence WHERE status='approve') approve,

        (SELECT COUNT(*) FROM kpi_evidence WHERE status='revisi') revisi,

        (SELECT COUNT(*) FROM kpi_evidence WHERE status='ditolak') ditolak,

        IFNULL(

            (SELECT ROUND(AVG(nilai),2)
             FROM kpi_nilai),

             0

        ) rata

    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);

}

// ======================================
// Dashboard SDM
// ======================================

public function dashboardSDM()
{

    $stmt = $this->db->prepare("

        SELECT

        (SELECT COUNT(*) FROM users WHERE role='guru') guru,

        (SELECT COUNT(*) FROM users WHERE role='staff') staff,

        (SELECT COUNT(*) FROM users WHERE role='guru' AND status='aktif') guru_aktif,

        (SELECT COUNT(*) FROM users WHERE role='staff' AND status='aktif') staff_aktif,

        (SELECT COUNT(*) FROM absensi WHERE tanggal=CURDATE()) hadir,

        (SELECT COUNT(*) FROM users
            WHERE role IN('guru','staff'))

            -

        (SELECT COUNT(*) FROM absensi
            WHERE tanggal=CURDATE())

        tidak_hadir,

        (SELECT COUNT(*) FROM kpi_evidence
            WHERE status='pending') pending,

        (SELECT COUNT(*) FROM kpi_evidence
            WHERE status='approve') approve

    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);

}

public function dashboardStaff($user)
{
    $stmt = $this->db->prepare("
        SELECT

        (SELECT COUNT(*) FROM kpi_evidence
            WHERE user_id=?)
        total,

        (SELECT COUNT(*) FROM kpi_evidence
            WHERE user_id=? AND status='pending')
        pending,

        (SELECT COUNT(*) FROM kpi_evidence
            WHERE user_id=? AND status='approve')
        approve,

        (SELECT COUNT(*) FROM kpi_evidence
            WHERE user_id=? AND status='revisi')
        revisi,

        (SELECT COUNT(*) FROM kpi_evidence
            WHERE user_id=? AND status='ditolak')
        ditolak,

        IFNULL(
            (
                SELECT ROUND(AVG(nilai),2)
                FROM kpi_nilai
                WHERE user_id=?
            ),
            0
        ) nilai
    ");

    $stmt->execute([
        $user,
        $user,
        $user,
        $user,
        $user,
        $user
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function aktivitasUser($user)
{
    $stmt = $this->db->prepare("
        SELECT
            tanggal,
            jam_masuk,
            jam_keluar
        FROM absensi
        WHERE user_id=?
        ORDER BY tanggal DESC
        LIMIT 5
    ");

    $stmt->execute([$user]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function ringkasanKPI($user)
{
    $stmt = $this->db->prepare("
        SELECT
            COUNT(*) total,
            SUM(target) target,
            SUM(realisasi) realisasi,
            ROUND(AVG(nilai),2) nilai
        FROM kpi_nilai
        WHERE user_id=?
    ");

    $stmt->execute([$user]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function evidenceTerbaruSemua()
{
    $stmt = $this->db->prepare("
        SELECT

            e.id,
            e.tanggal,
            e.status,

            u.nama,

            j.nama_jabatan,

            COALESCE(mk.nama_kpi,e.target_kpi) AS nama_kpi

        FROM kpi_evidence e

        INNER JOIN users u
            ON u.id = e.user_id

        LEFT JOIN jabatan j
            ON j.id = e.jabatan_id

        LEFT JOIN master_kpi mk
            ON mk.id = e.kpi_id

        ORDER BY e.id DESC

        LIMIT 10
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}