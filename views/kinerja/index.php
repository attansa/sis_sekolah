<?php

if(userRole()=="guru"){

?>

<div class="row">

    <div class="col-md-4">

        <div class="small-box bg-success">

            <div class="inner">

                <h3><?= $total ?>%</h3>

                <p>Total KPI</p>

            </div>

            <div class="icon">

                <i class="fas fa-chart-line"></i>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Progress KPI

        </h3>

    </div>

    <div class="card-body">

        <?php foreach($progress as $p): ?>

            <b><?= $p['nama_kpi']; ?></b>

            <div class="progress">

                <div

                    class="progress-bar bg-success"

                    style="width:<?= $p['nilai']; ?>%">

                    <?= $p['nilai']; ?>%

                </div>

            </div>

            <small>

                Target :

                <?= $p['target']; ?>

                |

                Realisasi :

                <?= $p['realisasi']; ?>

            </small>

            <hr>

        <?php endforeach; ?>

    </div>

</div>

<?php

}elseif(userRole()=="staff"){

?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Kinerja Saya

        </h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped" id="tableKinerja">

            <thead>

            <tr>

                <th>No</th>

                <th>Tanggal</th>

                <th>Target KPI</th>

                <th>Target</th>

                <th>Realisasi</th>

                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            <?php $no=1; ?>

            <?php foreach($data as $row): ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

                    <td><?= $row['target_kpi']; ?></td>

                    <td><?= $row['target']; ?></td>

                    <td><?= $row['realisasi']; ?></td>

                    <td>

                        <?php

                        if($row['status']=="approve"){

                            echo '<span class="badge badge-success">Approve</span>';

                        }elseif($row['status']=="pending"){

                            echo '<span class="badge badge-warning">Pending</span>';

                        }elseif($row['status']=="revisi"){

                            echo '<span class="badge badge-info">Revisi</span>';

                        }else{

                            echo '<span class="badge badge-danger">Ditolak</span>';

                        }

                        ?>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

$(function(){

    $('#tableKinerja').DataTable({

        responsive:true,

        autoWidth:false

    });

});

</script>

<?php

}else{

?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Data Kinerja Guru & Staff

        </h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped" id="tableAdmin">

            <thead>

            <tr>

                <th>No</th>

                <th>Nama</th>

                <th>Tanggal</th>

                <th>Target KPI</th>

                <th>Target</th>

                <th>Realisasi</th>

                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            <?php $no=1; ?>

            <?php foreach($data as $row): ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $row['nama']; ?></td>

                    <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

                    <td><?= $row['target_kpi']; ?></td>

                    <td><?= $row['target']; ?></td>

                    <td><?= $row['realisasi']; ?></td>

                    <td>

                        <?php

                        if($row['status']=="approve"){

                            echo '<span class="badge badge-success">Approve</span>';

                        }elseif($row['status']=="pending"){

                            echo '<span class="badge badge-warning">Pending</span>';

                        }elseif($row['status']=="revisi"){

                            echo '<span class="badge badge-info">Revisi</span>';

                        }else{

                            echo '<span class="badge badge-danger">Ditolak</span>';

                        }

                        ?>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

$(function(){

    $('#tableAdmin').DataTable({

        responsive:true,

        autoWidth:false

    });

});

</script>

<?php

}

?>