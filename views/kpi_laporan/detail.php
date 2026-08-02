<div class="card">

<div class="card-header">

<h3 class="card-title">

Detail KPI Guru

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th>Kode</th>

<th>Nama KPI</th>

<th>Target</th>

<th>Realisasi</th>

<th>Nilai</th>

</tr>

<?php foreach($detail as $row): ?>

<tr>

<td><?= $row['kode']; ?></td>

<td><?= $row['nama_kpi']; ?></td>

<td><?= $row['target']; ?></td>

<td><?= $row['realisasi']; ?></td>

<td>

<span class="badge badge-primary">

<?= $row['nilai']; ?>

</span>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>

<div class="card-footer">

<a

href="kpi_laporan.php"

class="btn btn-secondary">

Kembali

</a>

</div>

</div>