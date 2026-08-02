<?php

require_once __DIR__ . '/../models/TargetKPI.php';
require_once __DIR__ . '/../models/TahunPelajaran.php';


class TargetKPIController
{

    private $targetKpi;
    private $tahunPelajaran;



    public function __construct()
    {
        $this->targetKpi = new TargetKPI();

        $this->tahunPelajaran = new TahunPelajaran();
    }



    // ==========================
    // Tampilkan Data Target KPI
    // ==========================
    public function index()
    {
        return $this->targetKpi->all();
    }




    // ==========================
    // Data Guru / Staff
    // ==========================
    public function getUsers()
    {
        return $this->targetKpi->getUsers();
    }




    // ==========================
    // Data Master KPI
    // ==========================
    public function getKPI($role='guru')
    {
        return $this->targetKpi->getMasterKPI($role);
    }




    // ==========================
    // Data Tahun Pelajaran
    // ==========================
    public function getTahunPelajaran()
    {
        return $this->tahunPelajaran->all();
    }





    // ==========================
    // Simpan Target KPI
    // ==========================
    public function store()
    {

        if($_SERVER['REQUEST_METHOD'] != 'POST'){

            return;

        }



        $user_id = $_POST['user_id'] ?? null;

        $tahun = $_POST['tahun_pelajaran_id'] ?? null;

        $semester = $_POST['semester_id'] ?? null;



        if(
            empty($user_id) ||
            empty($tahun) ||
            empty($semester)
        ){


            $_SESSION['error'] =

            "Guru, Tahun Pelajaran dan Semester wajib dipilih.";


            redirect('target_kpi.php?action=create');

            exit;


        }




        if(!isset($_POST['kpi_id'])){


            $_SESSION['error'] =

            "Data KPI tidak ditemukan.";


            redirect('target_kpi.php?action=create');

            exit;


        }





        foreach($_POST['kpi_id'] as $index=>$kpi_id){



            $target = $_POST['target'][$index] ?? 100;



            // cek apakah sudah ada

            $cek = $this->targetKpi->exists(

                $user_id,

                $tahun,

                $semester,

                $kpi_id

            );




            if(!$cek){



                $data = [


                    'user_id' => $user_id,


                    'tahun_pelajaran_id' => $tahun,


                    'semester_id' => $semester,


                    'kpi_id' => $kpi_id,


                    'target' => $target


                ];



              $this->targetKpi->create($data);


// buat nilai awal KPI

$this->targetKpi->generateNilai($data);



            }



        }





        $_SESSION['success'] =

        "Target KPI berhasil disimpan.";



        redirect('target_kpi.php');

        exit;


    }



}