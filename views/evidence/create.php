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

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Guru</label>

<input

type="text"

class="form-control"

value="<?= $user['nama'];?>"

readonly>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jabatan</label>

<input

type="text"

class="form-control"

value="<?= $user['jabatan'];?>"

readonly>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Tanggal</label>

<input

type="date"

name="tanggal"

class="form-control"

value="<?= date('Y-m-d');?>"

required>

</div>

</div>

<div class="col-md-6">
<div class="form-group">

    <label>Target KPI</label>

    <input
        type="text"
        name="target_kpi"
        class="form-control"
        rows="3"
        placeholder="Masukkan Target KPI"
        required>

<input
    type="hidden"
    name="kpi_id"
    value="<?= $kpi[0]['id']; ?>">

</div>
</div>
</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Jobdesk</label>

<textarea

name="jobdesk"

class="form-control"

rows="3"

required></textarea>

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label>Target</label>

<input
type="number"
name="target"
class="form-control"
required>
</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label>Realisasi</label>

<input

type="number"

name="realisasi"

class="form-control"

required>

</div>

</div>

</div>

<div class="form-group">

<label>Deskripsi Evidence</label>

<textarea

name="deskripsi"

rows="5"

class="form-control"

required></textarea>

</div>

<div class="form-group">

<label>Upload Bukti</label>

<input

type="file"

name="file_bukti"

class="form-control"

accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">

</div>

</div>

<div class="card-footer">

<button

class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan

</button>

<a

href="evidence.php"

class="btn btn-secondary">

Kembali

</a>

</div>

</form>

</div>
<!-- <script>

$('#kpi').change(function(){

let id=$(this).val();

$.get(

'ajax/get_target_kpi.php',

{id:id},

function(data){

let hasil=JSON.parse(data);

$('#target').val(hasil.target);

});

});

</script> -->