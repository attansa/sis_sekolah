<section class="content-header">

    <div class="container-fluid">

        <h1>Dashboard Guru</h1>

    </div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-3">

<div class="small-box bg-success">

<div class="inner">

<h3><?= date('H:i') ?></h3>

<p>Jam Sekarang</p>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-primary">

<div class="inner">

<h3>-</h3>

<p>Jadwal Hari Ini</p>

</div>

<div class="icon">

<i class="fas fa-calendar"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-warning">

<div class="inner">

<h3>-</h3>

<p>Jurnal Hari Ini</p>

</div>

<div class="icon">

<i class="fas fa-book"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-danger">

<div class="inner">

<h3>-</h3>

<p>Status Absensi</p>

</div>

<div class="icon">

<i class="fas fa-fingerprint"></i>

</div>

</div>

</div>

</div>


<div class="row">

<div class="col-md-8">

<div class="card">

<div class="card-header bg-primary">

<h3 class="card-title">

Selamat Datang

</h3>

</div>

<div class="card-body">

<h3><?= userName(); ?></h3>

<hr>

<p>

Selamat datang di

<b>BUBS (Belajar Untuk Belajar System)</b>

</p>

<p>

Silakan melakukan absensi, melihat jadwal mengajar, dan mengisi jurnal mengajar.

</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-header bg-success">

<h3 class="card-title">

Informasi Akun

</h3>

</div>

<div class="card-body">

<table class="table">

<tr>

<td>Nama</td>

<td><?= userName(); ?></td>

</tr>

<tr>

<td>Role</td>

<td><?= strtoupper(userRole()) ?></td>

</tr>

<tr>

<td>Status</td>

<td>

<span class="badge badge-success">

ONLINE

</span>

</td>

</tr>

</table>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-12">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Aktivitas Guru

</h3>

</div>

<div class="card-body">

<ul>

<li>Melakukan Absensi RFID</li>

<li>Mengisi Jurnal Mengajar</li>

<li>Melihat Jadwal Mengajar</li>

<li>Melihat KPI Guru</li>

<li>Melihat Target Belajar</li>

</ul>

</div>

</div>

</div>

</div>

</div>

</section>