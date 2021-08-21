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
            <a href="<?= base_url('Admin/Peserta'); ?>" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class=" fa fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>

            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Username : <?= $peserta[0]['username'] ?></h6>
                </div>
                <div class="card-body">
                    <div class="table">
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Peserta/' . $peserta[0]['id']) ?>">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input value="<?= $peserta[0]['nama'] ?>" maxlength="50" autocomplete="off" class="form-control" required type="text" name="nama_param" placeholder="Masukkan nama lengkap..." />
                            </div>
                            <div class="form-group">
                                <label>Alamat Email</label>
                                <input value="<?= $peserta[0]['email'] ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" autocomplete="off" class="form-control" required type="email" name="email_param" placeholder="Masukkan email..." />
                            </div>
                            <div class="form-group">
                                <label>Instansi</label>
                                <input value="<?= $peserta[0]['instansi'] ?>" maxlength="50" autocomplete="off" class="form-control" required type="text" name="instansi_param" placeholder="Masukkan asal instansi..." />
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label for="noHp">No Handphone</label>
                                </div>
                                <div class="col-6">
                                    <label for="jenisKelamin">Jenis Kelamin</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input value="<?= $peserta[0]['no_hp'] ?>" required type="tel" pattern="[0-9]{11,}" maxlength="15" class="form-control form-control-user" id="noHp" placeholder="Masukan no handphone..." name="no_hp_param">
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline" checked="<?= $peserta[0]['jenis_kelamin'] ?>">
                                        <?php
                                        $checkedJenisKelamin = $peserta[0]['jenis_kelamin'];
                                        foreach ($jenisKelamin as $key) : ?>
                                            <input <?= ($checkedJenisKelamin == $key['description']) ?  "checked" : "";  ?> required class="form-check-input" type="radio" name="jenis_kelamin_id_param" id="<?= "jenis_kelamin_" . $key['id']; ?>" value="<?= $key['id']; ?>" required>
                                            <label class="form-check-label mr-4" for="<?= "jenis_kelamin_" . $key['id']; ?>">
                                                <?= $key['description']; ?>
                                            </label>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control" type="hidden" name="id_param" value="<?= $peserta[0]['id'] ?>" />
                            <div class="modal-footer">
                                <button type="submit" onclick="return confirm('Apakah anda yakin menyimpan perubahan pada peserta : <?= $peserta[0]['username'] ?> ?')" name="buttonEditPeserta" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
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