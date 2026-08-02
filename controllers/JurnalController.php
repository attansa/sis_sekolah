<?php

require_once __DIR__.'/../models/Jurnal.php';
require_once __DIR__.'/../models/KPIAuto.php';

class JurnalController
{
    private $jurnal;
    private $auto;

    public function __construct()
    {
        $this->jurnal = new Jurnal();
        $this->auto   = new KPIAuto();
    }

    // ===================================================
    // LIST JURNAL
    // ===================================================
    public function index()
    {
        if(userRole()=='guru'){

            return $this->jurnal->guru($_SESSION['id']);

        }

        return $this->jurnal->all();
    }

    // ===================================================
    // DATA KELAS
    // ===================================================
    public function getKelas()
    {
        return $this->jurnal->getKelas();
    }

    // ===================================================
    // EDIT
    // ===================================================
    public function edit($id)
    {
        return $this->jurnal->find($id);
    }

    // ===================================================
    // SIMPAN
    // ===================================================
    public function store()
{
    // Hanya Guru yang boleh
    if(userRole() != 'guru'){
        $_SESSION['error'] = "Anda tidak memiliki akses.";
        redirect("dashboard.php");
    }

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        return;
    }

    $fileMateri = "";

    if(!empty($_FILES['file_materi']['name'])){

        $folder = "uploads/materi/";

        if(!is_dir($folder)){
            mkdir($folder,0777,true);
        }

        $namaFile = time()."_".basename($_FILES['file_materi']['name']);

        move_uploaded_file(
            $_FILES['file_materi']['tmp_name'],
            $folder.$namaFile
        );

        $fileMateri = $namaFile;
    }

    $data = [

        'user_id' => $_SESSION['id'],

        'kelas_id' => $_POST['kelas_id'],

        'tanggal' => $_POST['tanggal'],

        'judul_materi' => $_POST['judul_materi'],

        'target_pembelajaran' => $_POST['target_pembelajaran'],

        'uraian_kegiatan' => $_POST['uraian_kegiatan'],

        'refleksi' => $_POST['refleksi'],

        'file_materi' => $fileMateri

    ];

    if($this->jurnal->create($data)){

        $this->updateKPI($_SESSION['id']);

        $_SESSION['success'] = "Jurnal berhasil disimpan.";

    }else{

        $_SESSION['error'] = "Jurnal gagal disimpan.";

    }

    redirect("jurnal.php");
}
    // ===================================================
// UPDATE
// ===================================================
public function update($id)
{

    if($_SERVER['REQUEST_METHOD']!='POST'){
        return;
    }

    $jurnal = $this->jurnal->find($id);

    $fileMateri = $jurnal['file_materi'];

    if(!empty($_FILES['file_materi']['name'])){

        $folder="uploads/materi/";

        if(!is_dir($folder)){
            mkdir($folder,0777,true);
        }

        $namaFile=time()."_".basename($_FILES['file_materi']['name']);

        move_uploaded_file(

            $_FILES['file_materi']['tmp_name'],

            $folder.$namaFile

        );

        $fileMateri=$namaFile;

    }

    $data=[

        'kelas_id'=>$_POST['kelas_id'],

        'tanggal'=>$_POST['tanggal'],

        'judul_materi'=>$_POST['judul_materi'],

        'target_pembelajaran'=>$_POST['target_pembelajaran'],

        'uraian_kegiatan'=>$_POST['uraian_kegiatan'],

        'refleksi'=>$_POST['refleksi'],

        'file_materi'=>$fileMateri

    ];

    $this->jurnal->update($id,$data);

    // Update KPI otomatis
    $this->updateKPI($_SESSION['id']);

    $_SESSION['success']="Jurnal berhasil diperbarui.";

    redirect("jurnal.php");

}


// ===================================================
// HAPUS
// ===================================================
public function delete($id)
{

    $this->jurnal->delete($id);

    // Hitung ulang KPI
    $this->updateKPI($_SESSION['id']);

    $_SESSION['success']="Jurnal berhasil dihapus.";

    redirect("jurnal.php");

}
// ===================================================
// UPDATE KPI OTOMATIS
// ===================================================
private function updateKPI($user_id)
{
    $target = 20;

    // ==========================
    // KPI 2 - Jurnal Mengajar
    // ==========================
    $realisasi = $this->jurnal->countJurnal($user_id);

    $nilai = 0;

    if($target > 0){
        $nilai = min(100, round(($realisasi / $target) * 100, 2));
    }

    $this->auto->update(
        $user_id,
        2,
        $nilai,
        $target,
        $realisasi
    );


    // ==========================
    // KPI 3 - Upload Materi
    // ==========================
    $realisasi = $this->jurnal->countMateri($user_id);

    $nilai = 0;

    if($target > 0){
        $nilai = min(100, round(($realisasi / $target) * 100, 2));
    }

    $this->auto->update(
        $user_id,
        3,
        $nilai,
        $target,
        $realisasi
    );


    // ==========================
    // KPI 4 - Target Pembelajaran
    // ==========================
    $realisasi = $this->jurnal->countTarget($user_id);

    $nilai = 0;

    if($target > 0){
        $nilai = min(100, round(($realisasi / $target) * 100, 2));
    }

    $this->auto->update(
        $user_id,
        4,
        $nilai,
        $target,
        $realisasi
    );

}
}