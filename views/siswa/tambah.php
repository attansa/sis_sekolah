<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h3>Tambah Siswa</h3>
            </div>

            <div class="col-sm-6 text-right">

                <a href="<?= base_url('siswa.php') ?>" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</section>



<section class="content">

<div class="container-fluid">

<form method="POST"
action="<?= base_url('siswa.php?action=store') ?>">

<div class="card">

<div class="card-header bg-primary">

<h3 class="card-title">

Data Siswa

</h3>

</div>

<div class="card-body">

<?php if(isset($_SESSION['error'])): ?>

<div class="alert alert-danger">

<?= $_SESSION['error']; ?>

</div>

<?php unset($_SESSION['error']); ?>

<?php endif; ?>



<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
required>

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label>NIS</label>

<input
type="text"
name="nis"
class="form-control">

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label>NISN</label>

<input
type="text"
name="nisn"
class="form-control">

</div>

</div>

</div>



<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Kelas</label>

<select
name="kelas_id"
class="form-control"
required>

<option value="">-- Pilih Kelas --</option>

<?php foreach($kelas as $k): ?>

<option value="<?= $k['id']; ?>">

<?= $k['nama_kelas']; ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>



<div class="col-md-6">

<div class="form-group">

<label>Jenis Kelamin</label>

<select
name="jenis_kelamin"
class="form-control">

<option value="L">Laki-laki</option>

<option value="P">Perempuan</option>

</select>

</div>

</div>

</div>



<div class="row">

<div class="col-md-4">

<div class="form-group">

<label>Tempat Lahir</label>

<input
type="text"
name="tempat_lahir"
class="form-control">

</div>

</div>



<div class="col-md-4">

<div class="form-group">

<label>Tanggal Lahir</label>

<input
type="date"
name="tanggal_lahir"
class="form-control">

</div>

</div>



<div class="col-md-4">

<div class="form-group">

<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control">

</div>

</div>

</div>



<div class="form-group">

<label>Alamat</label>

<textarea
name="alamat"
rows="3"
class="form-control"></textarea>

</div>



<div class="form-group">

<label>Nama Orang Tua</label>

<input
type="text"
name="nama_ortu"
class="form-control">

</div>



<hr>

<h5>Akun Login</h5>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

</div>



<div class="col-md-6">

<div class="form-group">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

</div>

</div>



<hr>

<h5>RFID</h5>

<div class="alert alert-info">

<i class="fas fa-info-circle"></i>

Fitur RFID akan diaktifkan pada tahap berikutnya.

</div>

<div class="form-group">

<label>UID RFID</label>

<input
type="text"
class="form-control"
placeholder="Menunggu Scan RFID..."
readonly>

</div>



</div>



<div class="card-footer">

<button
type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan

</button>

<a
href="<?= base_url('siswa.php') ?>"
class="btn btn-secondary">

Batal

</a>

</div>

</div>

</form>

</div>

</section>