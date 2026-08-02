<div class="content">

    <div class="container-fluid">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Pengaturan Absensi

                </h3>

            </div>

            <form method="POST"
                  action="pengaturan_absensi.php?action=update">

                <div class="card-body">

                    <input type="hidden"
                           name="id"
                           value="<?= $pengaturan['id']; ?>">

                    <div class="form-group">

                        <label>Jam Masuk</label>

                        <input
                            type="time"
                            class="form-control"
                            name="jam_masuk"
                            value="<?= $pengaturan['jam_masuk']; ?>"
                            required>

                    </div>

                    <div class="form-group">

                        <label>Batas Terlambat</label>

                        <input
                            type="time"
                            class="form-control"
                            name="batas_terlambat"
                            value="<?= $pengaturan['batas_terlambat']; ?>"
                            required>

                    </div>

                    <div class="form-group">

                        <label>Jam Pulang</label>

                        <input
                            type="time"
                            class="form-control"
                            name="jam_pulang"
                            value="<?= $pengaturan['jam_pulang']; ?>"
                            required>

                    </div>

                </div>

                <div class="card-footer">

                    <button
                        class="btn btn-success">

                        <i class="fas fa-save"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>