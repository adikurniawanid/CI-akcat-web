<?php
$no = 0;
foreach ($sesi as $row) : $no++;
    $waktu_mulai_param = explode(' ', $row['waktu_mulai']);
?>
    <div class="modal fade" id="modalEditSesi<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit <?= $judul ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/SesiUjian/editSesiUjian') ?>">
                        <div class="form-group">
                            <label>Nama Ujian</label>
                            <input maxlength="100" autocomplete="off" required class="form-control" type="text" name="nama_param" placeholder="Masukkan nama ujian..." value="<?= $row['nama_ujian'] ?>" />
                        </div>
                        <div class="form-group">
                            <label>Lokasi Ujian</label>
                            <input maxlength="100" autocomplete="off" required class="form-control" type="text" name="lokasi_param" placeholder="Masukkan lokasi ujian..." value="<?= $row['tempat_ujian'] ?>" />
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Ujian</label>
                                    <input type="date" required class="form-control" name="tanggal_ujian_param" value="<?= $waktu_mulai_param[0] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jam Ujian</label>
                                    <input type="time" required class="form-control" name="jam_ujian_param" value="<?= $waktu_mulai_param[1] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Durasi</label>
                            <input autocomplete="off" required class="form-control" type="number" min="0" name="durasi_param" placeholder="Masukkan durasi dalam menit..." value="<?= $row['durasi'] ?>" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id_param" value="<?= $row['id'] ?>" />
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="buttonEditSesiUjian" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>