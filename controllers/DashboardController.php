<?php

require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController
{
    private $dashboard;

    public function __construct()
    {
        $this->dashboard = new Dashboard();
    }

    // =========================================================
    // DASHBOARD UTAMA
    // =========================================================
    public function index()
    {
        // Statistik umum
        $guru    = $this->dashboard->totalGuru();
        $siswa   = $this->dashboard->totalSiswa();
        $hadir   = $this->dashboard->hadirHariIni();
        $pulang  = $this->dashboard->pulangHariIni();
        $kpi     = $this->dashboard->totalKPI();
        $jurnal  = $this->dashboard->jurnalHariIni();
        $ranking = $this->dashboard->rankingGuru();

        ob_start();

        switch (userRole()) {

            // =================================================
            // SUPER ADMIN
            // =================================================
            case 'superadmin':

                include __DIR__ . '/../views/dashboard/superadmin.php';

                break;


            // =================================================
            // KEPSEK & SDM
            // =================================================
            case 'kepsek':
            case 'sdm':

                // Statistik
                $statistik = $this->dashboard->statistik();

                // Grafik KPI
                $grafik = $this->dashboard->grafikKPI();

                // Ranking Guru
                $ranking = $this->dashboard->topGuru();

                // Aktivitas
                $aktivitas = $this->dashboard->aktivitas();

                // Total Staff
                $staff = $this->dashboard->totalStaff();

                // Statistik Evidence
                $pending = $this->dashboard->evidencePending();
                $approve = $this->dashboard->evidenceApprove();
                $revisi  = $this->dashboard->evidenceRevisi();

                // Rata-rata KPI
                $rata = $this->dashboard->rataKPI();

                // Evidence terbaru SEMUA GURU
                $evidence = $this->dashboard->evidenceTerbaru();

                // SDM menggunakan dashboard yang sama dengan Kepsek
                include __DIR__ . '/../views/dashboard/kepsek.php';

                break;


            // =================================================
            // GURU
            // =================================================
            case 'guru':

                $evidence = $this->dashboard->evidenceTerbaru(
                    $_SESSION['id']
                );

                include __DIR__ . '/../views/dashboard/guru.php';

                break;


            // =================================================
            // STAFF
            // =================================================
            case 'staff':

                $data = $this->staff();

                $statistik = $data['statistik'];
                $kpi       = $data['kpi'];
                $evidence  = $data['evidence'];
                $aktivitas = $data['aktivitas'];

                include __DIR__ . '/../views/dashboard/staff.php';

                break;


            // =================================================
            // DEFAULT
            // =================================================
            default:

                include __DIR__ . '/../views/dashboard/default.php';

                break;
        }

        $content = ob_get_clean();

        include __DIR__ . '/../views/layouts/master.php';
    }


    // =========================================================
    // DATA DASHBOARD KEPSEK
    // =========================================================
    public function dashboardKepsek()
    {
        return [

            'statistik' => $this->dashboard->statistikKepsek(),

            'kpi' => $this->dashboard->grafikKPI(),

            'guru' => $this->dashboard->topGuru(),

            'aktivitas' => $this->dashboard->aktivitas()

        ];
    }


    // =========================================================
    // DATA DASHBOARD SDM
    // =========================================================
    public function dashboardSDM()
    {
        return [

            'statistik' => $this->dashboard->dashboardSDM(),

            'guru' => $this->dashboard->topGuru(),

            'aktivitas' => $this->dashboard->aktivitas()

        ];
    }


    // =========================================================
    // DATA DASHBOARD STAFF
    // =========================================================
    public function staff()
    {
        return [

            'statistik' => $this->dashboard->dashboardStaff(
                $_SESSION['id']
            ),

            'kpi' => $this->dashboard->ringkasanKPI(
                $_SESSION['id']
            ),

            'evidence' => $this->dashboard->evidenceTerbaru(
                $_SESSION['id']
            ),

            'aktivitas' => $this->dashboard->aktivitasUser(
                $_SESSION['id']
            )

        ];
    }
}