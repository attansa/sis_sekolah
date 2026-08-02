<?php

require_once __DIR__ . '/../models/Kelas.php';


class KelasController
{

    private $kelas;


    public function __construct()
    {
        $this->kelas = new Kelas();
    }



    // ==========================
    // Menampilkan semua kelas
    // ==========================
    public function index()
    {
        return $this->kelas->all();
    }




    // ==========================
    // Detail kelas
    // ==========================
    public function edit($id)
    {
        return $this->kelas->find($id);
    }





    // ==========================
    // Simpan kelas
    // ==========================
    public function store()
    {

        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            return;
        }


        $data = [

            'nama_kelas' => trim($_POST['nama_kelas']),

            'tingkat' => $_POST['tingkat'],

            'jurusan' => trim($_POST['jurusan']),

            'wali_kelas_id' => $_POST['wali_kelas_id']

        ];



        $this->kelas->create($data);



        $_SESSION['success'] = "Data kelas berhasil ditambahkan.";


        redirect('kelas.php');


    }







    // ==========================
    // Update kelas
    // ==========================
    public function update($id)
    {

        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            return;
        }



        $data = [

            'nama_kelas' => trim($_POST['nama_kelas']),

            'tingkat' => $_POST['tingkat'],

            'jurusan' => trim($_POST['jurusan']),

            'wali_kelas_id' => $_POST['wali_kelas_id']

        ];



        $this->kelas->update($id,$data);



        $_SESSION['success'] = "Data kelas berhasil diperbarui.";


        redirect('kelas.php');

    }






    // ==========================
    // Hapus kelas
    // ==========================
    public function delete($id)
    {

        $this->kelas->delete($id);


        $_SESSION['success'] = "Data kelas berhasil dihapus.";


        redirect('kelas.php');

    }
public function getGuru()
{
    return $this->kelas->getGuru();
}


}