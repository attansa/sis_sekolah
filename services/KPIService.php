<?php

require_once __DIR__ . '/../models/Kinerja.php';
require_once __DIR__ . '/../models/Jurnal.php';;
require_once __DIR__ . '/../models/Absensi.php';

class KPIService
{
    private $kinerja;
    private $jurnal;
    private $absensi;

    public function __construct()
    {
        $this->kinerja = new Kinerja();
        $this->jurnal = new Jurnal();
        $this->absensi = new Absensi();
    }

    public function updateSemua($user_id)
    {
        $this->updateKehadiran($user_id);
        $this->updateJurnal($user_id);
        $this->updateMateri($user_id);
        $this->updateTarget($user_id);
    }

    private function updateKehadiran($user_id)
    {
        // proses hitung KPI Kehadiran
    }

    private function updateJurnal($user_id)
    {
        // proses hitung KPI Jurnal
    }

    private function updateMateri($user_id)
    {
        // proses hitung KPI Materi
    }

    private function updateTarget($user_id)
    {
        // proses hitung KPI Target
    }
}