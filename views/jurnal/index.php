<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Data Jurnal Mengajar
        </h3>

        <?php if(userRole()=='guru'): ?>

        <div class="card-tools">

            <a href="jurnal.php?action=create"
               class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>
                Tambah Jurnal

            </a>

        </div>

        <?php endif; ?>

    </div>

    <div class="card-body">

        <table id="tableJurnal"
               class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th width="60">No</th>
                    <th>Tanggal</th>
                    <th>Guru</th>
                    <th>Kelas</th>
                    <th>Materi</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>

                </tr>

            </thead>

            <tbody>

            <?php if(!empty($dataJurnal)): ?>

                <?php $no=1; ?>

                <?php foreach($dataJurnal as $row): ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td>

                        <?= !empty($row['tanggal'])
                            ? date('d/m/Y',strtotime($row['tanggal']))
                            : '-'; ?>

                    </td>

                    <td>

                        <?= htmlspecialchars($row['nama'] ?? '-'); ?>

                    </td>

                    <td>

                        <?= htmlspecialchars($row['nama_kelas'] ?? '-'); ?>

                    </td>

                    <td>

                        <?= htmlspecialchars($row['judul_materi'] ?? '-'); ?>

                    </td>

                    <td>

                        <?php

                        $status = strtolower($row['status'] ?? '');

                        switch($status){

                            case 'draft':

                                $badge='secondary';
                                $text='Draft';

                            break;

                            case 'terkirim':

                                $badge='warning';
                                $text='Terkirim';

                            break;

                            case 'disetujui':

                                $badge='success';
                                $text='Disetujui';

                            break;

                            case 'ditolak':

                                $badge='danger';
                                $text='Ditolak';

                            break;

                            default:

                                $badge='light';
                                $text='-';

                            break;

                        }

                        ?>

                        <span class="badge badge-<?= $badge; ?>">

                            <?= $text; ?>

                        </span>

                    </td>

                    <td>

                        <a href="jurnal.php?action=edit&id=<?= $row['id']; ?>"
                           class="btn btn-warning btn-sm"
                           title="Edit">

                            <i class="fas fa-edit"></i>

                        </a>

                        <a href="jurnal.php?action=delete&id=<?= $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           title="Hapus"
                           onclick="return confirm('Yakin ingin menghapus jurnal ini?')">

                            <i class="fas fa-trash"></i>

                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada data jurnal.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

$(function(){

    $('#tableJurnal').DataTable({

        responsive:true,

        autoWidth:false,

        pageLength:10,

        order:[[1,'desc']],

        language:{

            emptyTable:"Belum ada data jurnal.",

            search:"Cari :",

            lengthMenu:"Tampilkan _MENU_ data",

            info:"Menampilkan _START_ - _END_ dari _TOTAL_ data",

            infoEmpty:"Belum ada data",

            zeroRecords:"Data tidak ditemukan",

            paginate:{

                previous:"Sebelumnya",

                next:"Berikutnya"

            }

        }

    });

});

</script>