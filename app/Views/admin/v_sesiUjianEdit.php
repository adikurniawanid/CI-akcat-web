<?php
echo $this->extend('/templates/admin/v_layout');
echo $this->section('content');
?>

<?php $waktu_mulai_param = explode(' ', $sesi[0]['waktu_mulai']); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <!-- Validation -->
    <?= view('validation/flashData') ?>

    <div class="card border-left-primary">
        <div class="card-body">
            <a href="<?= base_url('Admin/SesiUjian'); ?>" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class=" fa fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>

            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kode Sesi : <?= $sesi[0]['kode'] ?></h6>
                </div>
                <div class="card-body">
                    <div class="table">
                        <?= view('validation/flashData') ?>
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/SesiUjian/' . $sesi[0]['id']) ?>">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label>Nama Ujian</label>
                                <input maxlength="100" autocomplete="off" required class="form-control" type="text" name="nama_param" placeholder="Masukkan nama ujian..." value="<?= $sesi[0]['nama_ujian'] ?>" />
                            </div>
                            <div class="form-group">
                                <label>Lokasi Ujian</label>
                                <input maxlength="100" autocomplete="off" required class="form-control" type="text" name="lokasi_param" placeholder="Masukkan lokasi ujian..." value="<?= $sesi[0]['tempat_ujian'] ?>" />
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Tanggal Ujian</label>
                                        <input type="date" required class="form-control" name="tanggal_ujian_param" value="<?= $waktu_mulai_param[0]
                                                                                                                            ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Jam Ujian</label>
                                        <input type="time" required class="form-control" name="jam_ujian_param" value="<?= $waktu_mulai_param[1]
                                                                                                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label>Durasi</label>
                                    <input autocomplete="off" required class="form-control" type="number" min="0" name="durasi_param" placeholder="Masukkan durasi dalam menit..." value="<?= $sesi[0]['durasi'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id_param" value="<?= $sesi[0]['id'] ?>" />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" onclick="return confirm('Apakah anda yakin menyimpan perubahan pada sesi ujian : <?= $sesi[0]['kode'] ?> ?')" name="buttonEditSesiUjian" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
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

<?= $this->endSection(); ?>