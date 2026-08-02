<?php

require_once __DIR__ . '/../config/database.php';


class Kelas
{

    private $db;


    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }



    // Ambil semua kelas
    public function all()
    {
        $sql = "
            SELECT
                kelas.*,
                guru.nama AS nama_wali
            FROM kelas
            LEFT JOIN guru
                ON guru.id = kelas.wali_kelas_id
            ORDER BY
                tingkat,
                nama_kelas ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Detail kelas

    public function find($id)
    {

        $stmt = $this->db->prepare("
            SELECT *
            FROM kelas
            WHERE id=?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    // Simpan kelas

    public function create($data)
    {

        $stmt = $this->db->prepare("
            INSERT INTO kelas
            (
                nama_kelas,
                tingkat,
                jurusan,
                wali_kelas_id,
                status
            )
            VALUES
            (?,?,?,?,?)
        ");


        return $stmt->execute([

            $data['nama_kelas'],
            $data['tingkat'],
            $data['jurusan'],
            $data['wali_kelas_id'],
            'aktif'

        ]);

    }





    // Update kelas

    public function update($id,$data)
    {

        $stmt = $this->db->prepare("
            UPDATE kelas SET

            nama_kelas=?,
            tingkat=?,
            jurusan=?,
            wali_kelas_id=?,

            WHERE id=?

        ");


        return $stmt->execute([

            $data['nama_kelas'],
            $data['tingkat'],
            $data['jurusan'],
           $data['wali_kelas_id'],
            $id

        ]);

    }





    // Hapus kelas

    public function delete($id)
    {

        $stmt = $this->db->prepare("
            DELETE FROM kelas
            WHERE id=?
        ");


        return $stmt->execute([$id]);

    }
    public function getGuru()
{
    $sql = "
        SELECT
            id,
            nama
        FROM guru
        WHERE status='aktif'
        ORDER BY nama ASC
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}