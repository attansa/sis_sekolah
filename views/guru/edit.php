<section class="content-header">

<div class="container-fluid">

    <h3>Edit Data Guru</h3>

</div>

</section>


<section class="content">

<div class="container-fluid">


<div class="card">


<form method="POST"
action="<?= base_url('guru.php?action=update&id='.$guru['id']) ?>">


<div class="card-body">


<div class="row">


<div class="col-md-6">

<div class="form-group">

<label>Nama Lengkap</label>

<input type="text"
name="nama"
class="form-control"
value="<?= htmlspecialchars($guru['nama']) ?>"
required>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>NIP</label>

<input type="text"
name="nip"
class="form-control"
value="<?= htmlspecialchars($guru['nip']) ?>">

</div>

</div>


</div>



<div class="row">


<div class="col-md-6">

<div class="form-group">

<label>Username</label>

<input type="text"
class="form-control"
value="<?= htmlspecialchars($guru['username']) ?>"
readonly>

<small class="text-muted">
Username tidak dapat diubah
</small>

</div>

</div>



<div class="col-md-6">

<div class="form-group">

<label>Role</label>

<input type="text"
class="form-control"
value="<?= htmlspecialchars($guru['role']) ?>"
readonly>

</div>

</div>


</div>




<div class="row">


<div class="col-md-6">

<div class="form-group">
    <label>Jabatan</label>

    <select name="jabatan_id" class="form-control" required>

        <?php foreach($jabatan as $j): ?>

        <option
            value="<?= $j['id']; ?>"
            <?= ($guru['jabatan_id']==$j['id']) ? 'selected' : ''; ?>>

            <?= $j['nama_jabatan']; ?>

        </option>

        <?php endforeach; ?>

    </select>

</div>

</div>



<div class="col-md-6">

<div class="form-group">

<label>Jenis Kelamin</label>


<select name="jenis_kelamin"
class="form-control">


<option value="L"
<?= $guru['jenis_kelamin']=='L'?'selected':'' ?>>
Laki-laki
</option>


<option value="P"
<?= $guru['jenis_kelamin']=='P'?'selected':'' ?>>
Perempuan
</option>


</select>


</div>

</div>


</div>




<div class="form-group">

<label>Tempat Lahir</label>

<input type="text"
name="tempat_lahir"
class="form-control"
value="<?= htmlspecialchars($guru['tempat_lahir']) ?>">


</div>



<div class="form-group">

<label>Tanggal Lahir</label>

<input type="date"
name="tanggal_lahir"
class="form-control"
value="<?= $guru['tanggal_lahir'] ?>">


</div>




<div class="form-group">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="<?= htmlspecialchars($guru['email']) ?>">


</div>




<div class="form-group">

<label>No HP</label>

<input type="text"
name="no_hp"
class="form-control"
value="<?= htmlspecialchars($guru['no_hp']) ?>">


</div>




<div class="form-group">

<label>Alamat</label>


<textarea
name="alamat"
class="form-control"
rows="4"><?= htmlspecialchars($guru['alamat']) ?></textarea>


</div>



</div>



<div class="card-footer">


<button class="btn btn-primary">

<i class="fas fa-save"></i>

Update

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