<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <?php

    use App\Controllers\Kategori;

    if (session()->get('message')) : ?>
        <div class="alert alert-success alert-alert-dismissible fade show " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?= session()->getFlashData('message'); ?>
        </div>
    <?php endif
    ?>
    <?php if (session()->get('err')) : ?>
        <div class="alert alert-danger alert-alert-dismissible fade show " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?= session()->getFlashData('err'); ?>
        </div>
    <?php endif ?>
    <div class="card border-left-primary">
        <div class="card-body">
            <a data-toggle="modal" data-target="#addPertanyaan" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Pertanyaan</span>
            </a>

            <a href="<?= base_url('Admin/Pertanyaan/Arsip'); ?>" class="btn btn-primary btn-icon-split mb-3 float-right">
                <span class="icon text-white-50">
                    <i class=" fa fa-save"></i>
                </span>
                <span class="text">Arsip Pertanyaan</span>
            </a>
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= "Tabel Data " . $judul; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="toDataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th class="col-1">No</th>
                                    <th class="col-1">Kode Soal</th>
                                    <th class="col-6">Pertanyaan</th>
                                    <th class="col-2">Kategori</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Soal</th>
                                    <th>Pertanyaan</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($pertanyaan as $key) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $key['kode'] ?></td>
                                        <td><?= $key['pertanyaan'] ?></td>
                                        <td><?= $key['kategori']; ?></td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#modalEditPertanyaan<?= $key['id']; ?>" class="btn btn-success btn-sm" id="btn-edit-kategori" title="Edit"><i class="fas fa-edit "></i></button>
                                            <form action="<?= base_url('Admin/pertanyaan/arsipPertanyaan/' . $key['id']); ?>" method="POST" class="d-inline">
                                                <button type="submit" class="btn btn-secondary btn-sm" id="btn-archive-kategori" title="Arsip" onclick="return confirm('Apakah anda ingin mengarsipkan pertanyaan dengan kode : <?= $key['kode']; ?> ?')"><i class="fas fa-archive "></i></button>
                                            </form>
                                            <form action="<?= base_url('Admin/pertanyaan/deletePertanyaan/' . $key['id']); ?>" method="POST" class="d-inline">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus pertanyaan dengan kode :  <?= $key['kode']; ?> ?')" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php $no++;
                                endforeach ?>
                            </tbody>
                        </table>
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

<!-- Modal Add Kategori -->
<div class="modal fade" id="addPertanyaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
<!-- End of Modal Add Kategori -->

<!-- Modal Edit Kategori -->
<?php
$no = 0;
foreach ($pertanyaan as $row) : $no++; ?>
    <div class="modal fade " id="modalEditPertanyaan<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit <?= $judul ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Pertanyaan/editPertanyaan') ?>">
                        <div class="form-group">
                            <label>Kategori Soal</label>
                            <?php $selectedKategori = $row['kategori_id']; ?>
                            <select class="custom-select" id="kategori_id_param" name="kategori_id_param" required>
                                <option value="">Pilih Kategori Soal</option>
                                <?php
                                foreach ($kategori_list as $key) : ?>
                                    <option <?= $key['nama'] == $row['kategori'] ? "selected='selected'" : ""; ?> value="<?= $key['id'] ?>"><?= '[' . $key['kode'] . ']   ' . $key['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <hr>
                            <label>Pertanyaan</label>
                            <textarea required class="form-control" type="text" name="pertanyaan_param" placeholder="Masukkan pertanyaan..." /><?= $row['pertanyaan'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <hr>

                            <!-- baru -->
                            <?php
                            if (is_null($row['gambar'])) {
                                $row['gambar'] = "Tidak Ada File";
                            }
                            if (is_null($row['audio'])) {
                                $row['audio'] = "Tidak Ada File";
                            }
                            ?>
                            <div class="mb-3 row">
                                <div class="col-6">
                                    <label for="staticGambar" class="col-form-label">Gambar yang Tersimpan</label>
                                    <!-- <div class="col-sm-10"> -->
                                    <input type="text" readonly class="form-control" id="staticGambar" value="<?= $row['gambar'] ?>">
                                    <!-- </div> -->
                                </div>
                                <div class="col-6">
                                    <label for="staticAudio" class="col-form-label">Audio yang Tersimpan</label>
                                    <!-- <div class="col-sm-10"> -->
                                    <input type="text" readonly class="form-control" id="staticAudio" value="<?= $row['audio'] ?>">
                                    <!-- </div> -->
                                </div>
                            </div>
                            <!-- end of baru -->

                            <div class="row">
                                <div class="col-6">
                                    <label for="gambar" class="form-label">Gambar Pertanyaan</label>
                                    <input style="border: none;" class="form-control" id="gambar_param" name="gambar_param" type="file" accept="image/png, image/jpeg, image/jpg" value="<?= $row['gambar'] ?>">
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
                            <div class="row">
                                <?php $checkedKunci = $row['kunci']; ?>
                                <div class="col" checked="<?= $row['kunci'] ?>">
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
                            <textarea required class="form-control" name="opsi_a_param" placeholder="Masukkan opsi a..."><?= $row['opsi_a'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Opsi B</label>
                            <textarea required class="form-control" name="opsi_b_param" placeholder="Masukkan opsi b..."><?= $row['opsi_b'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Opsi C</label>
                            <textarea required class="form-control" name="opsi_c_param" placeholder="Masukkan opsi c..."><?= $row['opsi_c'] ?> </textarea>
                        </div>
                        <div class="form-group">
                            <label>Opsi D</label>
                            <textarea required class="form-control" name="opsi_d_param" placeholder="Masukkan opsi d..."><?= $row['opsi_d'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id_param" value="<?= $row['id'] ?>" />
                            <input class="form-control" type="hidden" name="old_gambar_param" value="<?= $row['gambar'] ?>" />
                            <input class="form-control" type="hidden" name="old_audio_param" value="<?= $row['audio'] ?>" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="buttonEditPertanyaan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Modal Edit Kategori -->

<!-- End of Modal Edit Kategori -->