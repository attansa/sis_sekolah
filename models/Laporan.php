<?php

require_once __DIR__.'/../config/database.php';

class Laporan
{
    private $db;

    public function __construct()
    {
        $database=new Database();
        $this->db=$database->connect();
    }

    // ==========================
    // Laporan Absensi Guru
    // ==========================
    public function absensiGuru($mulai,$selesai)
    {
        $stmt=$this->db->prepare("

            SELECT

                users.nama,

                absensi.*

            FROM absensi

            INNER JOIN users

                ON users.id=absensi.user_id

            WHERE

                users.role='guru'

                AND

                absensi.tanggal
                BETWEEN ? AND ?

            ORDER BY absensi.tanggal DESC

        ");

        $stmt->execute([
            $mulai,
            $selesai
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }