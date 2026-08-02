<?php

include __DIR__.'/../layouts/header.php';
include __DIR__.'/../layouts/navbar.php';
include __DIR__.'/../layouts/sidebar.php';

?>

<div class="content-wrapper">

<section class="content pt-3">

<div class="container-fluid">
<div class="card card-warning">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-edit"></i>

Revisi Evidence KPI

</h3>

</div>

<form method="POST">

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="220">Nama</th>

<td><?= $evidence['nama']; ?></td>

</tr>

<tr>

<th>Jabatan</th>

<td><?= $evidence['nama_jabatan']; ?></td>

</tr>


<tr>

<th>Target KPI</th>

<td>

<?= nl2br($evidence['target_kpi']); ?>

</td>



</tr>

<tr>

<th>Tanggal</th>

<td><?= date('d-m-Y',strtotime($evidence['tanggal'])); ?></td>

</tr>

<tr>

<th>Target</th>

<td><?= $evidence['target']; ?></td>

</tr>

<tr>

<th>Realisasi</th>

<td><?= $evidence['realisasi']; ?></td>

</tr>

</table>

<br>

<div class="form-group">

<label>

Deskripsi Evidence

</label>

<div class="border p-3 bg-light">

<?= nl2br($evidence['deskripsi']); ?>

</div>

</div>

<div class="form-group">

<label>

Bukti Evidence

</label>

<br>

<?php

$file=$evidence['file_bukti'];

$ext=strtolower(pathinfo($file,PATHINFO_EXTENSION));

if(in_array($ext,['jpg','jpeg','png'])){

?>

<img

src="uploads/evidence/<?= $file;?>"

class="img-fluid img-thumbnail"

style="max-height:450px;">

<?php

}else{

?>

<a

href="uploads/evidence/<?= $file;?>"

target="_blank"

class="btn btn-info">

Lihat Bukti

</a>

<?php } ?>

</div>

<div class="form-group">

<label>

Catatan Revisi

</label>

<textarea

name="catatan"

rows="6"

class="form-control"

placeholder="Tuliskan alasan revisi..."

required></textarea>

</div>

</div>

<div class="card-footer text-right">

<a

href="evidence.php"

class="btn btn-secondary">

Kembali

</a>

<button

class="btn btn-warning">

<i class="fas fa-paper-plane"></i>

Kirim Revisi

</button>

</div>

</form>

</div>
</div>

</section>

</div>

<?php

include __DIR__.'/../layouts/footer.php';

?>