<div class="modal fade" id="modalAddKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Kategori/addKategori') ?>">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input maxlength="100" autocomplete="off" class="form-control" required type="text" name="nama_param" placeholder="Masukkan nama kategori..." />
                    </div>
                    <div class="form-group">
                        <label>Nilai Kategori</label>
                        <input autocomplete="off" class="form-control" required type="number" min="0" name="nilai_param" placeholder="Masukkan nilai kategori..." />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="buttonAddKategori" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>