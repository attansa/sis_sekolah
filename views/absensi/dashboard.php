<div class="content">
    <div class="container-fluid">

        <!-- Statistik -->
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $guru_hadir ?></h3>
                        <p>Guru Hadir</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $siswa_hadir ?></h3>
                        <p>Siswa Hadir</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $sudah_pulang ?></h3>
                        <p>Sudah Pulang</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $belum_pulang ?></h3>
                        <p>Belum Pulang</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Scan Terakhir -->
        <div class="card">

            <div class="card-header bg-dark">
                <h3 class="card-title">
                    <i class="fas fa-id-card"></i>
                    Scan RFID Terakhir
                </h3>
            </div>

            <div class="card-body">

                <?php if ($last_scan): ?>

                    <h3 id="namaScan">
                        <?= $last_scan['nama']; ?>
                    </h3>

                    <p>
                        <b>Role :</b>
                        <span id="roleScan">
                            <?= ucfirst($last_scan['role']); ?>
                        </span>
                    </p>

                    <p>
                        <b>Jam Masuk :</b>
                        <span id="jamMasuk">
                            <?= $last_scan['jam_masuk']; ?>
                        </span>
                    </p>

                    <p>
                        <b>Jam Keluar :</b>
                        <span id="jamKeluar">
                            <?= $last_scan['jam_keluar'] ?: '-'; ?>
                        </span>
                    </p>

                <?php else: ?>

                    <h4 class="text-center text-muted">
                        Belum ada absensi
                    </h4>

                <?php endif; ?>

            </div>

        </div>

        <!-- Monitoring -->
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Monitoring Hari Ini
                </h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Status Masuk</th>
                            <th>Status Pulang</th>
                        </tr>

                    </thead>

<tbody>

<?php $no=1; ?>

<?php foreach($riwayat as $r): ?>

<tr>

<td><?= $no++ ?></td>

<td><?= $r['nama'] ?></td>

<td><?= ucfirst($r['role']) ?></td>

<td><?= $r['jam_masuk'] ?></td>

<td><?= $r['jam_keluar'] ?: '-' ?></td>

<td><?= ucfirst($r['status']) ?></td>

<td>

<?php

switch($r['status_pulang']){

    case 'belum':
        echo "<span class='badge badge-warning'>Belum Pulang</span>";
        break;

    case 'pulang':
        echo "<span class='badge badge-success'>Pulang</span>";
        break;

    case 'pulang_cepat':
        echo "<span class='badge badge-danger'>Pulang Cepat</span>";
        break;

    default:
        echo "-";

}

?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

                </table>

            </div>

        </div>

        <!-- Grafik -->
        <div class="card">

            <div class="card-header bg-primary">

                <h3 class="card-title">

                    Grafik Kehadiran 7 Hari Terakhir

                </h3>

            </div>

            <div class="card-body">

                <div style="height:350px">

                    <canvas id="grafikAbsensi"></canvas>

                </div>

            </div>

        </div>

    </div>
</div>

<!-- Data Grafik -->
<script>

const grafikData = {

    labels: [

        <?php foreach($grafik as $g): ?>

            "<?= date('d/m', strtotime($g['tanggal'])) ?>",

        <?php endforeach; ?>

    ],

    total: [

        <?php foreach($grafik as $g): ?>

            <?= $g['total']; ?>,

        <?php endforeach; ?>

    ]

};

</script>

<script src="<?= base_url('assets/js/dashboard.js'); ?>"></script>