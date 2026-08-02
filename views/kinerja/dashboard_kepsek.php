<div class="card">

<div class="card-header bg-success">

<h3>

Dashboard Kepala Sekolah

</h3>

</div>

<div class="card-body">

<table class="table table-striped">

<tr>

<th>Ranking</th>

<th>Nama</th>

<th>Total Nilai</th>

</tr>

<?php

$ranking=1;

foreach($data as $row):

?>

<tr>

<td>

<?= $ranking++; ?>

</td>

<td>

<?= $row['nama']; ?>

</td>

<td>

<?= number_format($row['total'],2); ?>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>

</div>