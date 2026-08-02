<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Tambah Master KPI
        </h3>

    </div>

    <form action="kpi_master.php?action=store" method="POST">

        <div class="card-body">

            <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Kode KPI</label>

                        <input
                            type="text"
                            name="kode"
                            class="form-control"
                            placeholder="Contoh : KPI006"
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

                            <option value="guru">Guru</option>
                            <option value="staff">Staff</option>
                            <option value="semua">Semua</option>

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Sumber Data</label>

                        <select
                            name="sumber_data"
                            class="form-control">

                            <option value="manual">Manual</option>
                            <option value="absensi">Absensi RFID</option>
                            <option value="jurnal">Jurnal Mengajar</option>

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Status</label>

                        <select
                            name="status"
                            class="form-control">

                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>

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
                            min="0"
                            max="100"
                            name="bobot"
                            class="form-control"
                            value="0">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Target Default</label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="target_default"
                            class="form-control"
                            value="100">

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label>Deskripsi</label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    class="form-control"
                    placeholder="Deskripsi KPI..."></textarea>

            </div>

        </div>

        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>

            <a
                href="kpi_master.php"
                class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </form>

</div>