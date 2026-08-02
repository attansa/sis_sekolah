<div class="row mb-3">

<div class="col-md-3">

<div class="small-box bg-info">

<div class="inner">

<h3><?= $summary['guru']; ?></h3>

<p>Guru Dinilai</p>

</div>
<div class="icon">
<i class="fas fa-users small-box-icon"></i>
</div>
</div>

</div>

<div class="col-md-3">

<div class="small-box bg-success">

<div class="inner">

<h3><?= $summary['rata']; ?></h3>

<p>Rata-rata KPI</p>

</div>
<div class="icon">
<i class="fas fa-chart-line small-box-icon"></i>
</div>
</div>

</div>

<div class="col-md-3">

<div class="small-box bg-warning">

<div class="inner">

<h3><?= $summary['tertinggi']; ?></h3>

<p>Nilai Tertinggi</p>

</div>
<div class="icon">
<i class="fas fa-trophy small-box-icon"></i>
</div>
</div>

</div>

<div class="col-md-3">

<div class="small-box bg-danger">

<div class="inner">

<h3><?= $summary['terendah']; ?></h3>

<p>Nilai Terendah</p>

</div>
<div class="icon">

<i class="fas fa-chart-bar"></i>

</div>
<!-- <i class="fas fa-chart-bar small-box-icon"></i> -->

</div>

</div>

</div>
<div class="card">

<div class="card-header">

<h3 class="card-title">

Laporan KPI Guru

</h3>

</div>

<div class="card-body">

<table class="table table-bordered table-striped" id="tableKPI">

<thead>

<tr>

<th>No</th>
<th>Guru</th>
<th>Total KPI</th>
<th>Target</th>
<th>Realisasi</th>
<th>Nilai</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php $no=1; ?>

<?php foreach($laporan as $row): ?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['total_kpi']; ?></td>

<td><?= $row['target']; ?></td>

<td><?= $row['realisasi']; ?></td>

<td>

<span class="badge badge-success">

<?= $row['nilai']; ?>

</span>

</td>

<td>

<a

href="kpi_laporan.php?action=detail&id=<?= $row['id'];?>"

class="btn btn-info btn-sm">

<i class="fas fa-eye"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

<script>

$(function(){

$('#tableKPI').DataTable({

responsive:true

});

});

</script>