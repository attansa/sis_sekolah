<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Rekap Absensi

        </h3>

    </div>

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="date"
                        name="mulai"
                        class="form-control"
                        value="<?= $_GET['mulai'] ?? '' ?>">

                </div>

                <div class="col-md-4">

                    <input
                        type="date"
                        name="sampai"
                        class="form-control"
                        value="<?= $_GET['sampai'] ?? '' ?>">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary">

                        Filter

                    </button>

                </div>

            </div>

        </form>

        <hr>

        <table class="table table-bordered table-striped" id="datatable">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Tanggal</th>

                    <th>Nama</th>

                    <th>Role</th>

                    <th>Masuk</th>

                    <th>Pulang</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

            <?php $no=1; ?>

            <?php foreach($rekap as $r): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= $r['tanggal'] ?></td>

                <td><?= $r['nama'] ?></td>

                <td><?= ucfirst($r['role']) ?></td>

                <td><?= $r['jam_masuk'] ?></td>

                <td><?= $r['jam_keluar'] ?: '-' ?></td>

                <td><?= ucfirst($r['status']) ?></td>

            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>