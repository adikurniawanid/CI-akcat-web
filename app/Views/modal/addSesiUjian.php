<div class="modal fade" id="modalAddSesi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/SesiUjian') ?>">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label>Nama Ujian</label>
                        <input maxlength="100" required autocomplete="off" class="form-control" type="text" name="nama_param" placeholder="Masukkan nama ujian..." />
                    </div>
                    <div class="form-group">
                        <label>Lokasi Ujian</label>
                        <input maxlength="100" required autocomplete="off" class="form-control" type="text" name="lokasi_param" placeholder="Masukkan lokasi ujian..." />
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Ujian</label>
                                <input required type="date" class="form-control" name="tanggal_ujian_param">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Jam Ujian</label>
                                <input required type="time" class="form-control" name="jam_ujian_param" min="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Durasi</label>
                        <input required autocomplete="off" class="form-control" type="number" min="0" name="durasi_param" placeholder="Masukkan durasi dalam menit..." />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="buttonAddSesiUjian" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>