<?php

require_once __DIR__ . '/../config/database.php';

class Jurnal
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // =====================================
    // Semua Jurnal
    // =====================================
    public function all()
{
    $stmt = $this->db->prepare("
        SELECT
            jm.*,
            u.nama,
            k.nama_kelas
        FROM jurnal_mengajar jm

        INNER JOIN users u
            ON u.id = jm.user_id

        INNER JOIN kelas k
            ON k.id = jm.kelas_id

        ORDER BY jm.tanggal DESC,
                 jm.id DESC
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    // =====================================
    // Jurnal Guru Login
    // =====================================
    public function byUser($user_id)
    {
        $stmt = $this->db->prepare("
            SELECT
                jm.*,
                k.nama_kelas
            FROM jurnal_mengajar jm
            INNER JOIN kelas k
                ON k.id = jm.kelas_id
            WHERE jm.user_id = ?
            ORDER BY jm.tanggal DESC
        ");

        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =====================================
    // Cari Berdasarkan ID
    // =====================================
    public function find($id)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM jurnal_mengajar
            WHERE id=?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // =====================================
    // Data Kelas
    // =====================================
    public function getKelas()
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM kelas
            WHERE status='aktif'
            ORDER BY nama_kelas
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =====================================
    // Simpan
    // =====================================
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO jurnal_mengajar
            (
                user_id,
                kelas_id,
                tanggal,
                judul_materi,
                target_pembelajaran,
                uraian_kegiatan,
                refleksi,
                file_materi,
                status
            )

            VALUES
            (
                ?,?,?,?,?,?,?,?,?
            )
        ");

        return $stmt->execute([

            $data['user_id'],
            $data['kelas_id'],
            $data['tanggal'],
            $data['judul_materi'],
            $data['target_pembelajaran'],
            $data['uraian_kegiatan'],
            $data['refleksi'],
            $data['file_materi'],
            'terkirim'

        ]);
    }

    // =====================================
    // Update
    // =====================================
    public function update($id,$data)
    {
        $stmt = $this->db->prepare("
            UPDATE jurnal_mengajar

            SET

                kelas_id=?,
                tanggal=?,
                judul_materi=?,
                target_pembelajaran=?,
                uraian_kegiatan=?,
                refleksi=?,
                file_materi=?

            WHERE id=?
        ");

        return $stmt->execute([

            $data['kelas_id'],
            $data['tanggal'],
            $data['judul_materi'],
            $data['target_pembelajaran'],
            $data['uraian_kegiatan'],
            $data['refleksi'],
            $data['file_materi'],
            $id

        ]);
    }

    // =====================================
    // Hapus
    // =====================================
    public function delete($id)
    {
        $stmt = $this->db->prepare("
            DELETE FROM jurnal_mengajar
            WHERE id=?
        ");

        return $stmt->execute([$id]);
    }
// =====================================
// Jumlah Jurnal Guru
// =====================================
public function countJurnal($user_id)
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) total
        FROM jurnal_mengajar
        WHERE user_id=?
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}


// =====================================
// Jumlah Upload Materi
// =====================================
public function countMateri($user_id)
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) total
        FROM jurnal_mengajar

        WHERE user_id=?

        AND file_materi IS NOT NULL

        AND file_materi!=''
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}


// =====================================
// Jumlah Target Pembelajaran
// =====================================
public function countTarget($user_id)
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*) total
        FROM jurnal_mengajar

        WHERE user_id=?

        AND target_pembelajaran IS NOT NULL

        AND target_pembelajaran!=''
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}
public function guru($user_id)
{
    $stmt = $this->db->prepare("
        SELECT
            jm.*,
            u.nama,
            k.nama_kelas
        FROM jurnal_mengajar jm

        INNER JOIN users u
            ON u.id = jm.user_id

        INNER JOIN kelas k
            ON k.id = jm.kelas_id

        WHERE jm.user_id = ?

        ORDER BY jm.tanggal DESC,
                 jm.id DESC
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}