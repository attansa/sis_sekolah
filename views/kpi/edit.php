<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Edit Master KPI
        </h3>

    </div>

    <form action="kpi_master.php?action=update&id=<?= $kpi['id']; ?>" method="POST">

        <div class="card-body">

            <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Kode KPI</label>

                        <input
                            type="text"
                            name="kode"
                            class="form-control"
                            value="<?= htmlspecialchars($kpi['kode']); ?>"
                            required>

                    </div>

                </div>

                <div class="col-md-8">

                    <div class="form-group">

                        <label>Nama KPI</label>

                        <input
                            type="text"
                            name="nama_kpi"
                            class="form-control"
                            value="<?= htmlspecialchars($kpi['nama_kpi']); ?>"
                            required>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Kategori</label>

                        <select
                            name="kategori"
                            class="form-control">

                            <option value="guru" <?= $kpi['kategori']=='guru'?'selected':''; ?>>Guru</option>

                            <option value="staff" <?= $kpi['kategori']=='staff'?'selected':''; ?>>Staff</option>

                            <option value="semua" <?= $kpi['kategori']=='semua'?'selected':''; ?>>Semua</option>

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Sumber Data</label>

                        <select
                            name="sumber_data"
                            class="form-control">

                            <option value="manual" <?= $kpi['sumber_data']=='manual'?'selected':''; ?>>Manual</option>

                            <option value="absensi" <?= $kpi['sumber_data']=='absensi'?'selected':''; ?>>Absensi RFID</option>

                            <option value="jurnal" <?= $kpi['sumber_data']=='jurnal'?'selected':''; ?>>Jurnal Mengajar</option>

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Status</label>

                        <select
                            name="status"
                            class="form-control">

                            <option value="aktif" <?= $kpi['status']=='aktif'?'selected':''; ?>>Aktif</option>

                            <option value="nonaktif" <?= $kpi['status']=='nonaktif'?'selected':''; ?>>Nonaktif</option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Bobot (%)</label>

                        <input
                            type="number"
                            step="0.01"
                            name="bobot"
                            class="form-control"
                            value="<?= $kpi['bobot']; ?>">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Target Default</label>

                        <input
                            type="number"
                            step="0.01"
                            name="target_default"
                            class="form-control"
                            value="<?= $kpi['target_default']; ?>">

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label>Deskripsi</label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    class="form-control"><?= htmlspecialchars($kpi['deskripsi']); ?></textarea>

            </div>

        </div>

        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-success">

                <i class="fas fa-save"></i>

                Update

            </button>

            <a
                href="kpi_master.php"
                class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>