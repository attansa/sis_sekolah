<?php

require_once __DIR__ . '/../config/database.php';


class TahunPelajaran
{

    private $db;


    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }



    public function all()
    {

        $stmt = $this->db->prepare("

            SELECT *

            FROM tahun_pelajaran

            ORDER BY id DESC

        ");


        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



    public function aktif()
    {

        $stmt = $this->db->prepare("

            SELECT *

            FROM tahun_pelajaran

            WHERE status='aktif'

            LIMIT 1

        ");


        $stmt->execute();


        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


}