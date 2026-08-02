<?php

require_once __DIR__ . '/../config/database.php';

class TargetKPI
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ==========================
    // Semua Target KPI
    // ==========================
  public function all()
{
    $stmt = $this->db->prepare("

        SELECT

            kt.id,

            u.nama,

            mk.nama_kpi,

            mk.bobot,

            kt.target,

            kt.tahun_pelajaran_id,

            kt.semester_id

        FROM kpi_target kt


        INNER JOIN users u

            ON u.id = kt.user_id


        INNER JOIN master_kpi mk

            ON mk.id = kt.kpi_id


        ORDER BY kt.id DESC

    ");


    $stmt->execute();


    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // ==========================
    // Semua Guru & Staff
    // ==========================
    public function getUsers()
    {
        $stmt = $this->db->prepare("
            SELECT
                id,
                nama,
                role
            FROM users
            WHERE role IN ('guru','staff')
            ORDER BY nama
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==========================
    // Semua KPI
    // ==========================
    public function getMasterKPI($role='guru')
    {
        $stmt=$this->db->prepare("
            SELECT *
            FROM master_kpi
            WHERE
                kategori='semua'
                OR kategori=?
            ORDER BY id
        ");

        $stmt->execute([$role]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==========================
    // Cek Sudah Ada
    // ==========================
    public function exists($user,$tp,$semester,$kpi)
    {
        $stmt=$this->db->prepare("
            SELECT id
            FROM kpi_target

            WHERE

            user_id=?
            AND tahun_pelajaran_id=?
            AND semester_id=?
            AND kpi_id=?

            LIMIT 1
        ");

        $stmt->execute([$user,$tp,$semester,$kpi]);

        return $stmt->fetch();
    }

    // ==========================
    // Simpan
    // ==========================
    public function create($data)
    {
        $stmt=$this->db->prepare("
            INSERT INTO kpi_target
            (

                user_id,
                tahun_pelajaran_id,
                semester_id,
                kpi_id,
                target

            )

            VALUES
            (?,?,?,?,?)
        ");

        return $stmt->execute([

            $data['user_id'],
            $data['tahun_pelajaran_id'],
            $data['semester_id'],
            $data['kpi_id'],
            $data['target']

        ]);
    }
    // ==========================================
// Generate Nilai KPI Awal
// ==========================================
public function generateNilai($data)
{

    $stmt = $this->db->prepare("

        INSERT INTO kpi_nilai
        (
            user_id,
            kpi_id,
            tahun_pelajaran_id,
            semester_id,
            nilai,
            keterangan
        )

        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            0,
            'Belum dinilai'
        )

    ");


    return $stmt->execute([

        $data['user_id'],

        $data['kpi_id'],

        $data['tahun_pelajaran_id'],

        $data['semester_id']

    ]);

}

}