<div class="card">

<div class="card-header">

<h3>

Monitoring Kinerja Guru

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th>No</th>

<th>Nama</th>

<th>Total</th>

</tr>

<?php

$no=1;

foreach($data as $row):

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= number_format($row['total'],2); ?></td>

</tr>

<?php endforeach; ?>

</table>

</div>

</div>