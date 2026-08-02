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
Dashboard Monitoring Kepala Sekolah
</p>

</div>

</div>

</div>

<!-- CARD -->

<div class="row">

<div class="col-lg-2 col-6">

<div class="small-box bg-info">

<div class="inner">

<h3><?= $statistik['guru']; ?></h3>

<p>Guru</p>

</div>

<div class="icon">

<i class="fas fa-chalkboard-teacher"></i>

</div>

</div>

</div>

<div class="col-lg-2 col-6">

<div class="small-box bg-success">

<div class="inner">

<h3><?= $staff; ?></h3>

<p>Staff</p>

</div>

<div class="icon">

<i class="fas fa-user-tie"></i>

</div>

</div>

</div>

<div class="col-lg-2 col-6">

<div class="small-box bg-warning">

<div class="inner">

<h3><?= $pending; ?></h3>

<p>Pending</p>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

<a href="evidence.php" class="small-box-footer">

Detail

</a>

</div>

</div>

<div class="col-lg-2 col-6">

<div class="small-box bg-primary">

<div class="inner">

<h3><?= $approve; ?></h3>

<p>Approve</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

<div class="col-lg-2 col-6">

<div class="small-box bg-danger">

<div class="inner">

<h3><?= $revisi; ?></h3>

<p>Revisi</p>

</div>

<div class="icon">

<i class="fas fa-edit"></i>

</div>

</div>

</div>

<div class="col-lg-2 col-6">

<div class="small-box bg-dark">

<div class="inner">

<h3><?= $rata; ?>%</h3>

<p>Rata KPI</p>

</div>

<div class="icon">

<i class="fas fa-chart-line"></i>

</div>

</div>

</div>

</div>

<!-- RANKING -->

<div class="row">

<div class="col-md-6">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Top Guru

</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>Nama</th>

<th>Total KPI</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

foreach($ranking as $row):

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td>

<?= $row['total']; ?>

</td>

</tr>

<?php endforeach;?>

</tbody>

</table>

</div>

</div>

</div>

<!-- AKTIVITAS -->

<div class="col-md-6">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Aktivitas Terbaru

</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-striped">

<thead>

<tr>

<th>Nama</th>

<th>Tanggal</th>

<th>Jam</th>

</tr>

</thead>

<tbody>

<?php foreach($aktivitas as $row):?>

<tr>

<td><?= $row['nama']; ?></td>

<td><?= $row['tanggal']; ?></td>

<td><?= $row['jam_masuk']; ?></td>

</tr>

<?php endforeach;?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<!-- EVIDENCE -->

<div class="row">

<div class="col-md-12">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Evidence Terbaru

</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-hover">

<thead>

<tr>

<th>Tanggal</th>

<th>Nama</th>

<th>Jabatan</th>

<th>KPI</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($evidence as $row):?>

<tr>

<td><?= $row['tanggal']; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['nama_jabatan']; ?></td>

<td><?= $row['nama_kpi']; ?></td>

<td>

<?php

if($row['status']=="pending"){

echo "<span class='badge badge-warning'>Pending</span>";

}elseif($row['status']=="approve"){

echo "<span class='badge badge-success'>Approve</span>";

}elseif($row['status']=="revisi"){

echo "<span class='badge badge-info'>Revisi</span>";

}else{

echo "<span class='badge badge-danger'>Ditolak</span>";

}

?>

</td>

<td>

<a href="evidence.php?action=detail&id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">

Detail

</a>

</td>

</tr>

<?php endforeach;?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

</section>