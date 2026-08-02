<div class="card card-primary">

<div class="card-header">

<h3 class="card-title">
<i class="fas fa-bullseye"></i>
Tambah Target KPI
</h3>

</div>


<form method="POST"
action="target_kpi.php?action=store">


<div class="card-body">


<div class="row">


<div class="col-md-4">

<div class="form-group">

<label>Guru / Staff</label>

<select name="user_id"
class="form-control select2"
required>


<option value="">
-- Pilih User --
</option>


<?php foreach($users as $u): ?>

<option value="<?= $u['id']; ?>">

<?= $u['nama']; ?>

(<?= $u['role']; ?>)

</option>


<?php endforeach; ?>


</select>


</div>

</div>



<div class="col-md-4">


<div class="form-group">

<label>Tahun Pelajaran</label>


<select name="tahun_pelajaran_id"
class="form-control"
required>


<option value="">
-- Pilih Tahun --
</option>



<?php foreach($tahun as $t): ?>


<option value="<?= $t['id']; ?>">

<?= $t['nama']; ?>

</option>


<?php endforeach; ?>


</select>


</div>


</div>




<div class="col-md-4">


<div class="form-group">

<label>Semester</label>


<select name="semester_id"
class="form-control"
required>


<option value="">

-- Pilih Semester --

</option>


<option value="1">

Ganjil

</option>


<option value="2">

Genap

</option>


</select>


</div>


</div>


</div>



<hr>


<h5>
Daftar KPI
</h5>


<table class="table table-bordered table-striped">


<thead>

<tr>

<th>
KPI
</th>

<th width="150">
Bobot
</th>

<th width="200">
Target
</th>


</tr>

</thead>



<tbody>


<?php foreach($kpi as $item): ?>


<tr>


<td>

<?= $item['nama_kpi']; ?>


<input type="hidden"
name="kpi_id[]"
value="<?= $item['id']; ?>">


</td>



<td>

<?= $item['bobot']; ?> %

</td>


<td>


<input type="number"
class="form-control"
name="target[]"
value="<?= $item['target_default']; ?>">


</td>


</tr>



<?php endforeach; ?>


</tbody>


</table>



</div>


<div class="card-footer">


<button class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan Semua

</button>



<a href="target_kpi.php"
class="btn btn-secondary">

Kembali

</a>


</div>


</form>


</div>