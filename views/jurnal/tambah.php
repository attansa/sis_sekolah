<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            Tambah Jurnal Mengajar

        </h3>

    </div>

    <form action="jurnal.php?action=store"
          method="POST"
          enctype="multipart/form-data">

        <div class="card-body">

            <div class="form-group">

                <label>Tanggal</label>

                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="<?= date('Y-m-d'); ?>"
                       required>

            </div>

            <div class="form-group">

                <label>Kelas</label>

                <select name="kelas_id"
                        class="form-control"
                        required>

                    <option value="">
                        -- Pilih Kelas --
                    </option>

                    <?php foreach($kelas as $k): ?>

                        <option value="<?= $k['id']; ?>">

                            <?= $k['nama_kelas']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label>Judul Materi</label>

                <input type="text"
                       name="judul_materi"
                       class="form-control"
                       required>

            </div>

            <div class="form-group">

                <label>Target Pembelajaran</label>

                <textarea
                    name="target_pembelajaran"
                    rows="3"
                    class="form-control"
                    required></textarea>

            </div>

            <div class="form-group">

                <label>Uraian Kegiatan</label>

                <textarea
                    name="uraian_kegiatan"
                    rows="5"
                    class="form-control"
                    required></textarea>

            </div>

            <div class="form-group">

                <label>Refleksi</label>

                <textarea
                    name="refleksi"
                    rows="4"
                    class="form-control"></textarea>

            </div>

            <div class="form-group">

                <label>Upload Materi</label>

                <input type="file"
                       name="file_materi"
                       class="form-control">

                <small class="text-muted">

                    PDF, DOC, DOCX, PPT, PPTX, ZIP

                </small>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>

            <a href="jurnal.php"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>