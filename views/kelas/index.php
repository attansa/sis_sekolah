<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h3>
Data Kelas
</h3>

</div>


<div class="col-sm-6 text-right">

<a href="<?= base_url('kelas.php?action=create') ?>"
class="btn btn-primary">

<i class="fas fa-plus"></i>

Tambah Kelas

</a>

</div>


</div>

</div>

</section>




<section class="content">

<div class="container-fluid">


<div class="card">


<div class="card-header">

<h3 class="card-title">

Daftar Kelas

</h3>

</div>



<div class="card-body">


<table class="table table-bordered table-striped">


<thead>

<tr>

<th width="5%">No</th>

<th>Nama Kelas</th>

<th>Tingkat</th>

<th>Jurusan</th>

<th>Wali Kelas</th>

<th>Status</th>

<th width="15%">Aksi</th>

</tr>

</thead>



<tbody>


<?php if(empty($kelas)): ?>


<tr>

<td colspan="7" class="text-center">

Belum ada data kelas

</td>

</tr>


<?php else: ?>


<?php $no=1; ?>


<?php foreach($kelas as $k): ?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
<?= htmlspecialchars($k['nama_kelas']); ?>
</td>


<td>
<?= htmlspecialchars($k['tingkat']); ?>
</td>


<td>
<?= htmlspecialchars($k['jurusan']); ?>
</td>


<td>
<?= htmlspecialchars($k['nama_wali'] ?? '-'); ?>
</td>



<td>


<?php if($k['status']=='aktif'): ?>


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


<a href="<?= base_url('kelas.php?action=edit&id='.$k['id']) ?>"
class="btn btn-warning btn-sm">


<i class="fas fa-edit"></i>

</a>



<a href="<?= base_url('kelas.php?action=delete&id='.$k['id']) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data kelas ini?')">


<i class="fas fa-trash"></i>

</a>


</td>


</tr>



<?php endforeach; ?>


<?php endif; ?>


</tbody>


</table>


</div>


</div>


</div>


</section>