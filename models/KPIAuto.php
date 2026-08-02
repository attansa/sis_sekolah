<?php

require_once __DIR__.'/../config/database.php';

class KPIAuto
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // =====================================
    // Update Nilai KPI
    // =====================================

    public function update($user,$kpi,$nilai,$target,$realisasi)
    {

        $stmt = $this->db->prepare("
            SELECT id
            FROM kpi_nilai
            WHERE
                user_id=?
            AND
                kpi_id=?
            LIMIT 1
        ");

        $stmt->execute([$user,$kpi]);

        if($stmt->rowCount()>0){

            $id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

            $up = $this->db->prepare("
                UPDATE kpi_nilai
                SET

                    target=?,
                    realisasi=?,
                    nilai=?

                WHERE id=?
            ");

            $up->execute([

                $target,
                $realisasi,
                $nilai,
                $id

            ]);

        }else{

            $in = $this->db->prepare("
                INSERT INTO kpi_nilai
                (
                    user_id,
                    kpi_id,
                    tahun_pelajaran_id,
                    semester_id,
                    target,
                    realisasi,
                    nilai
                )
                VALUES
                (
                    ?,?,
                    1,
                    1,
                    ?,?,?
                )
            ");

            $in->execute([

                $user,
                $kpi,
                $target,
                $realisasi,
                $nilai

            ]);

        }

    }

}