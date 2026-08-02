<?php

include __DIR__ . '/header.php';
include __DIR__ . '/navbar.php';
include __DIR__ . '/sidebar.php';

?>

<div class="content-wrapper">


    <?php if(isset($_SESSION['success'])): ?>

    <div class="alert alert-success alert-dismissible fade show m-3">

        <i class="fas fa-check-circle"></i>

        <?= $_SESSION['success']; ?>


        <button type="button"
                class="close"
                data-dismiss="alert">

            <span>&times;</span>

        </button>

    </div>


    <?php unset($_SESSION['success']); ?>

    <?php endif; ?>



    <?php if(isset($_SESSION['error'])): ?>

    <div class="alert alert-danger alert-dismissible fade show m-3">

        <i class="fas fa-times-circle"></i>

        <?= $_SESSION['error']; ?>


        <button type="button"
                class="close"
                data-dismiss="alert">

            <span>&times;</span>

        </button>

    </div>


    <?php unset($_SESSION['error']); ?>

    <?php endif; ?>


    <?= $content ?>


</div>


<?php

include __DIR__ . '/footer.php';

?>