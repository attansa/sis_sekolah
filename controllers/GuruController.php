<?php

require_once __DIR__ . '/../models/Guru.php';
require_once __DIR__ . '/../models/Jabatan.php';
require_once __DIR__ . '/../models/User.php';

class GuruController
{
    private $guru;
    private $jabatan;
    private $user;

    public function __construct()
    {
        $this->guru = new Guru();
        $this->jabatan = new Jabatan();
        $this->user = new User();
    }

    // ==========================
    // Daftar Guru
    // ==========================
    public function index()
    {
        return $this->guru->all();
    }

    // ==========================
    // Daftar Jabatan
    // ==========================
    public function getJabatan()
    {
        return $this->jabatan->all();
    }

    // ==========================
    // Detail Guru
    // ==========================
    public function edit($id)
    {
        return $this->guru->find($id);
    }

    // ==========================
    // Simpan Guru
    // ==========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        // Validasi
        if (empty($_POST['nama'])) {
            $_SESSION['error'] = "Nama tidak boleh kosong.";
            redirect("guru.php?action=create");
        }

        if (empty($_POST['username'])) {
            $_SESSION['error'] = "Username tidak boleh kosong.";
            redirect("guru.php?action=create");
        }

        if (empty($_POST['password'])) {
            $_SESSION['error'] = "Password tidak boleh kosong.";
            redirect("guru.php?action=create");
        }

        if (empty($_POST['role'])) {
            $_SESSION['error'] = "Role harus dipilih.";
            redirect("guru.php?action=create");
        }

        if (empty($_POST['jabatan_id'])) {
            $_SESSION['error'] = "Jabatan harus dipilih.";
            redirect("guru.php?action=create");
        }

        $data = [

            'nama'            => trim($_POST['nama']),
            'username'        => trim($_POST['username']),
            'password'        => $_POST['password'],
            'role'            => $_POST['role'],

            'jabatan_id'      => $_POST['jabatan_id'],
            'nip'             => trim($_POST['nip']),
            'jenis_kelamin'   => $_POST['jenis_kelamin'] ?? '',
            'tempat_lahir'    => trim($_POST['tempat_lahir']),
            'tanggal_lahir'   => $_POST['tanggal_lahir'],
            'alamat'          => trim($_POST['alamat']),
            'no_hp'           => trim($_POST['no_hp']),
            'email'           => trim($_POST['email'])

        ];

        // Cek username
        if ($this->user->findByUsername($data['username'])) {

            $_SESSION['error'] = "Username sudah digunakan.";

            redirect("guru.php?action=create");

        }

        // Simpan user
        // $user_id = $this->guru->createUser($data);
        $user_id = $this->user->create($data);
        // Simpan guru
        $data['user_id'] = $user_id;

        $this->guru->createGuru($data);

        $_SESSION['success'] = "Data guru berhasil disimpan.";

        redirect("guru.php");
    }

    // ==========================
    // Update Guru
    // ==========================
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $data = [

            'nama'            => trim($_POST['nama']),
            'jabatan_id'      => $_POST['jabatan_id'],
            'nip'             => trim($_POST['nip']),
            'jenis_kelamin'   => $_POST['jenis_kelamin'],
            'tempat_lahir'    => trim($_POST['tempat_lahir']),
            'tanggal_lahir'   => $_POST['tanggal_lahir'],
            'alamat'          => trim($_POST['alamat']),
            'no_hp'           => trim($_POST['no_hp']),
            'email'           => trim($_POST['email'])

        ];

        $this->guru->updateGuru($id, $data);

        $_SESSION['success'] = "Data guru berhasil diperbarui.";

        redirect("guru.php");
    }

    // ==========================
    // Hapus Guru
    // ==========================
    public function delete($id)
    {
        $this->guru->deleteGuru($id);

        $_SESSION['success'] = "Data guru berhasil dihapus.";

        redirect("guru.php");
    }
}