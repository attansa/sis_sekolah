<section class="content-header">

<div class="container-fluid">

<h3>
Tambah Guru
</h3>

</div>

</section>


<section class="content">

<div class="container-fluid">


<div class="card">


<form method="POST"
action="<?= base_url('guru.php?action=store') ?>">


<div class="card-body">


<div class="row">


<div class="col-md-6">

<div class="form-group">

<label>
Nama Lengkap
</label>

<input type="text"
name="nama"
class="form-control"
required>

</div>

</div>



<div class="col-md-6">

<div class="form-group">

<label>
NIP
</label>

<input type="text"
name="nip"
class="form-control">

</div>

</div>


</div>



<div class="row">


<div class="col-md-6">

<div class="form-group">

<label>
Username Login
</label>

<input type="text"
name="username"
class="form-control"
required>

</div>

</div>



<div class="col-md-6">

<div class="form-group">

<label>
Password Login
</label>

<input type="password"
name="password"
class="form-control"
required>

</div>

</div>


</div>




<div class="row">


<div class="col-md-6">

<div class="form-group">

<label>
Role
</label>

<select name="role"
class="form-control"
required>


<option value="">
-- Pilih Role --
</option>


<option value="guru">
Guru
</option>


<option value="staff">
Staff
</option>


<option value="sdm">
SDM
</option>


<option value="kepsek">
Kepala Sekolah
</option>


</select>


</div>

</div>




<div class="col-md-6">

<div class="form-group">

<label>
Jabatan
</label>


<select name="jabatan_id"
class="form-control"
required>


<option value="">
-- Pilih Jabatan --
</option>


<?php foreach($jabatan as $j): ?>

<option value="<?= $j['id'] ?>">

<?= $j['nama_jabatan'] ?>

</option>

<?php endforeach; ?>


</select>


</div>

</div>


</div>




<div class="row">


<div class="col-md-6">

<div class="form-group">

<label>
Jenis Kelamin
</label>


<select name="jenis_kelamin"
class="form-control">


<option value="L">
Laki-laki
</option>


<option value="P">
Perempuan
</option>


</select>


</div>

</div>




<div class="col-md-6">

<div class="form-group">

<label>
No HP
</label>


<input type="text"
name="no_hp"
class="form-control">


</div>

</div>


</div>




<div class="form-group">

<label>
Tempat Lahir
</label>

<input type="text"
name="tempat_lahir"
class="form-control">

</div>



<div class="form-group">

<label>
Tanggal Lahir
</label>

<input type="date"
name="tanggal_lahir"
class="form-control">

</div>




<div class="form-group">

<label>
Email
</label>

<input type="email"
name="email"
class="form-control">

</div>




<div class="form-group">

<label>
Alamat
</label>


<textarea
name="alamat"
class="form-control"
rows="3"></textarea>


</div>


</div>



<div class="card-footer">


<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan

</button>


<a href="<?= base_url('guru.php') ?>"
class="btn btn-secondary">

Kembali

</a>


</div>



</form>


</div>


</div>


</section>