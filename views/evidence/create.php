<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">
            Input Evidence KPI
        </h3>

    </div>

    <form
        method="POST"
        action="evidence.php?action=store"
        enctype="multipart/form-data">

        <div class="card-body">

            <!-- ========================================= -->
            <!-- DATA GURU -->
            <!-- ========================================= -->

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Nama Guru
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($user['nama'] ?? ''); ?>"
                            readonly>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Jabatan
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($user['jabatan'] ?? ''); ?>"
                            readonly>

                    </div>

                </div>

            </div>


            <!-- ========================================= -->
            <!-- TANGGAL -->
            <!-- ========================================= -->

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="<?= date('Y-m-d'); ?>"
                            required>

                    </div>

                </div>


                <!-- ========================================= -->
                <!-- INDIKATOR KINERJA -->
                <!-- ========================================= -->

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Indikator Kinerja
                        </label>

                        <input
                            type="text"
                            name="target_kpi"
                            class="form-control"
                            placeholder="Masukan indikator kinerja yang ada di Google Drive"
                            required>

                        <small class="form-text text-muted mt-2">

                            <i class="fas fa-info-circle"></i>

                            Silakan lihat datanya yang ada di Drive sesuai jabatan.

                        </small>


                        <a
                            href="https://drive.google.com/drive/folders/1OCeaHPNJpUPvdRR0I42edW10FBPcQjkQ"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm btn-outline-primary mt-1">

                            <i class="fab fa-google-drive"></i>

                            Lihat Panduan Evidence

                        </a>

                    </div>

                </div>

            </div>

            <?php


            $kpi_id = $kpi[0]['id'] ?? '';

            ?>

            <input
                type="hidden"
                name="kpi_id"
                value="<?= htmlspecialchars($kpi_id); ?>">



            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Jobdesk
                        </label>

                        <textarea
                            name="jobdesk"
                            class="form-control"
                            rows="3"
                            placeholder="Tuliskan pekerjaan yang telah dilakukan"
                            required></textarea>

                    </div>

                </div>


                <!-- ========================================= -->
                <!-- TARGET -->
                <!-- ========================================= -->

                <div class="col-md-3">

                    <div class="form-group">

                        <label>
                            Target
                        </label>

                        <input
                            type="number"
                            name="target"
                            class="form-control"
                            min="0"
                            required>

                    </div>

                </div>


                <!-- ========================================= -->
                <!-- REALISASI -->
                <!-- ========================================= -->

                <div class="col-md-3">

                    <div class="form-group">

                        <label>
                            Realisasi
                        </label>

                        <input
                            type="number"
                            name="realisasi"
                            class="form-control"
                            min="0"
                            required>

                    </div>

                </div>

            </div>


            <!-- ========================================= -->
            <!-- DESKRIPSI EVIDENCE -->
            <!-- ========================================= -->

            <div class="form-group">

                <label>
                    Deskripsi Evidence
                </label>

                <textarea
                    name="deskripsi"
                    rows="5"
                    class="form-control"
                    placeholder="Jelaskan evidence atau bukti pekerjaan yang dilakukan"
                    required></textarea>

            </div>


            <!-- ========================================= -->
            <!-- FILE EVIDENCE -->
            <!-- ========================================= -->

            <div class="form-group">

                <label>
                    Upload Bukti
                </label>

                <input
                    type="file"
                    name="file_bukti"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">

                <small class="text-muted">

                    Format yang diperbolehkan:
                    PDF, JPG, JPEG, PNG, DOC, DOCX, XLS, XLSX.

                </small>

            </div>

        </div>


        <!-- ========================================= -->
        <!-- FOOTER -->
        <!-- ========================================= -->

        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>


            <a
                href="evidence.php"
                class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </form>

</div>