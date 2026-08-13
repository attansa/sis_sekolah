<?php

$role = $_SESSION['role'] ?? '';

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo -->
    <a href="<?= base_url('dashboard.php') ?>" class="brand-link text-center">

        <span class="brand-text font-weight-light">
            <b>BUBS</b> V1
        </span>

    </a>

    <div class="sidebar">

        <!-- User -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">

                <a href="#" class="d-block">

                    <?= $_SESSION['nama'] ?? 'User'; ?>

                </a>

                <small class="text-light text-uppercase">

                    <?= $role ?>

                </small>

            </div>

        </div>

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <!-- DASHBOARD -->
                <li class="nav-item">

                    <a href="<?= base_url('dashboard.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-home"></i>

                        <p>Dashboard</p>

                    </a>

                </li>

                <?php if($role=='superadmin'): ?>

                <!-- MASTER DATA -->
                <li class="nav-header">

                    MASTER DATA

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('guru.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-chalkboard-teacher"></i>

                        <p>Data Guru</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('siswa.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-user-graduate"></i>

                        <p>Data Siswa</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('kelas.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-school"></i>

                        <p>Kelas</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('jabatan.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-sitemap"></i>

                        <p>Jabatan</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('tahun_pelajaran.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-calendar-alt"></i>

                        <p>Tahun Pelajaran</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('semester.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-calendar-week"></i>

                        <p>Semester</p>

                    </a>

                </li>
                <li class="nav-item">
    <a href="evidence.php" class="nav-link">
        <i class="nav-icon fas fa-clipboard-check"></i>
        <p>Approval Evidence</p>
    </a>
</li>

                <li class="nav-item">

                    <a href="rfid.php"
       class="nav-link <?= basename($_SERVER['PHP_SELF'])=='rfid.php' ? 'active' : ''; ?>">

                        <i class="nav-icon fas fa-id-card"></i>

                        <p>RFID</p>

                    </a>

                </li>

                <!-- ABSENSI -->
                <li class="nav-header">

                    ABSENSI RFID

                </li>

                <li class="nav-item has-treeview">

                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-fingerprint"></i>

                        <p>

                            Absensi

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                      <li class="nav-item">
                         <a href="<?= base_url('absensi_dashboard.php') ?>" class="nav-link">
    

        <i class="nav-icon fas fa-tachometer-alt"></i>

        <p>Dashboard Absensi</p>

    </a>

</li>

<li class="nav-item">

    <a href="monitor_absensi.php" class="nav-link">

        <i class="nav-icon fas fa-desktop"></i>

        <p>Monitoring Live</p>

    </a>

</li>

    <li class="nav-item">

<a href="<?= base_url('rekap_absensi.php') ?>" class="nav-link">

<i class="nav-icon fas fa-file-alt"></i>

<p>Rekap Absensi</p>

</a>

</li>
                    </ul>

                </li>

                <!-- JURNAL -->
                <li class="nav-header">

                    JURNAL MENGAJAR

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('jurnal.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-book"></i>

                        <p>Jurnal Mengajar</p>

                    </a>

                </li>
                <li class="nav-item">

<a href="evidence.php" class="nav-link">

<i class="nav-icon fas fa-file-upload"></i>

<p>Evidence KPI</p>

</a>

</li>

                <!-- KPI -->
                <li class="nav-header">

                    KINERJA (KPI)

                </li>

                <li class="nav-item has-treeview">

                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-chart-line"></i>

                        <p>

                            KPI

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="<?= base_url('kpi_dashboard.php') ?>" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Dashboard</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('kpi_master.php') ?>" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Master KPI</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('target_kpi.php') ?>" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Target KPI</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('kpi_realisasi.php') ?>" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Realisasi KPI</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('kpi_approval.php') ?>" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Approval KPI</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= base_url('kpi_laporan.php') ?>" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Laporan KPI</p>

                            </a>

                        </li>


                    </ul>

                </li>

                        <?php endif; ?>
        <?php if(userRole() == 'kepsek' || userRole() == 'sdm'): ?>

        <li class="nav-header">
            MONITORING SEKOLAH
        </li>

        <li class="nav-item">
            <a href="<?= base_url('evidence.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-file-upload"></i>
                <p>Approval Evidence</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('kinerja.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Monitoring KPI</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('absensi_dashboard.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-fingerprint"></i>
                <p>Dashboard Absensi</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('rekap_absensi.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Rekap Absensi</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('jurnal.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Monitoring Jurnal</p>
            </a>
        </li>

<?php endif; ?>
                <!-- GURU -->
              <!-- GURU & STAFF -->
<?php if($role=='guru' || $role=='staff'): ?>

<li class="nav-header">
    MENU <?= strtoupper($role); ?>
</li>

<!-- Absensi -->
<li class="nav-item">
    <a href="<?= base_url('absensi.php') ?>" class="nav-link">
        <i class="nav-icon fas fa-fingerprint"></i>
        <p>Absensi Saya</p>
    </a>
</li>

<!-- Evidence -->
<li class="nav-item">
    <a href="<?= base_url('evidence.php') ?>" class="nav-link">
        <i class="nav-icon fas fa-file-upload"></i>
        <p>Evidence KPI</p>
    </a>
</li>

<!-- Jurnal hanya Guru -->
<?php if($role=='guru'): ?>

<li class="nav-item">
    <a href="<?= base_url('jurnal.php') ?>" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>Jurnal Mengajar</p>
    </a>
</li>

<?php endif; ?>

<!-- Kinerja -->
<li class="nav-item">
    <a href="<?= base_url('kinerja.php') ?>" class="nav-link">
        <i class="nav-icon fas fa-chart-line"></i>
        <p>Kinerja Saya</p>
    </a>
</li>

<?php endif; ?>

                <!-- LOGOUT -->
                <li class="nav-header">

                    SISTEM

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('logout.php') ?>" class="nav-link">

                        <i class="nav-icon fas fa-sign-out-alt"></i>

                        <p>Logout</p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>