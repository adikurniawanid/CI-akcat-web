<?php
if (session()->get('message')) : ?>
    <div class="alert alert-success alert-alert-dismissible fade show " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= session()->getFlashData('message'); ?>
    </div>
<?php endif
?>
<?php if (session()->get('err')) : ?>
    <div class="alert alert-danger alert-alert-dismissible fade show " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= session()->getFlashData('err'); ?>
    </div>
<?php endif ?>