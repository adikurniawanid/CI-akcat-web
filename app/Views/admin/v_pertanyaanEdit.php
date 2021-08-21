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
            <a href="<?= base_url('Admin/Pertanyaan'); ?>" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class=" fa fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>

            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kode Pertanyaan : <?= $pertanyaan[0]['kode'] ?></h6>
                </div>
                <div class="card-body">
                    <div class="table">
                        <?= view('validation/flashData') ?>
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Pertanyaan/' . $pertanyaan[0]['id']) ?>">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label>Kategori Soal</label>
                                <?php $selectedKategori = $pertanyaan[0]['kategori_id']; ?>
                                <select class="custom-select" id="kategori_id_param" name="kategori_id_param" required>
                                    <option value="">Pilih Kategori Soal</option>
                                    <?php
                                    foreach ($kategori_list as $key) : ?>
                                        <option <?= $key['nama'] == $pertanyaan[0]['kategori'] ? "selected='selected'" : ""; ?> value="<?= $key['id'] ?>"><?= '[' . $key['kode'] . ']   ' . $key['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <hr>
                                <label>Pertanyaan</label>
                                <textarea required class="form-control ckeditor" type="text" name="pertanyaan_param" placeholder="Masukkan pertanyaan..." /><?= $pertanyaan[0]['pertanyaan'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <hr>
                                <div class="mb-3 pertanyaan row">
                                    <!-- baru -->
                                    <?php
                                    if (is_null($pertanyaan[0]['gambar'])) {
                                        $pertanyaan['gambar'] = "Tidak Ada File";
                                    }
                                    if (is_null($pertanyaan[0]['audio'])) {
                                        $pertanyaan['audio'] = "Tidak Ada File";
                                    }
                                    ?>
                                    <div class="col-6">
                                        <label for="staticGambar" class="col-form-label">Gambar yang Tersimpan</label>
                                        <!-- <div class="col-sm-10"> -->
                                        <input type="text" readonly class="form-control" id="staticGambar" value="<?= $pertanyaan['gambar'] ?>">
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-6">
                                        <label for="staticAudio" class="col-form-label">Audio yang Tersimpan</label>
                                        <!-- <div class="col-sm-10"> -->
                                        <input type="text" readonly class="form-control" id="staticAudio" value="<?= $pertanyaan['audio'] ?>">
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <!-- end of baru -->

                                <div class="pertanyaan row">
                                    <div class="col-6">
                                        <label for="gambar" class="form-label">Gambar Pertanyaan</label>
                                        <input style="border: none;" class="form-control" id="gambar_param" name="gambar_param" type="file" accept="image/png, image/jpeg, image/jpg" value="<?= $pertanyaan[0]['gambar'] ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="audio" class="form-label">Audio Pertanyaan</label>
                                        <input style="border: none;" class="form-control" id="audio_param" name="audio_param" type="file" accept="audio/*">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label>Kunci Jawaban</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <div class="pertanyaan">
                                    <?php $checkedKunci = $pertanyaan[0]['kunci']; ?>
                                    <div class="col" checked="<?= $pertanyaan[0]['kunci'] ?>">
                                        <input class="form-check-input" type="radio" name="kunci_param" id="kunci_a" value="A" required <?= ($checkedKunci == 'A') ?  "checked" : "";  ?>>
                                        <label class="form-check-label mr-4" for="kunci_a">
                                            A
                                        </label>
                                        <input class="form-check-input" type="radio" name="kunci_param" id="kunci_b" value="B" <?= ($checkedKunci == 'B') ?  "checked" : "";  ?>>
                                        <label class="form-check-label mr-4" for="kunci_b">
                                            B
                                        </label>
                                        <input class="form-check-input" type="radio" name="kunci_param" id="kunci_c" value="C" <?= ($checkedKunci == 'C') ?  "checked" : "";  ?>>
                                        <label class="form-check-label mr-4" for="kunci_c">
                                            C
                                        </label>
                                        <input class="form-check-input" type="radio" name="kunci_param" id="kunci_d" value="D" <?= ($checkedKunci == 'D') ?  "checked" : "";  ?>>
                                        <label class="form-check-label " for="kunci_d">
                                            D
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <hr>
                                <label>Opsi A</label>
                                <textarea required class="form-control" name="opsi_a_param" placeholder="Masukkan opsi a..."><?= $pertanyaan[0]['opsi_a'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Opsi B</label>
                                <textarea required class="form-control" name="opsi_b_param" placeholder="Masukkan opsi b..."><?= $pertanyaan[0]['opsi_b'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Opsi C</label>
                                <textarea required class="form-control" name="opsi_c_param" placeholder="Masukkan opsi c..."><?= $pertanyaan[0]['opsi_c'] ?> </textarea>
                            </div>
                            <div class="form-group">
                                <label>Opsi D</label>
                                <textarea required class="form-control" name="opsi_d_param" placeholder="Masukkan opsi d..."><?= $pertanyaan[0]['opsi_d'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id_param" value="<?= $pertanyaan[0]['id'] ?>" />
                                <input class="form-control" type="hidden" name="old_gambar_param" value="<?= $pertanyaan[0]['gambar'] ?>" />
                                <input class="form-control" type="hidden" name="old_audio_param" value="<?= $pertanyaan[0]['audio'] ?>" />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" onclick="return confirm('Apakah anda yakin menyimpan perubahan pada pertanyaan : <?= $pertanyaan[0]['kode'] ?> ?')" name="buttonEditPertanyaan" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
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