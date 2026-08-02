<section class="content-header">

<div class="container-fluid">

<h3>
Tambah Kelas
</h3>

</div>

</section>



<section class="content">

<div class="container-fluid">


<div class="card">


<form method="POST"
action="<?= base_url('kelas.php?action=store') ?>">



<div class="card-body">


<div class="row">


<div class="col-md-6">

<div class="form-group">

<label>
Nama Kelas
</label>


<input type="text"
name="nama_kelas"
class="form-control"
placeholder="Contoh: X TKJ 1"
required>


</div>

</div>




<div class="col-md-6">

<div class="form-group">

<label>
Tingkat
</label>


<select name="tingkat"
class="form-control"
required>


<option value="">
-- Pilih Tingkat --
</option>

<option value="X">
VII
</option>


<option value="XI">
VIII
</option>


<option value="XII">
IX
</option>

<option value="X">
X
</option>


<option value="XI">
XI
</option>


<option value="XII">
XII
</option>


</select>


</div>

</div>



</div>





<div class="row">


<div class="col-md-6">


<div class="form-group">


<label>
Jurusan
</label>


<input type="text"
name="jurusan"
class="form-control"
placeholder="Contoh: Teknik Komputer dan Jaringan"
required>


</div>


</div>




<div class="col-md-6">


<div class="form-group">





<div class="form-group">

    <label>Wali Kelas</label>

    <select name="wali_kelas_id" class="form-control">

        <option value="">-- Pilih Wali Kelas --</option>

        <?php foreach($guru as $g): ?>

            <option value="<?= $g['id']; ?>">

                <?= htmlspecialchars($g['nama']); ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

</div>


</div>


</div>



</div>





<div class="card-footer">


<button type="submit"
class="btn btn-primary">


<i class="fas fa-save"></i>

Simpan


</button>



<a href="<?= base_url('kelas.php') ?>"
class="btn btn-secondary">

Kembali

</a>



</div>



</form>


</div>


</div>


</section>