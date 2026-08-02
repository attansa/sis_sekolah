<div class="row">

<?php foreach($data as $row): ?>

<div class="col-md-6">

<div class="card">

<div class="card-header bg-primary">

<h3 class="card-title">

<?= $row['nama_kpi']; ?>

</h3>

</div>

<div class="card-body">

<h2>

<?= number_format($row['nilai'],2); ?> %

</h2>

<div class="progress">

<div
class="progress-bar bg-success"

style="width: <?= $row['nilai']; ?>%">

</div>

</div>

<br>

<b>Bobot :</b>

<?= $row['bobot']; ?> %

</div>

</div>

</div>

<?php endforeach; ?>

</div>

<div class="card">

<div class="card-body">

<h3>

Total Nilai Kinerja

</h3>

<h1 class="text-primary">

<?= number_format($total['total'],2); ?>

</h1>

</div>

</div>