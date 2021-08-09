<?php
$no = 0;
foreach ($peserta as $row) : $no++; ?>
    <div class="modal fade" id="modalEditPeserta<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit <?= $judul ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Peserta/editPeserta') ?>">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input value="<?= $row['nama'] ?>" maxlength="50" autocomplete="off" class="form-control" required type="text" name="nama_param" placeholder="Masukkan nama lengkap..." />
                        </div>
                        <div class="form-group">
                            <label>Alamat Email</label>
                            <input value="<?= $row['email'] ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" autocomplete="off" class="form-control" required type="email" name="email_param" placeholder="Masukkan email..." />
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input value="<?= $row['instansi'] ?>" maxlength="50" autocomplete="off" class="form-control" required type="text" name="instansi_param" placeholder="Masukkan asal instansi..." />
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
                                <input value="<?= $row['no_hp'] ?>" required type="tel" pattern="[0-9]{11,}" maxlength="15" class="form-control form-control-user" id="noHp" placeholder="Masukan no handphone..." name="no_hp_param">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check form-check-inline" checked="<?= $row['jenis_kelamin'] ?>">
                                    <?php
                                    $checkedJenisKelamin = $row['jenis_kelamin'];
                                    foreach ($jenisKelamin as $key) : ?>
                                        <input <?= ($checkedJenisKelamin == $key['description']) ?  "checked" : "";  ?> required class="form-check-input" type="radio" name="jenis_kelamin_id_param" id="<?= "jenis_kelamin_" . $key['id']; ?>" value="<?= $key['id']; ?>" required>
                                        <label class="form-check-label mr-4" for="<?= "jenis_kelamin_" . $key['id']; ?>">
                                            <?= $key['description']; ?>
                                        </label>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Kata Sandi Baru</label>
                            <input pattern="[a-z0-9._%+-].{8,}" autocomplete="off" class="form-control" type="password" name="password_baru_param" placeholder="Masukkan kata sandi baru (minimal 8 karakter)..." />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id_param" value="<?= $row['id'] ?>" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="buttonEditPeserta" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>