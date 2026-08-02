<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h3>Data Siswa</h3>
            </div>

            <div class="col-sm-6 text-right">

                <a href="<?= base_url('siswa.php?action=create') ?>" class="btn btn-primary">

                    <i class="fas fa-plus"></i>

                    Tambah Siswa

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

Daftar Siswa

</h3>

</div>


<div class="card-body">


<?php if(isset($_SESSION['success'])): ?>

<div class="alert alert-success">

<?= $_SESSION['success']; ?>

</div>

<?php unset($_SESSION['success']); ?>

<?php endif; ?>



<table id="tableSiswa" class="table table-bordered table-striped">

<thead>

<tr>

<th width="5%">No</th>

<th>NIS</th>

<th>Nama</th>

<th>Kelas</th>

<th>Username</th>

<th>Status</th>

<th width="15%">Aksi</th>

</tr>

</thead>

<tbody>

<?php $no=1; ?>

<?php foreach($siswa as $row): ?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($row['nis']); ?></td>

<td><?= htmlspecialchars($row['nama']); ?></td>

<td><?= htmlspecialchars($row['nama_kelas'] ?? '-'); ?></td>

<td><?= htmlspecialchars($row['username']); ?></td>

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

<a href="<?= base_url('siswa.php?action=edit&id='.$row['id']) ?>" class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="<?= base_url('siswa.php?action=delete&id='.$row['id']) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data siswa?')">

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


<script>

$(function(){

    $('#tableSiswa').DataTable({

        responsive:true,

        autoWidth:false

    });

});

</script>