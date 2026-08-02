<?php

require_once __DIR__.'/../models/KPILaporan.php';

class KPILaporanController
{

    private $laporan;

    public function __construct()
    {
        $this->laporan = new KPILaporan();
    }

    public function index()
    {
        return $this->laporan->all();
    }

    public function detail($id)
    {
        return $this->laporan->detail($id);
    }
    public function summary()
    {
        return $this->laporan->summary();
    }

}