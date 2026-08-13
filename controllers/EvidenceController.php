<?php

require_once __DIR__.'/../models/Evidence.php';
require_once __DIR__.'/../models/KPIAuto.php';

class EvidenceController
{

    private $evidence;
    private $auto;

    public function __construct()
    {
        $this->evidence = new Evidence();
        $this->auto     = new KPIAuto();
    }

    // ==========================================
    // List Evidence
    // ==========================================
   public function index()
{
    $role = userRole();

    // ==========================================
    // GURU & STAFF
    // Hanya melihat evidence miliknya sendiri
    // ==========================================

    if ($role == 'guru' || $role == 'staff') {

        return $this->evidence->guru($_SESSION['id']);

    }


    // ==========================================
    // KEPSEK & SDM
    // Melihat semua evidence
    // dan dapat melakukan approval
    // ==========================================

    if ($role == 'kepsek' || $role == 'sdm') {

        return $this->evidence->all();

    }


    // ==========================================
    // SUPER ADMIN
    // ==========================================

    if ($role == 'superadmin') {

        return $this->evidence->all();

    }


    // ==========================================
    // DEFAULT
    // ==========================================

    return [];
}

    // ==========================================
    // Form Tambah
    // ==========================================

  public function create()
{
    $user = [

        'id'         => $_SESSION['id'],
        'nama'       => $_SESSION['nama'],
        'jabatan'    => $_SESSION['jabatan'],
        'jabatan_id' => $_SESSION['jabatan_id']

    ];

    $kpi = $this->evidence->getKPI();

    return [

        'user'=>$user,
        'kpi'=>$kpi

    ];
}
    // ==========================================
    // Detail Evidence
    // ==========================================
    public function detail($id)
    {

        return $this->evidence->find($id);

    }

    // ==========================================
    // Edit Evidence
    // ==========================================
    public function edit($id)
    {

        return $this->evidence->find($id);

    }

    // ==========================================
    // Ambil Master KPI
    // ==========================================
    public function getKPI()
    {

        return $this->evidence->getKPI();

    }
    // ==========================================
// Simpan Evidence
// ==========================================
public function store()
{
// echo "<pre>";
//     print_r($_POST);
//     die();

    if($_SERVER['REQUEST_METHOD']!='POST'){
        return;
    }

    $file = "";

    if(!empty($_FILES['file_bukti']['name'])){

        $folder = "uploads/evidence/";

        if(!is_dir($folder)){
            mkdir($folder,0777,true);
        }

        $nama = time()."_".basename($_FILES['file_bukti']['name']);

        move_uploaded_file(
            $_FILES['file_bukti']['tmp_name'],
            $folder.$nama
        );

        $file = $nama;
    }

    $data = [

        'user_id'     => $_SESSION['id'],

        'jabatan_id'  => $_SESSION['jabatan_id'],

        // ==========================
        // INI YANG DIUBAH
        // ==========================
        'kpi_id'      => $_POST['kpi_id'],

        'target_kpi'  => $_POST['target_kpi'],

        'tanggal'     => $_POST['tanggal'],

        'jobdesk'     => $_POST['jobdesk'],

        'target'      => $_POST['target'],

        'realisasi'   => $_POST['realisasi'],

        'deskripsi'   => $_POST['deskripsi'],

        'file_bukti'  => $file

    ];
//     echo "<pre>";
// print_r($_POST);
// exit;
    $this->evidence->create($data);

    $_SESSION['success']="Evidence berhasil dikirim.";

    redirect("evidence.php");
}
// ==========================================
// Update Evidence
// ==========================================
public function update($id)
{

    if($_SERVER['REQUEST_METHOD']!='POST'){
        return;
    }

    $evidence = $this->evidence->find($id);

    $file = $evidence['file_bukti'];

    if(!empty($_FILES['file_bukti']['name'])){

        $folder = "uploads/evidence/";

        if(!is_dir($folder)){
            mkdir($folder,0777,true);
        }

        $nama = time()."_".basename($_FILES['file_bukti']['name']);

        move_uploaded_file(

            $_FILES['file_bukti']['tmp_name'],

            $folder.$nama

        );

        $file = $nama;

    }

    $data = [

        'kpi_id'      => 0,

        'target_kpi'  => $_POST['target_kpi'],

        'tanggal'     => $_POST['tanggal'],

        'jobdesk'     => $_POST['jobdesk'],

        'target'      => $_POST['target'],

        'realisasi'   => $_POST['realisasi'],

        'deskripsi'   => $_POST['deskripsi'],

        'file_bukti'  => $file

    ];

    $this->evidence->update($id,$data);

    $_SESSION['success']="Evidence berhasil diperbarui.";

    redirect("evidence.php");

}
// ==========================================
// Approve Evidence
// ==========================================
public function approve($id)
{

    $this->evidence->approve($id,$_SESSION['id']);

    $row = $this->evidence->find($id);

    $nilai = 0;

    if($row['target'] > 0){

        $nilai = round(

            ($row['realisasi'] / $row['target']) * 100,

            2

        );

        if($nilai > 100){
            $nilai = 100;
        }

    }

    $this->auto->update(

        $row['user_id'],

        $row['kpi_id'],

        $nilai,

        $row['target'],

        $row['realisasi']

    );

    $_SESSION['success']="Evidence berhasil di-approve.";

    redirect("evidence.php");

}

// ==========================================
// Revisi Evidence
// ==========================================
public function revisi($id)
{

    if($_SERVER['REQUEST_METHOD']=="POST"){

        $this->evidence->revisi(

            $id,

            $_POST['catatan']

        );

        $_SESSION['success']="Evidence dikembalikan untuk revisi.";

        redirect("evidence.php");

    }

    $evidence = $this->evidence->find($id);

    include "views/evidence/revisi.php";

}

// ==========================================
// Tolak Evidence
// ==========================================
public function tolak($id)
{

    if($_SERVER['REQUEST_METHOD']=="POST"){

        $this->evidence->tolak(

            $id,

            $_POST['catatan']

        );

        $_SESSION['success']="Evidence ditolak.";

        redirect("evidence.php");

    }

    $evidence = $this->evidence->find($id);

    include "views/evidence/tolak.php";

}

// ==========================================
// Hapus Evidence
// ==========================================
public function delete($id)
{

    $this->evidence->delete($id);

    $_SESSION['success']="Evidence berhasil dihapus.";

    redirect("evidence.php");

}

// ==========================================
// Pending Evidence
// ==========================================
public function pending()
{

    return $this->evidence->pending();

}

}