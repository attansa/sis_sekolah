<?php

require_once __DIR__ . '/../config/database.php';

class PengaturanAbsensi
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ===============================
    // Ambil Pengaturan
    // ===============================
    public function get()
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM pengaturan_absensi
            LIMIT 1
        ");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===============================
    // Update Pengaturan
    // ===============================
    public function update($data)
    {
        $stmt = $this->db->prepare("
            UPDATE pengaturan_absensi
            SET
                jam_masuk=?,
                batas_terlambat=?,
                jam_pulang=?
            WHERE id=?
        ");

        return $stmt->execute([

            $data['jam_masuk'],
            $data['batas_terlambat'],
            $data['jam_pulang'],
            $data['id']

        ]);
    }
}