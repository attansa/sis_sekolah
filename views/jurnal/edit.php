<div class="card card-warning">

    <div class="card-header">

        <h3 class="card-title">

            Edit Jurnal Mengajar

        </h3>

    </div>

    <form action="jurnal.php?action=update&id=<?= $jurnal['id']; ?>"
          method="POST"
          enctype="multipart/form-data">

        <div class="card-body">

            <div class="form-group">

                <label>Tanggal</label>

                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="<?= $jurnal['tanggal']; ?>"
                       required>

            </div>

            <div class="form-group">

                <label>Kelas</label>

                <select name="kelas_id"
                        class="form-control"
                        required>

                    <?php foreach($kelas as $k): ?>

                        <option
                            value="<?= $k['id']; ?>"
                            <?= $k['id']==$jurnal['kelas_id'] ? 'selected':''; ?>>

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
                       value="<?= $jurnal['judul_materi']; ?>"
                       required>

            </div>

            <div class="form-group">

                <label>Target Pembelajaran</label>

                <textarea
                    name="target_pembelajaran"
                    rows="3"
                    class="form-control"><?= $jurnal['target_pembelajaran']; ?></textarea>

            </div>

            <div class="form-group">

                <label>Uraian Kegiatan</label>

                <textarea
                    name="uraian_kegiatan"
                    rows="5"
                    class="form-control"><?= $jurnal['uraian_kegiatan']; ?></textarea>

            </div>

            <div class="form-group">

                <label>Refleksi</label>

                <textarea
                    name="refleksi"
                    rows="4"
                    class="form-control"><?= $jurnal['refleksi']; ?></textarea>

            </div>

            <div class="form-group">

                <label>Upload Materi Baru</label>

                <input type="file"
                       name="file_materi"
                       class="form-control">

                <?php if(!empty($jurnal['file_materi'])): ?>

                    <small class="text-success">

                        File saat ini:
                        <?= $jurnal['file_materi']; ?>

                    </small>

                <?php endif; ?>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-warning">

                <i class="fas fa-edit"></i>

                Update

            </button>

            <a href="jurnal.php"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>