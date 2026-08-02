<?php

require_once 'config/database.php';

$db = (new Database())->connect();

/*
|------------------------------------------------------------
| Ambil Data Guru Login
|------------------------------------------------------------
*/

$stmt = $db->prepare("
SELECT
    u.id,
    u.nama,
    u.jabatan_id,
    j.nama_jabatan
FROM users u
INNER JOIN jabatan j
ON j.id=u.jabatan_id
WHERE u.id=?
LIMIT 1
");

$stmt->execute([$_SESSION['id']]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

/*
|------------------------------------------------------------
| KPI berdasarkan jabatan
|------------------------------------------------------------
*/

$stmt = $db->prepare("
SELECT

    mk.id,
    mk.kode,
    mk.nama_kpi,
    kj.target

FROM kpi_jabatan kj

INNER JOIN master_kpi mk

ON mk.id=kj.kpi_id

WHERE kj.jabatan_id=?

ORDER BY mk.kode
");

$stmt->execute([$user['jabatan_id']]);

$listKPI = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            Input Evidence KPI

        </h3>

    </div>

<form method="POST"
      action="evidence.php?action=store"
      enctype="multipart/form-data">

<div class="card-body">

<div class="row">

<div class="col-md-6">

<label>Nama Guru</label>

<input
type="text"
class="form-control"
value="<?= $user['nama']; ?>"
readonly>

<input
type="hidden"
name="user_id"
value="<?= $user['id']; ?>">

</div>

<div class="col-md-6">

<label>Jabatan</label>

<input
type="text"
class="form-control"
value="<?= $user['nama_jabatan']; ?>"
readonly>

<input
type="hidden"
name="jabatan_id"
value="<?= $user['jabatan_id']; ?>">

</div>

</div>

<br>

<div class="row">

<div class="col-md-4">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
value="<?= date('Y-m-d'); ?>"
required>

</div>

<div class="col-md-8">

<label>Target KPI</label>

<select
name="kpi_id"
id="kpi"
class="form-control"
required>

<option value="">-- Pilih KPI --</option>

<?php foreach($listKPI as $k): ?>

<option

value="<?= $k['id']; ?>"

data-target="<?= $k['target']; ?>"

>

<?= $k['kode']; ?>

-

<?= $k['nama_kpi']; ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<br>

<div class="row">

<div class="col-md-6">

<label>Target</label>

<input

type="number"

name="target"

id="target"

class="form-control"

readonly>

</div>

<div class="col-md-6">

<label>Realisasi</label>

<input

type="number"

name="realisasi"

class="form-control"

required>

</div>

</div>

<br>

<div class="form-group">

<label>Jobdesk</label>

<textarea
id="jobdesk"
name="jobdesk"
class="form-control"
rows="3"
readonly></textarea>

</div>
<div class="form-group">

<label>Deskripsi KPI</label>

<textarea
id="deskripsi"
class="form-control"
rows="4"
readonly></textarea>

</div>
<label>Keterangan</label>

<textarea

name="keterangan"

class="form-control"

rows="4"></textarea>

<br>

<label>Upload Evidence</label>

<input

type="file"

name="file_bukti"

class="form-control"

accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

</div>

<div class="card-footer">

<button
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan Evidence

</button>

<a
href="evidence.php"
class="btn btn-secondary">

Kembali

</a>

</div>

</form>

</div>

<script>

$("#kpi").change(function(){

    let id=$(this).val();

    if(id==""){

        $("#target").val("");

        $("#jobdesk").val("");

        $("#deskripsi").val("");

        return;

    }

    $.getJSON(

        "evidence.php?action=detailkpi&id="+id,

        function(res){

            $("#target").val(res.target);

            $("#jobdesk").val(res.nama_kpi);

            $("#deskripsi").val(res.deskripsi);

        }

    );

});

</script>