<?php

require_once __DIR__ . '/../models/Rfid.php';
require_once __DIR__ . '/../config/database.php';

class RfidController
{

    private $rfid;

    public function __construct()
    {
        $this->rfid = new Rfid();
    }

    // ==========================
    // Tampilkan Semua RFID
    // ==========================
   public function index()
{

    $rfids = $this->rfid->all();

    ob_start();

    include 'views/rfid/index.php';

    $content = ob_get_clean();

    include 'views/layouts/master.php';

}

    // ==========================
    // Ambil User
    // ==========================
    public function getUsers()
    {
        return $this->rfid->getUsers();
    }
    public function create()
{
    $users = $this->rfid->getUsers();

    ob_start();

    include 'views/rfid/create.php';

    $content = ob_get_clean();

    include 'views/layouts/master.php';
}
    // ==========================
    // Simpan RFID
    // ==========================
    public function store()
    {

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $uid = strtoupper(trim($_POST['uid'] ?? ''));
        $user_id = intval($_POST['user_id'] ?? 0);
        $status = $_POST['status'] ?? 'aktif';

        if ($uid == '' || $user_id == 0) {

            $_SESSION['error'] = "UID dan Pengguna wajib diisi.";

            redirect('rfid.php?action=create');
        }

        try {

            $this->rfid->create([

                'uid'      => $uid,
                'user_id'  => $user_id,
                'status'   => $status

            ]);

            // ==========================
            // Kosongkan RFID TEMP
            // ==========================

            $database = new Database();

            $db = $database->connect();

            $db->exec("DELETE FROM rfid_temp");

            $_SESSION['success'] = "RFID berhasil didaftarkan.";

        } catch (Exception $e) {

            $_SESSION['error'] = $e->getMessage();

        }

        redirect('rfid.php');

    }

    // ==========================
    // Edit RFID
    // ==========================
    public function edit($id)
    {
        return $this->rfid->find($id);
    }

    // ==========================
    // Update RFID
    // ==========================
    public function update($id)
    {

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $uid = strtoupper(trim($_POST['uid'] ?? ''));
        $user_id = intval($_POST['user_id'] ?? 0);
        $status = $_POST['status'] ?? 'aktif';

        if ($uid == '' || $user_id == 0) {

            $_SESSION['error'] = "UID dan Pengguna wajib diisi.";

            redirect("rfid.php?action=edit&id=".$id);

        }

        try {

            $this->rfid->update($id,[

                'uid'      => $uid,
                'user_id'  => $user_id,
                'status'   => $status

            ]);

            $_SESSION['success']="RFID berhasil diubah.";

        } catch(Exception $e){

            $_SESSION['error']=$e->getMessage();

        }

        redirect('rfid.php');

    }

    // ==========================
    // Hapus RFID
    // ==========================
    public function delete($id)
    {

        try{

            $this->rfid->delete($id);

            $_SESSION['success']="RFID berhasil dihapus.";

        }catch(Exception $e){

            $_SESSION['error']=$e->getMessage();

        }

        redirect('rfid.php');

    }

}