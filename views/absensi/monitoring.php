<div class="content">

    <div class="container-fluid">

        <div class="row">

            <!-- Scan Terakhir -->
            <div class="col-lg-4">

                <div class="card card-success">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-id-card"></i>
                            Scan Terakhir
                        </h3>

                    </div>

                    <div class="card-body text-center">

                        <i class="fas fa-user-circle fa-5x text-success mb-3"></i>

                        <h2 id="namaScan">
                            <?= $last_scan['nama'] ?? '-' ?>
                        </h2>

                        <h5 id="roleScan">
                            <?= ucfirst($last_scan['role'] ?? '-') ?>
                        </h5>

                        <hr>

                        <p>
                            <b>Jam Masuk</b><br>
                            <span id="jamMasuk">
                                <?= $last_scan['jam_masuk'] ?? '-' ?>
                            </span>
                        </p>

                        <p>
                            <b>Jam Keluar</b><br>
                            <span id="jamKeluar">
                                <?= $last_scan['jam_keluar'] ?: '-' ?>
                            </span>
                        </p>

                    </div>

                </div>

            </div>

            <!-- Monitoring -->
            <div class="col-lg-8">

                <div class="card card-primary">

                    <div class="card-header">

                        <h3 class="card-title">

                            <i class="fas fa-list"></i>

                            Monitoring Hari Ini

                        </h3>

                    </div>

                    <div class="card-body table-responsive">

                        <table class="table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Masuk</th>
                                    <th>Pulang</th>
                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody id="tableAbsensi">

                                <?php
                                $no=1;
                                foreach($riwayat as $r):
                                ?>

                                <tr>

                                    <td><?= $no++ ?></td>

                                    <td><?= $r['nama'] ?></td>

                                    <td><?= ucfirst($r['role']) ?></td>

                                    <td><?= $r['jam_masuk'] ?></td>

                                    <td><?= $r['jam_keluar'] ?: '-' ?></td>

                                    <td>

                                        <?php if($r['status']=="hadir"): ?>

                                            <span class="badge badge-success">
                                                Hadir
                                            </span>

                                        <?php elseif($r['status']=="terlambat"): ?>

                                            <span class="badge badge-danger">
                                                Terlambat
                                            </span>

                                        <?php else: ?>

                                            <span class="badge badge-secondary">
                                                <?= ucfirst($r['status']) ?>
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
function loadLive(){

    fetch("api/live_absensi.php")

    .then(res=>res.json())

    .then(data=>{

        if(data.last){

            document.getElementById("namaScan").innerHTML=data.last.nama;
            document.getElementById("roleScan").innerHTML=data.last.role;
            document.getElementById("jamMasuk").innerHTML=data.last.jam_masuk;
            document.getElementById("jamKeluar").innerHTML=data.last.jam_keluar ?? "-";

        }

        let html="";
        let no=1;

        data.riwayat.forEach(function(item){

            let badge="badge-success";

            if(item.status=="terlambat"){
                badge="badge-danger";
            }

            html+=`
            <tr>
                <td>${no++}</td>
                <td>${item.nama}</td>
                <td>${item.role}</td>
                <td>${item.jam_masuk}</td>
                <td>${item.jam_keluar ?? '-'}</td>
                <td>
                    <span class="badge ${badge}">
                        ${item.status}
                    </span>
                </td>
            </tr>
            `;

        });

        document.getElementById("tableAbsensi").innerHTML=html;

    });

}

loadLive();

setInterval(loadLive,2000);
</script>