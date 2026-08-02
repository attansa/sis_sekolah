<?php
?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Target KPI
        </h3>


        <div class="card-tools">

            <a href="target_kpi.php?action=create"
               class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>
                Tambah Target KPI

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

                    <th width="50">
                        No
                    </th>

                    <th>
                        Nama
                    </th>

                    <th>
                        KPI
                    </th>

                    <th>
                        Bobot
                    </th>

                    <th>
                        Target
                    </th>

                    <th>
                        Tahun Pelajaran
                    </th>

                    <th>
                        Semester
                    </th>


                </tr>

            </thead>


            <tbody>


            <?php $no=1; ?>


            <?php foreach($dataTarget as $row): ?>


                <tr>


                    <td>
                        <?= $no++; ?>
                    </td>


                    <td>
                        <?= htmlspecialchars($row['nama']); ?>
                    </td>


                    <td>
                        <?= htmlspecialchars($row['nama_kpi']); ?>
                    </td>


                    <td>
                        <?= $row['bobot']; ?> %
                    </td>


                    <td>

                        <span class="badge badge-info">

                            <?= $row['target']; ?>

                        </span>

                    </td>


                    <td>
                       <?= $row['tahun_pelajaran_id']; ?>
                    </td>


                    <td>
                        <?= $row['semester_id']; ?>
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