<section class="content-header">

<div class="container-fluid">

    <div class="d-flex justify-content-between">

        <h3>Data Guru</h3>

        <a href="<?= base_url('guru.php?action=create') ?>"
           class="btn btn-primary">

            <i class="fas fa-plus"></i>

            Tambah Guru

        </a>

    </div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-body">

<table class="table table-bordered table-striped">

<thead>

<tr>

<th width="50">No</th>

<th>Nama</th>

<th>NIP</th>

<th>Username</th>

<th>Role</th>

<th>Jabatan</th>

<th>Status</th>

<th width="130">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

foreach($dataGuru as $row):

?>

<tr>

<td><?= $no++ ?></td>

<td><?= htmlspecialchars($row['nama']) ?></td>

<td><?= htmlspecialchars($row['nip']) ?></td>

<td><?= htmlspecialchars($row['username']) ?></td>

<td><?= htmlspecialchars($row['role']) ?></td>

<td><?= htmlspecialchars($row['nama_jabatan']) ?></td>

<td>

<?php if($row['status']=='aktif'): ?>

<span class="badge badge-success">

Aktif

</span>

<?php else: ?>

<span class="badge badge-danger">

Nonaktif

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= base_url('guru.php?action=edit&id='.$row['id']) ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="<?= base_url('guru.php?action=delete&id='.$row['id']) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus data?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</section>