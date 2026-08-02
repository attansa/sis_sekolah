<?php

require_once __DIR__.'/../config/database.php';

class Kinerja
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ===================================
    // Update / Insert Nilai KPI
    // ===================================
    public function updateNilaiKPI($user_id,$kpi_id,$nilai)
    {
        $bulan = date('n');
        $tahun = date('Y');

        $cek = $this->db->prepare("
            SELECT id
            FROM kpi_nilai
            WHERE
                user_id=?
            AND
                kpi_id=?
            AND
                bulan=?
            AND
                tahun=?
        ");

        $cek->execute([
            $user_id,
            $kpi_id,
            $bulan,
            $tahun
        ]);

        if($cek->rowCount()){

            $update = $this->db->prepare("
                UPDATE kpi_nilai

                SET nilai=?

                WHERE

                    user_id=?

                AND

                    kpi_id=?

                AND

                    bulan=?

                AND

                    tahun=?
            ");

            return $update->execute([

                $nilai,
                $user_id,
                $kpi_id,
                $bulan,
                $tahun

            ]);

        }

        $insert = $this->db->prepare("
            INSERT INTO kpi_nilai
            (
                user_id,
                kpi_id,
                bulan,
                tahun,
                nilai
            )

            VALUES
            (
                ?,?,?,?,?
            )
        ");

        return $insert->execute([

            $user_id,
            $kpi_id,
            $bulan,
            $tahun,
            $nilai

        ]);
    }

    // ===================================
    // KPI Guru
    // ===================================
   public function nilaiGuru($user_id)
{
    $stmt = $this->db->prepare("
        SELECT

            mk.id,
            mk.kode,
            mk.nama_kpi,
            mk.bobot,

            COALESCE(kn.target,0) target,
            COALESCE(kn.realisasi,0) realisasi,
            COALESCE(kn.nilai,0) nilai,
            COALESCE(kn.status,'draft') status

        FROM master_kpi mk

        LEFT JOIN kpi_nilai kn

            ON mk.id = kn.kpi_id

            AND kn.user_id = ?

        WHERE mk.status='aktif'

        ORDER BY mk.kode
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // ===================================
    // Total Nilai KPI
    // ===================================
public function totalNilai($user)
{

    $stmt = $this->db->prepare("
        SELECT
            ROUND(AVG(nilai),2) total
        FROM kpi_nilai
        WHERE user_id=?
    ");

    $stmt->execute([$user]);

    $hasil = $stmt->fetch(PDO::FETCH_ASSOC);

    return $hasil['total'] ?? 0;

}
    // ===================================
    // Ranking Guru
    // ===================================
    public function ranking()
{

    $stmt = $this->db->prepare("
        SELECT

            u.nama,

            ROUND(AVG(kn.nilai),2) nilai

        FROM users u

        INNER JOIN kpi_nilai kn

            ON kn.user_id=u.id

        GROUP BY u.id

        ORDER BY nilai DESC
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function semuaGuru()
{
    $stmt = $this->db->prepare("
        SELECT

            u.nama,

            mk.kode,
            mk.nama_kpi,
            mk.bobot,

            kn.target,
            kn.realisasi,
            kn.nilai,
            kn.status

        FROM kpi_nilai kn

        INNER JOIN users u
            ON u.id = kn.user_id

        INNER JOIN master_kpi mk
            ON mk.id = kn.kpi_id

        ORDER BY u.nama,mk.kode
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function progress($user)
{

    $stmt = $this->db->prepare("
        SELECT

            mk.nama_kpi,

            kn.target,

            kn.realisasi,

            kn.nilai

        FROM kpi_nilai kn

        INNER JOIN master_kpi mk

            ON mk.id=kn.kpi_id

        WHERE kn.user_id=?

        ORDER BY mk.kode
    ");

    $stmt->execute([$user]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
public function totalGuru()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) total
        FROM users
        WHERE role='guru'
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}
public function guruUploadEvidence()
{
    $stmt = $this->db->prepare("
        SELECT COUNT(DISTINCT user_id) total
        FROM kpi_evidence
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}
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
public function topGuru()
{
    $stmt = $this->db->prepare("
        SELECT

            u.nama,

            ROUND(AVG(kn.nilai),2) nilai

        FROM users u

        INNER JOIN kpi_nilai kn

            ON kn.user_id=u.id

        WHERE u.role='guru'

        GROUP BY u.id

        ORDER BY nilai DESC

        LIMIT 5
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function kinerjaSaya($user_id)
{
    $stmt = $this->db->prepare("
        SELECT
            id,
            tanggal,
            target_kpi,
            target,
            realisasi,
            status
        FROM kpi_evidence
        WHERE user_id = ?
        ORDER BY tanggal DESC
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// ===================================
// Data Kinerja User (Guru / Staff)
// ===================================
public function user($user_id)
{
    $stmt = $this->db->prepare("
        SELECT
            id,
            tanggal,
            target_kpi,
            target,
            realisasi,
            status
        FROM kpi_evidence
        WHERE user_id = ?
        ORDER BY tanggal DESC
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ===================================
// Semua Data Kinerja
// ===================================
public function all()
{
    $stmt = $this->db->prepare("
        SELECT
            e.*,
            u.nama
        FROM kpi_evidence e
        INNER JOIN users u
            ON u.id = e.user_id
        ORDER BY e.tanggal DESC
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}