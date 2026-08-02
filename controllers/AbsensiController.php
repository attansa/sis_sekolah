<?php

require_once __DIR__ . '/../models/Absensi.php';

class AbsensiController
{
    private $absensi;

    public function __construct()
    {
        $this->absensi = new Absensi();
    }

    // ==========================================
    // Dashboard Absensi
    // ==========================================
    public function dashboard()
    {
        $guru_hadir   = $this->absensi->guruHadirHariIni();
        $siswa_hadir  = $this->absensi->siswaHadirHariIni();
        $sudah_pulang = $this->absensi->sudahPulangHariIni();
        $belum_pulang = $this->absensi->belumPulangHariIni();
        $last_scan    = $this->absensi->lastScan();
        $riwayat      = $this->absensi->riwayatHariIni();
        $grafik = $this->absensi->grafik7Hari();
        ob_start();

        include __DIR__ . '/../views/absensi/dashboard.php';

        $content = ob_get_clean();

        include __DIR__ . '/../views/layouts/master.php';
    }

    // ==========================================
    // Monitoring Live
    // ==========================================
    public function monitoring()
    {
        $riwayat = $this->absensi->riwayatHariIni();

        ob_start();

        include __DIR__ . '/../views/absensi/monitoring.php';

        $content = ob_get_clean();

        include __DIR__ . '/../views/layouts/master.php';
    }

    // ==========================================
    // Rekap Absensi
    // ==========================================
    public function rekap()
    {
        $mulai  = $_GET['mulai'] ?? '';
        $sampai = $_GET['sampai'] ?? '';

        $rekap = $this->absensi->rekap($mulai, $sampai);

        ob_start();

        include __DIR__ . '/../views/absensi/rekap.php';

        $content = ob_get_clean();

        include __DIR__ . '/../views/layouts/master.php';
    }

    // ==========================================
    // Semua Absensi
    // ==========================================
public function index()
{
    if (userRole() == 'guru') {

        $data = $this->absensi->riwayatUser($_SESSION['id']);

        $statistik = [
            'hadir' => 0,
            'terlambat' => 0
        ];

        foreach ($data as $d) {

            if ($d['status'] == 'hadir') {
                $statistik['hadir']++;
            }

            if ($d['status'] == 'terlambat') {
                $statistik['terlambat']++;
            }
        }

    } else {

        $data = $this->absensi->hariIni();

        $statistik = [
            'hadir' => $this->absensi->jumlahHariIni(),
            'terlambat' => $this->absensi->jumlahTerlambat()
        ];
    }

    ob_start();

    include __DIR__ . '/../views/absensi/index.php';

    $content = ob_get_clean();

    include __DIR__ . '/../views/layouts/master.php';
}
    // ==========================================
    // Alias Semua Absensi
    // ==========================================
    public function all()
    {
        $this->index();
    }

    // ==========================================
    // Detail Absensi
    // ==========================================
    public function detail($id)
    {
        $absensi = $this->absensi->find($id);

        ob_start();

        include __DIR__ . '/../views/absensi/detail.php';

        $content = ob_get_clean();

        include __DIR__ . '/../views/layouts/master.php';
    }

    // ==========================================
    // Riwayat User
    // ==========================================
    public function riwayat($user_id)
    {
        $riwayat = $this->absensi->riwayatUser($user_id);

        ob_start();

        include __DIR__ . '/../views/absensi/riwayat.php';

        $content = ob_get_clean();

        include __DIR__ . '/../views/layouts/master.php';
    }

    // ==========================================
    // Statistik
    // ==========================================
    public function statistik()
    {
        return [

            'guru_hadir'   => $this->absensi->guruHadirHariIni(),

            'siswa_hadir'  => $this->absensi->siswaHadirHariIni(),

            'hadir'        => $this->absensi->jumlahHariIni(),

            'terlambat'    => $this->absensi->jumlahTerlambat(),

            'sudah_pulang' => $this->absensi->sudahPulangHariIni(),

            'belum_pulang' => $this->absensi->belumPulangHariIni()

        ];
    }

    // ==========================================
    // Hapus
    // ==========================================
    public function delete($id)
    {
        try {

            $this->absensi->delete($id);

            $_SESSION['success'] = "Data absensi berhasil dihapus.";

        } catch (Exception $e) {

            $_SESSION['error'] = $e->getMessage();

        }

        redirect('absensi.php');
    }

}