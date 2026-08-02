<?php

require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/User.php';

class SiswaController
{
    private $siswa;

    public function __construct()
    {
        $this->siswa = new Siswa();
    }

    // ==========================
    // Daftar Siswa
    // ==========================
    public function index()
    {
        return $this->siswa->all();
    }

    // ==========================
    // Detail Siswa
    // ==========================
    public function edit($id)
    {
        return $this->siswa->find($id);
    }

    // ==========================
    // Daftar Kelas
    // ==========================
    public function getKelas()
    {
        return $this->siswa->getKelas();
    }

    // ==========================
    // Simpan Siswa
    // ==========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        if (empty($_POST['nama'])) {
            $_SESSION['error'] = "Nama siswa wajib diisi.";
            redirect("siswa.php?action=create");
        }

        if (empty($_POST['username'])) {
            $_SESSION['error'] = "Username wajib diisi.";
            redirect("siswa.php?action=create");
        }

        if (empty($_POST['password'])) {
            $_SESSION['error'] = "Password wajib diisi.";
            redirect("siswa.php?action=create");
        }

        $userModel = new User();

        if ($userModel->findByUsername($_POST['username'])) {

            $_SESSION['error'] = "Username sudah digunakan.";

            redirect("siswa.php?action=create");
        }

        $data = [

            'nama'             => trim($_POST['nama']),
            'username'         => trim($_POST['username']),
            'password'         => $_POST['password'],

            'kelas_id'         => $_POST['kelas_id'],

            'nis'              => trim($_POST['nis']),
            'nisn'             => trim($_POST['nisn']),
            'jenis_kelamin'    => $_POST['jenis_kelamin'],
            'tempat_lahir'     => trim($_POST['tempat_lahir']),
            'tanggal_lahir'    => $_POST['tanggal_lahir'],
            'alamat'           => trim($_POST['alamat']),
            'no_hp'            => trim($_POST['no_hp']),
            'nama_ortu'        => trim($_POST['nama_ortu'])

        ];

        $user_id = $this->siswa->createUser($data);

        $data['user_id'] = $user_id;

        $this->siswa->createSiswa($data);

        $_SESSION['success'] = "Data siswa berhasil disimpan.";

        redirect("siswa.php");
    }

    // ==========================
    // Update Siswa
    // ==========================
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $data = [

            'kelas_id'         => $_POST['kelas_id'],
            'nis'              => trim($_POST['nis']),
            'nisn'             => trim($_POST['nisn']),
            'nama'             => trim($_POST['nama']),
            'jenis_kelamin'    => $_POST['jenis_kelamin'],
            'tempat_lahir'     => trim($_POST['tempat_lahir']),
            'tanggal_lahir'    => $_POST['tanggal_lahir'],
            'alamat'           => trim($_POST['alamat']),
            'no_hp'            => trim($_POST['no_hp']),
            'nama_ortu'        => trim($_POST['nama_ortu'])

        ];

        $this->siswa->updateSiswa($id, $data);

        $_SESSION['success'] = "Data siswa berhasil diperbarui.";

        redirect("siswa.php");
    }

    // ==========================
    // Hapus Siswa
    // ==========================
    public function delete($id)
    {
        $this->siswa->deleteSiswa($id);

        $_SESSION['success'] = "Data siswa berhasil dihapus.";

        redirect("siswa.php");
    }
}