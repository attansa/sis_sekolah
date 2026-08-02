<?php

require_once __DIR__ . '/../models/KPI.php';

class KPIController
{
    private $kpi;

    public function __construct()
    {
        $this->kpi = new KPI();
    }

    // ==========================
    // Daftar KPI
    // ==========================
    public function index()
    {
        return $this->kpi->all();
    }

    // ==========================
    // Detail KPI
    // ==========================
    public function edit($id)
    {
        return $this->kpi->find($id);
    }

    // ==========================
    // Simpan KPI
    // ==========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        if (empty($_POST['kode'])) {

            $_SESSION['error'] = "Kode KPI wajib diisi.";

            redirect("kpi_master.php?action=create");

        }

        if (empty($_POST['nama_kpi'])) {

            $_SESSION['error'] = "Nama KPI wajib diisi.";

            redirect("kpi_master.php?action=create");

        }

        $data = [

            'kode'            => trim($_POST['kode']),
            'nama_kpi'        => trim($_POST['nama_kpi']),
            'kategori'        => $_POST['kategori'],
            'sumber_data'     => $_POST['sumber_data'],
            'bobot'           => $_POST['bobot'],
            'target_default'  => $_POST['target_default'],
            'deskripsi'       => trim($_POST['deskripsi']),
            'status'          => $_POST['status']

        ];

        $this->kpi->create($data);

        $_SESSION['success'] = "Master KPI berhasil ditambahkan.";

        redirect("kpi_master.php");
    }

    // ==========================
    // Update KPI
    // ==========================
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $data = [

            'kode'            => trim($_POST['kode']),
            'nama_kpi'        => trim($_POST['nama_kpi']),
            'kategori'        => $_POST['kategori'],
            'sumber_data'     => $_POST['sumber_data'],
            'bobot'           => $_POST['bobot'],
            'target_default'  => $_POST['target_default'],
            'deskripsi'       => trim($_POST['deskripsi']),
            'status'          => $_POST['status']

        ];

        $this->kpi->update($id, $data);

        $_SESSION['success'] = "Master KPI berhasil diperbarui.";

        redirect("kpi_master.php");
    }

    // ==========================
    // Hapus KPI
    // ==========================
    public function delete($id)
    {
        $this->kpi->delete($id);

        $_SESSION['success'] = "Master KPI berhasil dihapus.";

        redirect("kpi_master.php");
    }
}