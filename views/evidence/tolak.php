
<?php

include __DIR__.'/../layouts/header.php';
include __DIR__.'/../layouts/navbar.php';
include __DIR__.'/../layouts/sidebar.php';

?>
<div class="content-wrapper">

<section class="content">

<div class="container-fluid">
<div class="card card-danger">

<div class="card-header">

<h3 class="card-title">

Tolak Evidence

</h3>

</div>

<form method="post">

<div class="card-body">

<div class="form-group">

<label>Alasan Penolakan</label>

<textarea

name="catatan"

class="form-control"

rows="5"

required></textarea>

</div>

</div>

<div class="card-footer">

<button class="btn btn-danger">

Tolak

</button>

<a href="evidence.php"

class="btn btn-secondary">

Batal

</a>

</div>

</form>

</div>


</section>

</div>

<?php

include __DIR__.'/../layouts/footer.php';

?>

