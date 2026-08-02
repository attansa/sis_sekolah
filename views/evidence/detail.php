<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-file-alt"></i>

            Detail Evidence KPI

        </h3>

    </div>

    <div class="card-body">

<?php

$persentase = 0;

if($evidence['target'] > 0){

    $persentase = round(

        ($evidence['realisasi']/$evidence['target'])*100,

        2

    );

    if($persentase>100){

        $persentase=100;

    }

}

$warna="danger";

if($persentase>=90){

    $warna="success";

}elseif($persentase>=75){

    $warna="warning";

}

?>

<table class="table table-bordered">

<tr>

<th width="220">Nama</th>

<td><?= $evidence['nama']; ?></td>

</tr>

<tr>

<th>Jabatan</th>

<td><?= $evidence['nama_jabatan']; ?></td>

</tr>

<tr>

<th>Tanggal</th>

<td><?= date('d-m-Y',strtotime($evidence['tanggal'])); ?></td>

</tr>

<tr>

<th>Target KPI</th>

<td>

<?= nl2br($evidence['target_kpi']); ?>

</td>

</tr>

<tr>

<th>Jobdesk</th>

<td>

<?= nl2br($evidence['jobdesk']); ?>

</td>

</tr>

<tr>

<th>Target</th>

<td>

<?= $evidence['target']; ?>

</td>

</tr>

<tr>

<th>Realisasi</th>

<td>

<?= $evidence['realisasi']; ?>

</td>

</tr>

<tr>

<th>Nilai KPI</th>

<td>

<div class="progress">

<div

class="progress-bar bg-<?= $warna;?>"

style="width:<?= $persentase;?>%;">

<?= $persentase;?> %

</div>

</div>

</td>

</tr>

<tr>

<th>Status</th>

<td>

<?php

switch($evidence['status']){

case 'approve':

echo "<span class='badge badge-success'>Approve</span>";

break;

case 'pending':

echo "<span class='badge badge-warning'>Pending</span>";

break;

case 'revisi':

echo "<span class='badge badge-info'>Revisi</span>";

break;

case 'ditolak':

echo "<span class='badge badge-danger'>Ditolak</span>";

break;

}

?>

</td>

</tr>

<tr>

<th>Catatan Verifikator</th>

<td>

<?= empty($evidence['catatan']) ? "-" : nl2br($evidence['catatan']); ?>

</td>

</tr>

<?php if(!empty($evidence['approver'])): ?>

<tr>

<th>Diverifikasi Oleh</th>

<td>

<?= $evidence['approver']; ?>

</td>

</tr>

<?php endif; ?>

<?php if(!empty($evidence['approved_at'])): ?>

<tr>

<th>Tanggal Approval</th>

<td>

<?= date('d-m-Y H:i',strtotime($evidence['approved_at'])); ?>

</td>

</tr>

<?php endif; ?>

</table>

<hr>

<h4>

<i class="fas fa-paperclip"></i>

Bukti Evidence

</h4>

<?php

$file=$evidence['file_bukti'];

if(empty($file)){

echo "<div class='alert alert-danger'>Belum ada file bukti.</div>";

}else{

$ext=strtolower(pathinfo($file,PATHINFO_EXTENSION));

if(in_array($ext,['jpg','jpeg','png'])){

?>

<img

src="uploads/evidence/<?= $file;?>"

class="img-fluid img-thumbnail">

<?php

}elseif($ext=="pdf"){

?>

<iframe

src="uploads/evidence/<?= $file;?>"

width="100%"

height="700">

</iframe>

<?php

}elseif(in_array($ext,['doc','docx'])){

?>

<div class="alert alert-primary text-center">

<i class="fas fa-file-word fa-5x"></i>

<br><br>

<h5>Dokumen Word</h5>

<a

href="uploads/evidence/<?= $file;?>"

target="_blank"

class="btn btn-primary">

Download Word

</a>

</div>

<?php

}elseif(in_array($ext,['xls','xlsx'])){

?>

<div class="alert alert-success text-center">

<i class="fas fa-file-excel fa-5x"></i>

<br><br>

<h5>Dokumen Excel</h5>

<a

href="uploads/evidence/<?= $file;?>"

target="_blank"

class="btn btn-success">

Download Excel

</a>

</div>

<?php

}elseif(in_array($ext,['ppt','pptx'])){

?>

<div class="alert alert-warning text-center">

<i class="fas fa-file-powerpoint fa-5x"></i>

<br><br>

<h5>Dokumen PowerPoint</h5>

<a

href="uploads/evidence/<?= $file;?>"

target="_blank"

class="btn btn-warning">

Download PowerPoint

</a>

</div>

<?php

}else{

?>

<div class="alert alert-secondary text-center">

<i class="fas fa-file fa-5x"></i>

<br><br>

<a

href="uploads/evidence/<?= $file;?>"

target="_blank"

class="btn btn-secondary">

Download File

</a>

</div>

<?php

}

}

?>

</div>

<div class="card-footer text-center">

<?php if(in_array(userRole(),['kepsek','superadmin']) && $evidence['status']=="pending"): ?>

<a

href="evidence.php?action=approve&id=<?= $evidence['id'];?>"

class="btn btn-success"

onclick="return confirm('Approve evidence ini?')">

<i class="fas fa-check"></i>

Approve

</a>

<a

href="evidence.php?action=revisi&id=<?= $evidence['id'];?>"

class="btn btn-warning">

<i class="fas fa-edit"></i>

Revisi

</a>

<a

href="evidence.php?action=tolak&id=<?= $evidence['id'];?>"

class="btn btn-danger">

<i class="fas fa-times"></i>

Tolak

</a>

<?php endif; ?>

<a

href="evidence.php"

class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</div>

</div>