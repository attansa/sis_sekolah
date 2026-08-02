<?php

require_once __DIR__.'/../models/Dashboard.php';

class DashboardController
{

    private $dashboard;

    public function __construct()
    {
        $this->dashboard=new Dashboard();
    }

public function index()
{
    $guru    = $this->dashboard->totalGuru();
    $siswa   = $this->dashboard->totalSiswa();
    $hadir   = $this->dashboard->hadirHariIni();
    $pulang  = $this->dashboard->pulangHariIni();
    $kpi     = $this->dashboard->totalKPI();
    $jurnal  = $this->dashboard->jurnalHariIni();
    $ranking = $this->dashboard->rankingGuru();

    ob_start();

switch(userRole()){

    case 'superadmin':
        include __DIR__.'/../views/dashboard/superadmin.php';
    break;

    case 'kepsek':

    $statistik = $this->dashboard->statistik();

    $grafik = $this->dashboard->grafikKPI();

    $ranking = $this->dashboard->topGuru();

    $aktivitas = $this->dashboard->aktivitas();

    $staff = $this->dashboard->totalStaff();

    $pending = $this->dashboard->evidencePending();

    $approve = $this->dashboard->evidenceApprove();

    $revisi = $this->dashboard->evidenceRevisi();

    $rata = $this->dashboard->rataKPI();

    // Kepsek melihat SEMUA evidence terbaru
    $evidence = $this->dashboard->evidenceTerbaru();

    include __DIR__.'/../views/dashboard/kepsek.php';

break;

    case 'guru':

    $evidence = $this->dashboard->evidenceTerbaru($_SESSION['id']);

    include __DIR__.'/../views/dashboard/guru.php';

break;

    case 'staff':

    $data = $this->staff();

    $statistik = $data['statistik'];
    $kpi       = $data['kpi'];
    $evidence  = $data['evidence'];
    $aktivitas = $data['aktivitas'];

    include __DIR__.'/../views/dashboard/staff.php';

    break;

    default:
        include __DIR__.'/../views/dashboard/default.php';
    break;
    case 'sdm':

$data = $this->dashboardKepsek();

include __DIR__.'/../views/dashboard/sdm.php';

break;
}

    $content = ob_get_clean();

    include __DIR__.'/../views/layouts/master.php';
}
public function dashboardKepsek()
{

    return [

        'statistik' => $this->dashboard->statistikKepsek(),

        'kpi'       => $this->dashboard->grafikKPI(),

        'guru'      => $this->dashboard->topGuru(),

        'aktivitas' => $this->dashboard->aktivitas()

    ];

}

public function dashboardSDM()
{

    return [

        'statistik'=>$this->dashboard->dashboardSDM(),

        'guru'=>$this->dashboard->topGuru(),

        'aktivitas'=>$this->dashboard->aktivitas()

    ];

}
public function staff()
{
    return [

        'statistik' => $this->dashboard->dashboardStaff($_SESSION['id']),

        'kpi' => $this->dashboard->ringkasanKPI($_SESSION['id']),

        'evidence' => $this->dashboard->evidenceTerbaru($_SESSION['id']),

        'aktivitas' => $this->dashboard->aktivitasUser($_SESSION['id'])

    ];
}
}