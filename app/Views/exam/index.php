<?php
echo $this->extend('/templates/exam/v_layout');
echo $this->section('content');
?>

<!-- Begin Page Content -->
<div class="container-fluid text-dark">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">No. 1 - Wawancara</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-bug fa-sm text-white-50"></i> Laporkan Soal</a>
    </div>

    <!-- content -->
    <p class="text-justify ">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae quas corporis sapiente, facere aut aliquam reprehenderit repellat quisquam perferendis blanditiis doloribus eius debitis dolor iusto temporibus soluta officiis quod. Cumque commodi porro et blanditiis eligendi ipsa officiis facere praesentium tenetur magni quas voluptatibus, quae explicabo, ea consequatur impedit sunt fugiat tempore id illum, maxime eum! Cum consequuntur voluptatem aspernatur! Eligendi laborum doloribus debitis, repudiandae, vel nobis porro quia repellendus, laudantium reprehenderit excepturi. Officiis temporibus corrupti voluptatem inventore quia. Maiores similique aspernatur ducimus repellat asperiores dolorum recusandae atque, libero repellendus, tenetur modi aliquid perspiciatis, cumque ut ab eos quasi suscipit. Dolore. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id quibusdam eum molestiae earum necessitatibus, nam amet nisi doloremque harum ipsam dolorum architecto eaque qui iure dignissimos ab nostrum sapiente eos!</p>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="opsi" id="opsiA">
        <label class="form-check-label" for="opsiA">
            A.
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="opsi" id="opsiB">
        <label class="form-check-label" for="opsiB">
            Default radio
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="opsi" id="opsiC">
        <label class="form-check-label" for="opsiC">
            Default radio
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="opsi" id="opsiD">
        <label class="form-check-label" for="opsiD">
            Default radio
        </label>
    </div>

</div>
<!-- /.container-fluid -->

<div class="text-center mt-3 mb-3">
    <button type="submit" class="btn btn-primary mr-4"><i class="fa fa-arrow-left"></i> Soal Sebelumnya</button>
    <button type="submit" class="btn btn-primary">Soal Berikutnya <i class="fa fa-arrow-right"></i></button>
</div>

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>