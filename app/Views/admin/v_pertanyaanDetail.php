<?php
echo $this->extend('/templates/v_layout');
echo $this->section('content');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <!-- Validation -->
    <?= view('validation/flashData') ?>

    <div class="card border-left-primary">
        <div class="card-body ">
            <a href="<?= base_url('Admin/Pertanyaan'); ?>" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class=" fa fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>


            <?php
            foreach ($pertanyaan as $key) : ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Kode Soal : <?= $key['kode']; ?></h6>
                    </div>
                    <div class="card-body text-black-100 text-justify">
                        <p>
                            <b>Kategori :</b>
                            <br>
                            <?= $key['kategori']; ?>
                        </p>
                        <hr>
                        <p>
                            <b>Pertanyaan :</b>
                            <br>
                            <?= $key['pertanyaan']; ?>
                        </p>
                        <hr>
                        <b>Opsi Jawaban :</b>
                        <?php $checkedKunci = $key['kunci']; ?>
                        <div class="table-responsive">
                            <!-- <table width="100%" cellspacing="0">
                                <thead class="text-justify">
                                    <tr>
                                        <td class="col-1 text-right">
                                            <div class="btn btn-primary">A</div>
                                        </td>
                                        <td class="col-11"><?= $key['opsi_a']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 text-right">
                                            <div class="btn">B</div>
                                        </td>
                                        <td class="col-11"><?= $key['opsi_b']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 text-right">
                                            <div class="btn">C</div>
                                        </td>
                                        <td class="col-11"><?= $key['opsi_c']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-1 text-right">
                                            <div class="btn">D</div>
                                        </td>
                                        <td class="col-11"><?= $key['opsi_d']; ?></td>
                                    </tr>
                                </thead>
                            </table>
                            <br> -->

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" disabled <?= ($checkedKunci == 'A') ?  "checked" : "";  ?>>
                                <label class="form-check-label">
                                    A. <?= $key['opsi_a']; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" disabled <?= ($checkedKunci == 'B') ?  "checked" : "";  ?>>
                                <label class="form-check-label">
                                    B. <?= $key['opsi_b']; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" disabled <?= ($checkedKunci == 'C') ?  "checked" : "";  ?>>
                                <label class="form-check-label">
                                    C. <?= $key['opsi_c']; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" disabled <?= ($checkedKunci == 'D') ?  "checked" : "";  ?>>
                                <label class="form-check-label">
                                    D. <?= $key['opsi_d']; ?>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

                </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>