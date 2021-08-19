<?php
echo $this->extend('/templates/admin/v_layout');
echo $this->section('content');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <!-- Validation -->
    <?= view('validation/flashData') ?>

    <div class="card border-left-primary">
        <div class="card-body">
            <a href="<?= base_url('Admin/Kategori'); ?>" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class=" fa fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>

            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kode Kategori : <?= $kategori[0]['kode'] ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?= view('validation/flashData') ?>
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Kategori/' . $kategori[0]['id']) ?>">
                            <div class="col-12 row">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group col-6">
                                    <label>Nama Kategori</label>
                                    <input maxlength="100" required autocomplete="off" class="form-control" type="text" name="nama_param" id="nama-param" value="<?= $kategori[0]['nama'] ?>" />
                                </div>
                                <div class="form-group col-6">
                                    <label>Nilai Kategori</label>
                                    <input required autocomplete="off" class="form-control" type="number" min="0" name="nilai_param" value="<?= $kategori[0]['nilai'] ?>" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="id_param" value="<?= $kategori[0]['id'] ?>" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" onclick="return confirm('Apakah anda yakin menyimpan perubahan pada kategori : <?= $kategori[0]['kode'] ?> ?')" name="buttonEditKategori" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
                                        <i class=" fa fa-save"></i>
                                    </span>
                                    <span class="text">Simpan</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End of Data Table -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Edit Pertanyaan -->
<?= $this->endSection(); ?>