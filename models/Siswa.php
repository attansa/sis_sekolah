<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/User.php';

class Siswa
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ==========================
    // Semua siswa
    // ==========================
    public function all()
    {
        $sql = "
            SELECT
                siswa.*,
                users.username,
                users.role,
                kelas.nama_kelas
            FROM siswa
            LEFT JOIN users
                ON users.id = siswa.user_id
            LEFT JOIN kelas
                ON kelas.id = siswa.kelas_id
            ORDER BY siswa.nama ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==========================
    // Detail siswa
    // ==========================
    public function find($id)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM siswa
            WHERE id=?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ==========================
    // Ambil daftar kelas
    // ==========================
    public function getKelas()
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM kelas
            WHERE status='aktif'
            ORDER BY tingkat,nama_kelas
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==========================
    // Buat user
    // ==========================
    public function createUser($data)
    {
        $user = new User();

        return $user->create([
            'nama'      => $data['nama'],
            'username'  => $data['username'],
            'password'  => $data['password'],
            'role'      => 'siswa'
        ]);
    }

    // ==========================
    // Simpan siswa
    // ==========================
    public function createSiswa($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO siswa
            (
                user_id,
                kelas_id,
                nis,
                nisn,
                nama,
                jenis_kelamin,
                tempat_lahir,
                tanggal_lahir,
                alamat,
                no_hp,
                nama_ortu,
                status
            )
            VALUES
            (
                ?,?,?,?,?,?,?,?,?,?,?,?
            )
        ");

        return $stmt->execute([

            $data['user_id'],
            $data['kelas_id'],
            $data['nis'],
            $data['nisn'],
            $data['nama'],
            $data['jenis_kelamin'],
            $data['tempat_lahir'],
            $data['tanggal_lahir'],
            $data['alamat'],
            $data['no_hp'],
            $data['nama_ortu'],
            'aktif'

        ]);
    }

    // ==========================
    // Update siswa
    // ==========================
    public function updateSiswa($id,$data)
    {
        $stmt = $this->db->prepare("
            UPDATE siswa
            SET
                kelas_id=?,
                nis=?,
                nisn=?,
                nama=?,
                jenis_kelamin=?,
                tempat_lahir=?,
                tanggal_lahir=?,
                alamat=?,
                no_hp=?,
                nama_ortu=?
            WHERE id=?
        ");

        return $stmt->execute([

            $data['kelas_id'],
            $data['nis'],
            $data['nisn'],
            $data['nama'],
            $data['jenis_kelamin'],
            $data['tempat_lahir'],
            $data['tanggal_lahir'],
            $data['alamat'],
            $data['no_hp'],
            $data['nama_ortu'],
            $id

        ]);
    }

    // ==========================
    // Hapus siswa
    // ==========================
    public function deleteSiswa($id)
    {
        $stmt = $this->db->prepare("
            SELECT user_id
            FROM siswa
            WHERE id=?
        ");

        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return;
        }

        $user_id = $row['user_id'];

        $stmt = $this->db->prepare("
            DELETE FROM siswa
            WHERE id=?
        ");

        $stmt->execute([$id]);

        $stmt = $this->db->prepare("
            DELETE FROM users
            WHERE id=?
        ");

        $stmt->execute([$user_id]);
    }
}