<?php
$no = 0;
foreach ($kategori as $row) : $no++; ?>
    <div class="modal fade" id="modalEditKategori<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit <?= $judul; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Kategori/editKategori') ?>">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input maxlength="100" required autocomplete="off" class="form-control" type="text" name="nama_param" id="nama-param" value="<?= $row['nama'] ?>" />
                        </div>
                        <div class="form-group">
                            <label>Nilai Kategori</label>
                            <input required autocomplete="off" class="form-control" type="number" min="0" name="nilai_param" value="<?= $row['nilai'] ?>" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id_param" value="<?= $row['id'] ?>" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="buttonEditKategori" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>