<div class="modal fade" id="modalAddPertanyaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Pertanyaan/addPertanyaan') ?>">
                    <div class="form-group">
                        <label>Kategori Soal</label>
                        <select class="custom-select" id="kategori_id_param" name="kategori_id_param" required>
                            <option value="">Pilih Kategori Soal</option>
                            <?php
                            foreach ($kategori_list as $row) : ?>
                                <option value="<?= $row['id'] ?>"><?= '[' . $row['kode'] . ']   ' . $row['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <hr>
                        <label>Pertanyaan</label>
                        <textarea required class="form-control" type="text" name="pertanyaan_param" placeholder="Masukkan pertanyaan..." /></textarea>
                    </div>
                    <div class="form-group">
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <label for="gambar" class="form-label">Gambar Pertanyaan</label>
                                <input class="form-control" id="gambar_param" name="gambar_param" type="file" accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="col-6">
                                <label for="audio" class="form-label">Audio Pertanyaan</label>
                                <input class="form-control" id="audio_param" name="audio_param" type="file" accept="audio/*">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label>Kunci Jawaban</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="radio" name="kunci_param" id="kunci_a" value="A" required>
                                <label class="form-check-label mr-4" for="kunci_a">
                                    A
                                </label>
                                <input class="form-check-input" type="radio" name="kunci_param" id="kunci_b" value="B">
                                <label class="form-check-label mr-4" for="kunci_b">
                                    B
                                </label>
                                <input class="form-check-input" type="radio" name="kunci_param" id="kunci_c" value="C">
                                <label class="form-check-label mr-4" for="kunci_c">
                                    C
                                </label>
                                <input class="form-check-input" type="radio" name="kunci_param" id="kunci_d" value="D">
                                <label class="form-check-label " for="kunci_d">
                                    D
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <hr>
                        <label>Opsi A</label>
                        <textarea required class="form-control" name="opsi_a_param" placeholder="Masukkan opsi a..." /></textarea>
                    </div>
                    <div class="form-group">
                        <label>Opsi B</label>
                        <textarea required class="form-control" name="opsi_b_param" placeholder="Masukkan opsi b..." /></textarea>
                    </div>
                    <div class="form-group">
                        <label>Opsi C</label>
                        <textarea required class="form-control" name="opsi_c_param" placeholder="Masukkan opsi c..." /></textarea>
                    </div>
                    <div class="form-group">
                        <label>Opsi D</label>
                        <textarea required class="form-control" name="opsi_d_param" placeholder="Masukkan opsi d..." /></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="buttonAddPertanyaan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>