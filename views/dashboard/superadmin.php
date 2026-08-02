<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>

            <div class="col-sm-6 text-right">
                <small><?= date('l, d F Y'); ?></small>
            </div>

        </div>

    </div>

</section>

<section class="content">

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-3 col-6">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3><?= $guru ?></h3>

                    <p>Total Guru</p>

                </div>

                <div class="icon">

                    <i class="fas fa-user-tie"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3><?= $siswa ?></h3>

                    <p>Total Siswa</p>

                </div>

                <div class="icon">

                    <i class="fas fa-user-graduate"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3><?= $hadir ?></h3>

                    <p>Hadir Hari Ini</p>

                </div>

                <div class="icon">

                    <i class="fas fa-calendar-check"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">

                <div class="inner">

                    <h3><?= $pulang ?></h3>

                    <p>Sudah Pulang</p>

                </div>

                <div class="icon">

                    <i class="fas fa-sign-out-alt"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-6">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3><?= $kpi ?></h3>

                    <p>Total KPI Aktif</p>

                </div>

                <div class="icon">

                    <i class="fas fa-chart-line"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="small-box bg-secondary">

                <div class="inner">

                    <h3><?= $jurnal ?></h3>

                    <p>Jurnal Hari Ini</p>

                </div>

                <div class="icon">

                    <i class="fas fa-book"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Selamat Datang
                    </h3>

                </div>

                <div class="card-body">

                    <h4><?= userName(); ?></h4>

                    <hr>

                    <p>
                        Selamat datang di
                        <b>Belajar Untuk Belajar System (BUBS)</b>
                        Versi 1.
                    </p>

                    <p>
                        Silakan gunakan menu di sebelah kiri untuk mengelola data sekolah.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Informasi Akun
                    </h3>

                </div>

                <div class="card-body">

                    <table class="table table-borderless">

                        <tr>
                            <td>Nama</td>
                            <td><?= userName(); ?></td>
                        </tr>

                        <tr>
                            <td>Role</td>
                            <td><?= strtoupper(userRole()); ?></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>
                                <span class="badge badge-success">
                                    ONLINE
                                </span>
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-trophy"></i>

                        Top 5 Guru Berdasarkan KPI

                    </h3>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Nama Guru</th>

                                <th>Total Nilai</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php $no=1; ?>

                        <?php foreach($ranking as $row): ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td><?= $row['nama'] ?></td>

                                <td><?= $row['total'] ?></td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

</section>