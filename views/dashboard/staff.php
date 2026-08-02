<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-md-12">

<div class="alert alert-primary">

<h4>
Selamat Datang,
<b><?= $_SESSION['nama']; ?></b>
</h4>

<p>
Dashboard Staff BUBS
</p>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-3 col-6">

<div class="small-box bg-warning">

<div class="inner">

<h3><?= $statistik['pending']; ?></h3>

<p>Evidence Pending</p>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

<a href="evidence.php" class="small-box-footer">

Detail

</a>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">

<div class="inner">

<h3><?= $statistik['approve']; ?></h3>

<p>Evidence Approve</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-info">

<div class="inner">

<h3><?= $statistik['revisi']; ?></h3>

<p>Perlu Revisi</p>

</div>

<div class="icon">

<i class="fas fa-edit"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-danger">

<div class="inner">

<h3><?= $statistik['ditolak']; ?></h3>

<p>Ditolak</p>

</div>

<div class="icon">

<i class="fas fa-times-circle"></i>

</div>

</div>

</div>

</div>

<!-- KPI -->

<div class="row">

<div class="col-md-5">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Ringkasan KPI

</h3>

</div>

<div class="card-body p-0">

<table class="table table-bordered">

<tr>

<th width="220">

Total Evidence

</th>

<td>

<?= $kpi['total']; ?>

</td>

</tr>

<tr>

<th>

Total Target

</th>

<td>

<?= $kpi['target']; ?>

</td>

</tr>

<tr>

<th>

Total Realisasi

</th>

<td>

<?= $kpi['realisasi']; ?>

</td>

</tr>

<tr>

<th>

Nilai KPI

</th>

<td>

<b><?= $kpi['nilai']; ?> %</b>

</td>

</tr>

</table>

</div>

</div>

</div>

<div class="col-md-7">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Progress KPI

</h3>

</div>

<div class="card-body">

<div class="progress progress-lg">

<div

class="progress-bar bg-success"

style="width:<?= $kpi['nilai']; ?>%">

<?= $kpi['nilai']; ?> %

</div>

</div>

<br>

<?php

if($kpi['nilai']>=90){

echo "<span class='badge badge-success'>Sangat Baik</span>";

}elseif($kpi['nilai']>=75){

echo "<span class='badge badge-primary'>Baik</span>";

}elseif($kpi['nilai']>=60){

echo "<span class='badge badge-warning'>Cukup</span>";

}else{

echo "<span class='badge badge-danger'>Perlu Peningkatan</span>";

}

?>

</div>

</div>

</div>

</div>
<div class="row">

<div class="col-md-12">

<div class="card">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-paperclip"></i>

Evidence Terbaru

</h3>

</div>

<div class="card-body table-responsive p-0">

<table class="table table-hover">

<thead>

<tr>

<th width="120">Tanggal</th>

<th>Target KPI</th>

<th>Target</th>

<th>Realisasi</th>

<th>Status</th>

<th width="90">Aksi</th>

</tr>

</thead>

<tbody>

<?php if(count($evidence)>0): ?>

<?php foreach($evidence as $row): ?>

<tr>

<td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

<td><?= $row['target_kpi']; ?></td>

<td><?= $row['target']; ?></td>

<td><?= $row['realisasi']; ?></td>

<td>

<?php

switch($row['status']){

case 'pending':

echo "<span class='badge badge-warning'>Pending</span>";

break;

case 'approve':

echo "<span class='badge badge-success'>Approve</span>";

break;

case 'revisi':

echo "<span class='badge badge-info'>Revisi</span>";

break;

default:

echo "<span class='badge badge-danger'>Ditolak</span>";

}

?>

</td>

<td>

<a

href="evidence.php?action=detail&id=<?= $row['id'];?>"

class="btn btn-info btn-sm">

<i class="fas fa-eye"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="6" class="text-center">

Belum ada evidence.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>
<div class="row">

<div class="col-md-6">

<div class="card">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-calendar-check"></i>

Riwayat Absensi

</h3>

</div>

<div class="card-body table-responsive p-0">

<table class="table table-striped">

<thead>

<tr>

<th>Tanggal</th>

<th>Masuk</th>

<th>Pulang</th>

</tr>

</thead>

<tbody>

<?php if(count($aktivitas)>0): ?>

<?php foreach($aktivitas as $row): ?>

<tr>

<td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

<td><?= $row['jam_masuk']; ?></td>

<td><?= $row['jam_keluar']; ?></td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="3" class="text-center">

Belum ada data absensi.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>
<div class="col-md-6">

<div class="card">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-chart-pie"></i>

Statistik KPI

</h3>

</div>

<div class="card-body">

<div class="progress-group">

Evidence Approve

<span class="float-right">

<b><?= $statistik['approve']; ?></b>

</span>

<div class="progress progress-sm">

<div

class="progress-bar bg-success"

style="width:100%">

</div>

</div>

</div>

<div class="progress-group">

Evidence Pending

<span class="float-right">

<b><?= $statistik['pending']; ?></b>

</span>

<div class="progress progress-sm">

<div

class="progress-bar bg-warning"

style="width:100%">

</div>

</div>

</div>

<div class="progress-group">

Evidence Revisi

<span class="float-right">

<b><?= $statistik['revisi']; ?></b>

</span>

<div class="progress progress-sm">

<div

class="progress-bar bg-info"

style="width:100%">

</div>

</div>

</div>

<div class="progress-group">

Evidence Ditolak

<span class="float-right">

<b><?= $statistik['ditolak']; ?></b>

</span>

<div class="progress progress-sm">

<div

class="progress-bar bg-danger"

style="width:100%">

</div>

</div>

</div>

</div>

</div>

</div>

</div>
</div>

</section>