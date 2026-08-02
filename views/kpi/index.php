<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Master KPI
        </h3>

        <div class="card-tools">

            <a href="kpi_master.php?action=create"
               class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>

                Tambah KPI

            </a>

        </div>

    </div>

    <div class="card-body">

        <?php if(isset($_SESSION['success'])): ?>

            <div class="alert alert-success">

                <?= $_SESSION['success']; ?>

            </div>

            <?php unset($_SESSION['success']); ?>

        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>

            <div class="alert alert-danger">

                <?= $_SESSION['error']; ?>

            </div>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>

        <table id="datatable"
               class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th width="60">No</th>

                    <th>Kode</th>

                    <th>Nama KPI</th>

                    <th>Kategori</th>

                    <th>Sumber</th>

                    <th>Bobot</th>

                    <th>Target</th>

                    <th>Status</th>

                    <th width="140">Aksi</th>

                </tr>

            </thead>

            <tbody>

            <?php $no=1; ?>

            <?php foreach($dataKPI as $row): ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= htmlspecialchars($row['kode']); ?></td>

                    <td><?= htmlspecialchars($row['nama_kpi']); ?></td>

                    <td><?= ucfirst($row['kategori']); ?></td>

                    <td><?= ucfirst(str_replace('_',' ',$row['sumber_data'])); ?></td>

                    <td><?= $row['bobot']; ?> %</td>

                    <td><?= $row['target_default']; ?></td>

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

                        <a href="kpi_master.php?action=edit&id=<?= $row['id']; ?>"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        <a href="kpi_master.php?action=delete&id=<?= $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus KPI ini?')">

                            <i class="fas fa-trash"></i>

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

$(function(){

    $('#datatable').DataTable({

        responsive:true,

        autoWidth:false,

        language:{
            url:'https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        }

    });

});

</script>