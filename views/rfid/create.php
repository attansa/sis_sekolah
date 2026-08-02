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

                <select name="user_id" class="form-control" required>

                    <option value="">
                        -- Pilih Pengguna --
                    </option>

                    <?php foreach($users as $user): ?>

                    <option value="<?= $user['id']; ?>">

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
                        placeholder="Klik Scan lalu tempel kartu">

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

            </div>

            <div class="form-group">

                <label>Status</label>

                <select name="status" class="form-control">

                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non Aktif</option>

                </select>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>

            <a href="rfid.php" class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>

<script>
window.onload = function () {

    console.log("CREATE LOADED");

    document.getElementById("btnScan").onclick = function () {

        alert("SCAN CLICK");

        fetch("api/rfid_register.php")
            .then(r => r.json())
            .then(res => {

                console.log(res);

                if(res.status){
                    document.getElementById("uid").value = res.uid;
                }

            });

    };

};
</script>