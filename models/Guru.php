<?php

require_once __DIR__ . '/../config/database.php';


class Guru
{

    private $db;


    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }


    // ==========================
    // Ambil Semua Data Guru
    // ==========================
    public function all()
    {

        $sql = "
            SELECT

                guru.*,

                users.username,
                users.role,

                jabatan.nama_jabatan

            FROM guru

            INNER JOIN users
            ON users.id = guru.user_id

            INNER JOIN jabatan
            ON jabatan.id = guru.jabatan_id

            ORDER BY guru.nama ASC
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



    // ==========================
    // Detail Guru
    // ==========================
    public function find($id)
    {

        $sql = "

            SELECT

                guru.*,

                users.username,
                users.role

            FROM guru

            INNER JOIN users
            ON users.id = guru.user_id

            WHERE guru.id = ?

        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute([$id]);


        return $stmt->fetch(PDO::FETCH_ASSOC);

    }



    // ==========================
    // Simpan Data Guru
    // ==========================
    public function createGuru($data)
    {

        $sql = "

            INSERT INTO guru

            (
                user_id,
                jabatan_id,
                nama,
                nip,
                jenis_kelamin,
                tempat_lahir,
                tanggal_lahir,
                alamat,
                no_hp,
                email,
                status
            )

            VALUES

            (
                ?,?,?,?,?,?,?,?,?,?,?
            )

        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            $data['user_id'],

            $data['jabatan_id'],

            $data['nama'],

            $data['nip'],

            $data['jenis_kelamin'],

            $data['tempat_lahir'],

            $data['tanggal_lahir'],

            $data['alamat'],

            $data['no_hp'],

            $data['email'],

            'aktif'

        ]);

    }



    // ==========================
    // Update Guru
    // ==========================
    public function updateGuru($id,$data)
    {

        $sql = "

            UPDATE guru SET

                jabatan_id=?,

                nama=?,

                nip=?,

                jenis_kelamin=?,

                tempat_lahir=?,

                tanggal_lahir=?,

                alamat=?,

                no_hp=?,

                email=?

            WHERE id=?

        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            $data['jabatan_id'],

            $data['nama'],

            $data['nip'],

            $data['jenis_kelamin'],

            $data['tempat_lahir'],

            $data['tanggal_lahir'],

            $data['alamat'],

            $data['no_hp'],

            $data['email'],

            $id

        ]);

    }



    // ==========================
    // Hapus Guru
    // ==========================
    public function deleteGuru($id)
    {

        // Ambil user_id dahulu

        $guru = $this->find($id);


        if(!$guru)
        {
            return false;
        }


        // Hapus data guru

        $stmt = $this->db->prepare("
            DELETE FROM guru
            WHERE id=?
        ");


        $stmt->execute([$id]);



        // Hapus akun login

        $stmt = $this->db->prepare("
            DELETE FROM users
            WHERE id=?
        ");


        $stmt->execute([$guru['user_id']]);


        return true;

    }


}