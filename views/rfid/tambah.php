<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            Registrasi RFID

        </h3>

    </div>

    <form action="rfid.php?action=store" method="POST">

        <div class="card-body">

            <div class="form-group">

                <label>Pengguna</label>

                <select
                    name="user_id"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Pengguna --
                    </option>

                    <?php foreach($users as $user): ?>

                        <option
                            value="<?= $user['id']; ?>">

                            <?= $user['nama']; ?>

                            (<?= ucfirst($user['role']); ?>)

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <div class="form-group">

                <label>UID RFID</label>

                <div class="input-group">

                    <input
                        type="text"
                        id="uid"
                        name="uid"
                        class="form-control"
                        readonly
                        placeholder="Menunggu Scan RFID...">

                    <div class="input-group-append">

                        <button
                            type="button"
                            id="btnScan"
                            class="btn btn-info">

                            <i class="fas fa-wifi"></i>

                            Scan

                        </button>

                    </div>

                </div>

                <small class="text-muted">

                    Tempelkan kartu setelah menekan tombol Scan.

                </small>

            </div>


            <div class="form-group">

                <label>Status</label>

                <select
                    name="status"
                    class="form-control">

                    <option value="aktif">

                        Aktif

                    </option>

                    <option value="nonaktif">

                        Non Aktif

                    </option>

                </select>

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
                href="rfid.php"
                class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>
<script>
$(document).ready(function () {

    $(document).on("click", "#btnScan", function () {

        $("#uid").val("");

        let timer = setInterval(function () {

            $.ajax({
                url: "api/rfid_register.php",
                type: "GET",
                dataType: "json",
                cache: false,

                success: function(res) {

                    console.log(res);

                    if (res.status) {

                        $("#uid").val(res.uid);

                        clearInterval(timer);

                    }

                },

                error: function(xhr) {

                    console.log(xhr.responseText);

                }

            });

        }, 500);

    });

});
</script>