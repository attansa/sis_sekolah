<?php

require_once __DIR__.'/../config/database.php';

class KPI
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ============================
    // Semua KPI
    // ============================
    public function all()
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM master_kpi
            ORDER BY kode ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ============================
    // Cari
    // ============================
    public function find($id)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM master_kpi
            WHERE id=?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ============================
    // Simpan
    // ============================
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO master_kpi
            (
                kode,
                nama_kpi,
                kategori,
                bobot,
                target_default,
                status
            )
            VALUES
            (
                ?,?,?,?,?,?
            )
        ");

        return $stmt->execute([

            $data['kode'],
            $data['nama_kpi'],
            $data['kategori'],
            $data['bobot'],
            $data['target_default'],
            $data['status']

        ]);
    }

    // ============================
    // Update
    // ============================
    public function update($id,$data)
    {
        $stmt = $this->db->prepare("
            UPDATE master_kpi
            SET

                kode=?,
                nama_kpi=?,
                kategori=?,
                bobot=?,
                target_default=?,
                status=?

            WHERE id=?
        ");

        return $stmt->execute([

            $data['kode'],
            $data['nama_kpi'],
            $data['kategori'],
            $data['bobot'],
            $data['target_default'],
            $data['status'],
            $id

        ]);
    }

    // ============================
    // Hapus
    // ============================
    public function delete($id)
    {
        $stmt = $this->db->prepare("
            DELETE FROM master_kpi
            WHERE id=?
        ");

        return $stmt->execute([$id]);
    }
}