<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Manajemen RFID
        </h3>

        <div class="card-tools">

            <a href="rfid.php?action=create"
               class="btn btn-primary btn-sm">

                <i class="fas fa-id-card"></i>

                Registrasi RFID

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


        <table class="table table-bordered table-striped" id="datatable">

            <thead>

                <tr>

                    <th width="50">No</th>

                    <th>UID RFID</th>

                    <th>Nama</th>

                    <th>Role</th>

                    <th>Status</th>

                    <th width="170">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php $no=1; ?>

               <?php foreach($rfids as $row): ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td>

                        <span class="badge badge-dark">

                            <?= $row['uid']; ?>

                        </span>

                    </td>

                    <td><?= $row['nama']; ?></td>

                    <td>

                        <span class="badge badge-info">

                            <?= ucfirst($row['role']); ?>

                        </span>

                    </td>

                    <td>

                        <?php if($row['status']=='aktif'): ?>

                            <span class="badge badge-success">

                                Aktif

                            </span>

                        <?php else: ?>

                            <span class="badge badge-danger">

                                Non Aktif

                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <a href="rfid.php?action=edit&id=<?= $row['id']; ?>"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                            Edit

                        </a>

                        <a href="rfid.php?action=delete&id=<?= $row['id']; ?>"
                           onclick="return confirm('Hapus RFID ini?')"
                           class="btn btn-danger btn-sm">

                            <i class="fas fa-trash"></i>

                            Hapus

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
            url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        }

    });

});

</script>