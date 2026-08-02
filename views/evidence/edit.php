<div class="card card-primary">

<div class="card-header">

<h3 class="card-title">

Edit Evidence

</h3>

</div>

<form
method="POST"
action="evidence.php?action=update&id=<?= $evidence['id'];?>"
enctype="multipart/form-data">

<div class="card-body">

<div class="form-group">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
value="<?= $evidence['tanggal'];?>">

</div>


<!--  -->

<div class="form-group">

    <label>Target KPI</label>

    <input
        type="text"
        name="target_kpi"
        class="form-control"
        value="<?= htmlspecialchars($evidence['target_kpi']); ?>"
        required>

    <input
        type="hidden"
        name="kpi_id"
        value="<?= $kpi[0]['id']; ?>">

</div>

<div class="form-group">

<label>Jobdesk</label>

<textarea
name="jobdesk"
class="form-control"
rows="3"><?= $evidence['jobdesk'];?></textarea>

</div>

<div class="row">

<div class="col-md-6">

<label>Target</label>

<input
type="number"
name="target"
class="form-control"
value="<?= $evidence['target'];?>">

</div>

<div class="col-md-6">

<label>Realisasi</label>

<input
type="number"
name="realisasi"
class="form-control"
value="<?= $evidence['realisasi'];?>">

</div>

</div>

<br>

<div class="form-group">

<label>Deskripsi</label>

<textarea
name="deskripsi"
rows="5"
class="form-control"><?= $evidence['deskripsi'];?></textarea>

</div>

<div class="form-group">

<label>File Lama</label>

<br>

<?php if($evidence['file_bukti']!=""): ?>

<a
href="uploads/evidence/<?= $evidence['file_bukti'];?>"
target="_blank">

<?= $evidence['file_bukti'];?>

</a>

<?php else: ?>

Tidak ada file

<?php endif;?>

</div>

<div class="form-group">

<label>Ganti File</label>

<input
type="file"
name="file_bukti"
class="form-control">

</div>

</div>

<div class="card-footer">

<button class="btn btn-success">

<i class="fas fa-save"></i>

Update

</button>

<a
href="evidence.php"
class="btn btn-secondary">

Kembali

</a>

</div>

</form>

</div>