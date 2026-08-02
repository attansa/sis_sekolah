<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Evidence Menunggu Persetujuan

        </h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover" id="datatable">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Tanggal</th>

                    <th>Nama</th>

                    <th>Jabatan</th>

                    <th>KPI</th>

                    <th>Status</th>

                    <th width="220">Aksi</th>

                </tr>

            </thead>

            <tbody>

            <?php

            $no=1;

            foreach($evidence as $row):

            ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $row['tanggal']; ?></td>

                    <td><?= $row['nama']; ?></td>

                    <td><?= $row['nama_jabatan']; ?></td>

                    <td><?= $row['nama_kpi']; ?></td>

                    <td>

                        <span class="badge badge-warning">

                            Pending

                        </span>

                    </td>

                    <td>

                        <a href="evidence.php?action=detail&id=<?= $row['id']; ?>"
                        class="btn btn-info btn-sm">

                            Detail

                        </a>

                        <a href="evidence.php?action=approve&id=<?= $row['id']; ?>"
                        class="btn btn-success btn-sm"
                        onclick="return confirm('Approve evidence ini?')">

                            Approve

                        </a>

                        <a href="evidence.php?action=revisi&id=<?= $row['id']; ?>"
                        class="btn btn-warning btn-sm">

                            Revisi

                        </a>

                        <a href="evidence.php?action=tolak&id=<?= $row['id']; ?>"
                        class="btn btn-danger btn-sm">

                            Tolak

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>