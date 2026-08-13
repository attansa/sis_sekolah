<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Data Evidence KPI

        </h3>

        <div class="card-tools">

            <?php if(userRole()=='guru' || userRole()=='staff'): ?>

                <a href="evidence.php?action=create"
                   class="btn btn-primary btn-sm">

                    <i class="fas fa-plus"></i>

                    Tambah Evidence

                </a>

            <?php endif; ?>

        </div>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped" id="tableEvidence">

            <thead>

            <tr>

                <th width="40">No</th>

                <th>Tanggal</th>

                <th>Nama</th>

                <th>Target KPI</th>

                <th>Target</th>

                <th>Realisasi</th>

                <th>Status</th>

                <th>Bukti</th>

                <th width="220">Aksi</th>

            </tr>

            </thead>

            <tbody>

            <?php $no=1; ?>

            <?php foreach($dataEvidence as $row): ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

                <td><?= $row['nama']; ?></td>

                <td><?= $row['target_kpi']; ?></td>

                <td><?= $row['target']; ?></td>

                <td><?= $row['realisasi']; ?></td>

                <td>

                    <?php

                    switch($row['status']){

                        case 'approve':
                            echo '<span class="badge badge-success">Approve</span>';
                        break;

                        case 'pending':
                            echo '<span class="badge badge-warning">Pending</span>';
                        break;

                        case 'revisi':
                            echo '<span class="badge badge-info">Revisi</span>';
                        break;

                        case 'ditolak':
                            echo '<span class="badge badge-danger">Ditolak</span>';
                        break;

                        default:
                            echo '<span class="badge badge-secondary">'.$row['status'].'</span>';
                        break;

                    }

                    ?>

                </td>

                <td>

                    <a href="evidence.php?action=detail&id=<?= $row['id']; ?>"
                       class="btn btn-info btn-sm"
                       title="Detail">

                        <i class="fas fa-eye"></i>

                    </a>

                </td>

                <td>

                    <!-- Guru & Staff -->

                    <?php if(userRole()=="guru" || userRole()=="staff"): ?>

                        <a href="evidence.php?action=edit&id=<?= $row['id']; ?>"
                           class="btn btn-warning btn-sm"
                           title="Edit">

                            <i class="fas fa-edit"></i>

                        </a>

                        <a href="evidence.php?action=delete&id=<?= $row['id']; ?>"
                           onclick="return confirm('Yakin ingin menghapus evidence ini?')"
                           class="btn btn-danger btn-sm"
                           title="Hapus">

                            <i class="fas fa-trash"></i>

                        </a>

                    <?php endif; ?>



                    <!-- Kepala Sekolah -->

                    <?php if(userRole()=="kepsek" || userRole()=="superadmin" || userRole()=="sdm"): ?>

                        <a href="evidence.php?action=approve&id=<?= $row['id']; ?>"
                           class="btn btn-success btn-sm"
                           title="Approve">

                            <i class="fas fa-check"></i>

                        </a>

                        <a href="evidence.php?action=revisi&id=<?= $row['id']; ?>"
                           class="btn btn-info btn-sm"
                           title="Revisi">

                            <i class="fas fa-redo"></i>

                        </a>

                        <a href="evidence.php?action=tolak&id=<?= $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           title="Tolak">

                            <i class="fas fa-times"></i>

                        </a>

                    <?php endif; ?>

                </td>

            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

$(function(){

    $('#tableEvidence').DataTable({

        responsive:true,

        autoWidth:false,

        pageLength:10,

        language:{

            url:"https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"

        }

    });

});

</script>