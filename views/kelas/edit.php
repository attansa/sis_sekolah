<section class="content-header">

<div class="container-fluid">

<h1>Edit Kelas</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<form method="POST"
action="<?= base_url('kelas.php?action=update&id='.$kelas['id']) ?>">

<div class="card-body">

<div class="form-group">

<label>Nama Kelas</label>

<input
type="text"
name="nama_kelas"
class="form-control"
value="<?= htmlspecialchars($kelas['nama_kelas']) ?>"
required>

</div>

<div class="form-group">

<label>Tingkat</label>

<select
name="tingkat"
class="form-control">

<option <?= $kelas['tingkat']=="X"?"selected":"" ?>>X</option>

<option <?= $kelas['tingkat']=="XI"?"selected":"" ?>>XI</option>

<option <?= $kelas['tingkat']=="XII"?"selected":"" ?>>XII</option>

</select>

</div>

<div class="form-group">

<label>Jurusan</label>

<input
type="text"
name="jurusan"
class="form-control"
value="<?= htmlspecialchars($kelas['jurusan']) ?>">

</div>

<div class="form-group">

<label>Wali Kelas</label>

<input
type="text"
name="wali_kelas"
class="form-control"
value="<?= htmlspecialchars($kelas['wali_kelas']) ?>">

</div>

</div>

<div class="card-footer">

<button class="btn btn-primary">

Update

</button>

<a
href="<?= base_url('kelas.php') ?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</form>

</div>

</div>

</section>