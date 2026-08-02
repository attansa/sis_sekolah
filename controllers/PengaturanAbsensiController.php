<?php

require_once __DIR__ . '/../models/PengaturanAbsensi.php';

class PengaturanAbsensiController
{
    private $model;

    public function __construct()
    {
        $this->model = new PengaturanAbsensi();
    }

    // ===============================
    // Tampilkan Halaman
    // ===============================
    public function index()
    {
        $pengaturan = $this->model->get();

        ob_start();

        include 'views/pengaturan_absensi/index.php';

        $content = ob_get_clean();

        include 'views/layouts/master.php';
    }

    // ===============================
    // Simpan
    // ===============================
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('pengaturan_absensi.php');
        }

        $data = [

            'id' => $_POST['id'],

            'jam_masuk' => $_POST['jam_masuk'],

            'batas_terlambat' => $_POST['batas_terlambat'],

            'jam_pulang' => $_POST['jam_pulang']

        ];

        $this->model->update($data);

        $_SESSION['success'] = "Pengaturan berhasil diperbarui.";

        redirect('pengaturan_absensi.php');
    }
}