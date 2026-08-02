<section class="content-header">
    <div class="container-fluid">
        <h3>Absensi Hari Ini</h3>
    </div>
</section>

<section class="content">

<div class="container-fluid">

    <!-- Statistik -->
    <div class="row">

        <div class="col-md-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $statistik['hadir']; ?></h3>
                    <p><?= userRole()=='guru' ? 'Total Hadir Saya' : 'Hadir Hari Ini'; ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $statistik['terlambat']; ?></h3>
                    <p><?= userRole()=='guru' ? 'Total Terlambat Saya' : 'Terlambat Hari Ini'; ?></p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Monitoring RFID -->
    <?php if(userRole()!='guru'): ?>

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">
                Monitoring RFID
            </h3>
        </div>

        <div class="card-body text-center">

            <h2 id="namaUser">
                Menunggu Scan RFID...
            </h2>

            <h4 id="roleUser"></h4>

            <h1 id="jamUser"></h1>

            <span
                id="statusUser"
                class="badge badge-secondary">

                Belum Ada Scan

            </span>

        </div>

    </div>

    <?php endif; ?>


    <!-- Tabel -->
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                <?= userRole()=='guru'
                    ? 'Riwayat Absensi Saya'
                    : 'Daftar Absensi Hari Ini'; ?>

            </h3>

        </div>

        <div class="card-body">

            <table
                id="tableAbsensi"
                class="table table-bordered table-striped">

                <thead>

                <tr>

                    <th>No</th>

                    <?php if(userRole()!='guru'): ?>
                        <th>Nama</th>
                        <th>Role</th>
                    <?php endif; ?>

                    <th>Tanggal</th>

                    <th>Masuk</th>

                    <th>Keluar</th>

                    <th>Status</th>

                </tr>

                </thead>

                <tbody>

                <?php $no=1; ?>

                <?php foreach($data as $row): ?>

                <?php

                $badge="success";

                if($row['status']=="terlambat"){
                    $badge="warning";
                }

                if($row['status']=="izin"){
                    $badge="info";
                }

                if($row['status']=="sakit"){
                    $badge="primary";
                }

                if($row['status']=="alpa"){
                    $badge="danger";
                }

                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <?php if(userRole()!='guru'): ?>

                    <td><?= htmlspecialchars($row['nama']); ?></td>

                    <td><?= ucfirst($row['role']); ?></td>

                    <?php endif; ?>

                    <td><?= $row['tanggal']; ?></td>

                    <td><?= $row['jam_masuk']; ?></td>

                    <td><?= $row['jam_keluar'] ?: '-'; ?></td>

                    <td>

                        <span class="badge badge-<?= $badge; ?>">

                            <?= ucfirst($row['status']); ?>

                        </span>

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

    $("#tableAbsensi").DataTable({

        responsive:true,

        autoWidth:false,

        ordering:true,

        pageLength:10

    });

});

</script>

<?php if(userRole()!='guru'): ?>

<script>

let lastID = 0;

setInterval(function(){

    $.getJSON("api/last_absensi.php",function(res){

        if(!res.status){
            return;
        }

        if(lastID==res.data.id){
            return;
        }

        lastID=res.data.id;

        $("#namaUser").text(res.data.nama);

        $("#roleUser").text(res.data.role.toUpperCase());

        if(res.data.jam_keluar==null){

            $("#jamUser").text(res.data.jam_masuk);

        }else{

            $("#jamUser").text(res.data.jam_keluar);

        }

        $("#statusUser")
            .removeClass()
            .addClass("badge badge-success")
            .text(res.data.status.toUpperCase());

        location.reload();

    });

},1000);

</script>

<?php endif; ?>