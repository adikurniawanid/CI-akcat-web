<div class="modal fade" id="modalAddPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Peserta/addPeserta') ?>">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input autocomplete="off" class="form-control" type="text" name="nama_param" placeholder="Masukkan nama lengkap..." />
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input pattern="[a-z0-9._%+-].{8,}" maxlength="20" autocomplete="off" class="form-control" required type="text" name="username_param" placeholder="Masukkan username (minimal 8 karakter)..." />
                    </div>
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" autocomplete="off" class="form-control" required type="email" name="email_param" placeholder="Masukkan email..." />
                    </div>
                    <div class="form-group">
                        <label>Instansi</label>
                        <input maxlength="50" autocomplete="off" class="form-control" required type="text" name="instansi_param" placeholder="Masukkan asal instansi..." />
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
                            <input required type="tel" pattern="[0-9]{11,}" maxlength="15" class="form-control form-control-user" id="noHp" placeholder="Masukan no handphone..." name="no_hp_param">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check form-check-inline">
                                <?php
                                foreach ($jenisKelamin as $row) : ?>
                                    <input required class="form-check-input" type="radio" name="jenis_kelamin_id_param" id="<?= "jenis_kelamin_" . $row['id']; ?>" value="<?= $row['id']; ?>" required>
                                    <label class="form-check-label mr-4" for="<?= "jenis_kelamin_" . $row['id']; ?>">
                                        <?= $row['description']; ?>
                                    </label>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <input pattern="[a-z0-9._%+-].{8,}" autocomplete="off" class="form-control" required type="password" name="password_param" placeholder="Masukkan kata sandi (minimal 8 karakter)..." />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="buttonAddPeserta" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>