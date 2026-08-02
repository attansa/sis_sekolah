<?php

require_once __DIR__.'/../config/database.php';

class KPILaporan
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ===========================
    // Semua Nilai KPI
    // ===========================

    public function all()
    {
        $stmt = $this->db->prepare("
            SELECT

                u.id,
                u.nama,
                u.role,

                SUM(kn.target) target,
                SUM(kn.realisasi) realisasi,
                ROUND(AVG(kn.nilai),2) nilai,

                COUNT(kn.id) total_kpi

            FROM users u

            LEFT JOIN kpi_nilai kn

                ON kn.user_id=u.id

            WHERE u.role='guru'

            GROUP BY u.id

            ORDER BY nilai DESC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===========================
    // Detail Guru
    // ===========================

public function detail($user)
{
    $stmt = $this->db->prepare("
        SELECT

            mk.kode,
            mk.nama_kpi,

            kn.target,
            kn.realisasi,
            kn.nilai

        FROM kpi_nilai kn

        INNER JOIN master_kpi mk
            ON mk.id = kn.kpi_id

        WHERE kn.user_id = ?

        ORDER BY mk.kode
    ");

    $stmt->execute([$user]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// =============================
// Ringkasan KPI
// =============================
public function summary()
{
    $stmt = $this->db->prepare("
        SELECT

            COUNT(DISTINCT user_id) guru,

            COUNT(id) total_kpi,

            ROUND(AVG(nilai),2) rata,

            MAX(nilai) tertinggi,

            MIN(nilai) terendah

        FROM kpi_nilai
    ");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}