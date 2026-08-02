<?php

require_once __DIR__ . '/../config/database.php';

class Jabatan
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function all()
    {
        $stmt = $this->db->query("
            SELECT *
            FROM jabatan
            WHERE status='aktif'
            ORDER BY nama_jabatan ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}