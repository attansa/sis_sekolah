<?php

require_once __DIR__.'/../config/database.php';

class Evidence
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ======================================
    // Semua Evidence
    // ======================================

   public function all()
{
    $stmt = $this->db->prepare("
        SELECT
            e.*,
            u.nama,
            u.role,
            mk.nama_kpi

        FROM kpi_evidence e

        INNER JOIN users u
            ON u.id = e.user_id

        INNER JOIN master_kpi mk
            ON mk.id = e.kpi_id

        ORDER BY e.id DESC
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    // ======================================
    // Evidence Guru Login
    // ======================================

    public function guru($user)
{
    $stmt = $this->db->prepare("
        SELECT

            e.*,
            u.nama,
            u.role,
            k.nama_kpi

        FROM kpi_evidence e

        INNER JOIN users u
            ON u.id = e.user_id

        INNER JOIN master_kpi k
            ON k.id = e.kpi_id

        WHERE e.user_id = ?

        ORDER BY e.id DESC
    ");

    $stmt->execute([$user]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // ======================================
    // Detail
    // ======================================

public function find($id)
{

    $stmt = $this->db->prepare("

        SELECT

            e.*,

            u.nama,

            u.role,

            j.nama_jabatan,

            mk.kode,

            mk.nama_kpi,

            verifikator.nama AS approver

        FROM kpi_evidence e

        INNER JOIN users u

            ON u.id = e.user_id

        LEFT JOIN jabatan j

            ON j.id = e.jabatan_id

        INNER JOIN master_kpi mk

            ON mk.id = e.kpi_id

        LEFT JOIN users verifikator

            ON verifikator.id = e.approved_by

        WHERE e.id = ?

        LIMIT 1

    ");

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);

}
    // ======================================
    // Simpan
    // ======================================

  public function create($data)
{

    $stmt = $this->db->prepare("

        INSERT INTO kpi_evidence
        (

            user_id,
            jabatan_id,
            kpi_id,
            target_kpi,
            tanggal,
            jobdesk,
            target,
            realisasi,
            deskripsi,
            file_bukti,
            status

        )

        VALUES
        (

            :user_id,
            :jabatan_id,
            :kpi_id,
            :target_kpi,
            :tanggal,
            :jobdesk,
            :target,
            :realisasi,
            :deskripsi,
            :file_bukti,
            'pending'

        )

    ");

    return $stmt->execute([

        ':user_id'     => $data['user_id'],
        ':jabatan_id'  => $data['jabatan_id'],
        ':kpi_id'      => $data['kpi_id'],
        ':target_kpi'  => $data['target_kpi'],
        ':tanggal'     => $data['tanggal'],
        ':jobdesk'     => $data['jobdesk'],
        ':target'      => $data['target'],
        ':realisasi'   => $data['realisasi'],
        ':deskripsi'   => $data['deskripsi'],
        ':file_bukti'  => $data['file_bukti']

    ]);

}
    // ======================================
    // Update
    // ======================================

public function update($id,$data)
{
    $stmt = $this->db->prepare("
        UPDATE kpi_evidence
        SET
            target_kpi=?,
            tanggal=?,
            jobdesk=?,
            target=?,
            realisasi=?,
            deskripsi=?,
            file_bukti=?
        WHERE id=?
    ");

    return $stmt->execute([

        $data['target_kpi'],
        $data['tanggal'],
        $data['jobdesk'],
        $data['target'],
        $data['realisasi'],
        $data['deskripsi'],
        $data['file_bukti'],
        $id

    ]);
}

    // ======================================
    // Approve
    // ======================================

    public function approve($id,$admin)
    {

        $stmt=$this->db->prepare("
            UPDATE kpi_evidence

            SET

                status='approve',
                approved_by=?,
                approved_at=NOW()

            WHERE id=?
        ");

        return $stmt->execute([$admin,$id]);

    }

    // ======================================
    // Revisi
    // ======================================

public function revisi($id,$catatan)
{
    $stmt = $this->db->prepare("
        UPDATE kpi_evidence
        SET
            status='revisi',
            catatan=?,
            approved_by=?,
            approved_at=NOW()
        WHERE id=?
    ");

    return $stmt->execute([
        $catatan,
        $_SESSION['id'],
        $id
    ]);
}
    // ======================================
    // Ditolak
    // ======================================

  public function tolak($id,$catatan)
{
   $stmt = $this->db->prepare("
    UPDATE kpi_evidence
    SET
        status='ditolak',
        catatan=?,
        approved_by=?,
        approved_at=NOW()
    WHERE id=?
");

return $stmt->execute([
    $catatan,
    $_SESSION['id'],
    $id
]);
}

    // ======================================
    // Hapus
    // ======================================

    public function delete($id)
    {

        $stmt=$this->db->prepare("
            DELETE
            FROM kpi_evidence
            WHERE id=?
        ");

        return $stmt->execute([$id]);

    }

    // ======================================
    // KPI sesuai Jabatan
    // ======================================

    // public function getKPIJabatan($jabatan)
    // {

    //     $stmt=$this->db->prepare("
    //         SELECT

    //             mk.*

    //         FROM kpi_jabatan kj

    //         INNER JOIN master_kpi mk

    //             ON mk.id=kj.kpi_id

    //         WHERE kj.jabatan_id=?

    //         ORDER BY mk.kode
    //     ");

    //     $stmt->execute([$jabatan]);

    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);

    // }
    // ======================================
// Detail KPI
// ======================================

public function getDetailKPI($id)
{
    $stmt = $this->db->prepare("
        SELECT
            mk.*,
            kj.target
        FROM master_kpi mk

        INNER JOIN kpi_jabatan kj

            ON kj.kpi_id = mk.id

        WHERE mk.id = ?

        LIMIT 1
    ");

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function getKPI()
{
    $stmt = $this->db->prepare("
        SELECT
            id,
            kode,
            nama_kpi
        FROM master_kpi
        WHERE status='aktif'
        ORDER BY kode ASC
    ");

    $stmt->execute();
   
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function pending()
{

    $stmt=$this->db->prepare("

        SELECT

            e.*,

            u.nama,

            j.nama_jabatan,

            mk.nama_kpi

        FROM kpi_evidence e

        INNER JOIN users u

            ON u.id=e.user_id

        LEFT JOIN jabatan j

            ON j.id=e.jabatan_id

        INNER JOIN master_kpi mk

            ON mk.id=e.kpi_id

        WHERE e.status='pending'

        ORDER BY e.id DESC

    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
// ======================================
// KPI Default Berdasarkan Jabatan
// ======================================
// ======================================
// KPI Default Berdasarkan Jabatan
// ======================================
public function getKPIDefault($jabatan_id)
{
    // Cari KPI sesuai jabatan
    $stmt = $this->db->prepare("
        SELECT
            kj.kpi_id,
            mk.nama_kpi
        FROM kpi_jabatan kj
        INNER JOIN master_kpi mk
            ON mk.id = kj.kpi_id
        WHERE kj.jabatan_id = ?
        LIMIT 1
    ");

    $stmt->execute([$jabatan_id]);

    $hasil = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika jabatan belum memiliki KPI,
    // ambil KPI pertama yang aktif
    if(!$hasil){

        $stmt = $this->db->prepare("
            SELECT
                id AS kpi_id,
                nama_kpi
            FROM master_kpi
            WHERE status='aktif'
            ORDER BY id ASC
            LIMIT 1
        ");

        $stmt->execute();

        $hasil = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $hasil;
}
}