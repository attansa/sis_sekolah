<?php

require_once __DIR__ . '/../config/database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Rfid
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ==========================
    // Semua Data RFID
    // ==========================

    public function all()
    {

        $sql = "

        SELECT

            r.*,

            u.nama,

            u.role

        FROM rfid_cards r

        LEFT JOIN users u
        ON u.id = r.user_id

        ORDER BY u.nama ASC

        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // ==========================
    // Data User
    // ==========================

    public function getUsers()
    {

        $sql = "

        SELECT

            id,
            nama,
            role

        FROM users

        WHERE status='aktif'

        ORDER BY nama ASC

        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
public function create($data)
{

    // ==========================
    // Cek User
    // ==========================

    $cekUser = $this->db->prepare("
        SELECT id
        FROM rfid_cards
        WHERE user_id=?
        LIMIT 1
    ");

    $cekUser->execute([
        $data['user_id']
    ]);

    if($cekUser->fetch()){

        throw new Exception("Pengguna sudah memiliki kartu RFID.");

    }

    // ==========================
    // Cek UID
    // ==========================

    $cekUid = $this->db->prepare("
        SELECT id
        FROM rfid_cards
        WHERE uid=?
        LIMIT 1
    ");

    $cekUid->execute([
        strtoupper($data['uid'])
    ]);

    if($cekUid->fetch()){

        throw new Exception("UID RFID sudah digunakan.");

    }

    // ==========================
    // Simpan
    // ==========================

    $stmt = $this->db->prepare("
        INSERT INTO rfid_cards
        (
            uid,
            user_id,
            status
        )
        VALUES
        (
            ?,?,?
        )
    ");

    return $stmt->execute([

        strtoupper($data['uid']),

        $data['user_id'],

        $data['status']

    ]);

}


    // ==========================
    // Detail
    // ==========================

    public function find($id)
    {

        $stmt = $this->db->prepare("

            SELECT *

            FROM rfid_cards

            WHERE id=?

        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    // ==========================
    // Update
    // ==========================

public function update($id,$data)
{

    $cek = $this->db->prepare("
        SELECT id
        FROM rfid_cards
        WHERE uid=?
        AND id<>?
        LIMIT 1
    ");

    $cek->execute([
        strtoupper($data['uid']),
        $id
    ]);

    if($cek->fetch()){

        throw new Exception("UID RFID sudah digunakan.");

    }

    $stmt = $this->db->prepare("
        UPDATE rfid_cards
        SET

            uid=?,
            user_id=?,
            status=?

        WHERE id=?
    ");

    return $stmt->execute([

        strtoupper($data['uid']),

        $data['user_id'],

        $data['status'],

        $id

    ]);

}

    // ==========================
    // Hapus
    // ==========================

    public function delete($id)
    {

        $stmt = $this->db->prepare("

            DELETE FROM rfid_cards

            WHERE id=?

        ");

        return $stmt->execute([$id]);

    }

}