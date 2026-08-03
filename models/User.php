<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ==========================
    // Login
    // ==========================
    public function login($username,$password)
{
    $stmt = $this->db->prepare("
    SELECT
        u.*,
        g.jabatan_id,
        j.nama_jabatan
    FROM users u

    LEFT JOIN guru g
        ON g.user_id = u.id

    LEFT JOIN jabatan j
        ON j.id = g.jabatan_id

    WHERE u.username = ?
    LIMIT 1
");

    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password,$user['password'])){
        return $user;
    }

    return false;
}
    // ==========================
    // Cek Username
    // ==========================
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("
            SELECT id
            FROM users
            WHERE username = ?
            LIMIT 1
        ");

        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ==========================
    // Tambah User
    // ==========================
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO users
            (
                nama,
                username,
                password,
                role,
                status
            )
            VALUES
            (
                ?,?,?,?,?
            )
        ");

        $stmt->execute([

            $data['nama'],
            $data['username'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['role'],
            'aktif'

        ]);

        return $this->db->lastInsertId();
    }

    // ==========================
    // Update User
    // ==========================
    public function update($id,$data)
    {
        $stmt = $this->db->prepare("
            UPDATE users
            SET
                nama=?,
                username=?,
                role=?
            WHERE id=?
        ");

        return $stmt->execute([

            $data['nama'],
            $data['username'],
            $data['role'],
            $id

        ]);
    }

    // ==========================
    // Hapus User
    // ==========================
    public function delete($id)
    {
        $stmt = $this->db->prepare("
            DELETE FROM users
            WHERE id=?
        ");

        return $stmt->execute([$id]);
    }
}