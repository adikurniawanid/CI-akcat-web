<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <?php

    use App\Controllers\SesiUjian;

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
    <div class="card">
        <div class="card-body">
            <div class="btn btn-primary mb-4 mr-4" data-toggle="modal" data-target="#addSesi">
                <i class="fa fa-plus"></i>
                Tambah Sesi
            </div>
            <form action="<?= base_url('Admin/SesiUjian/SesiUjianArsip'); ?>" method="POST" class="d-inline">
                <button class="btn btn-primary mb-4 float-right">
                    <i class=" fa fa-save"></i>
                    Arsip Ujian
                </button>
            </form>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="dataTable" height="100%" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <td class="col-1">No</td>
                            <td class="col-1">Kode Sesi</td>
                            <td class="col-2">Nama Ujian</td>
                            <td class="col-2">Lokasi Ujian</td>
                            <td class="col-2">Waktu Mulai</td>
                            <td class="col-2">Waktu Selesai</td>
                            <td class="col-1">Durasi</td>
                            <td class="col-2">Aksi</td>
                        </tr>
                        <?php $i = 1 ?>
                        <?php
                        foreach ($sesi as $key) : ?>
                            <tr class="text-center ">
                                <td><?= $i; ?></td>
                                <td><?= $key['kode']; ?></td>
                                <td class="text-left"><?= $key['nama_ujian']; ?></td>
                                <td class="text-left"><?= $key['tempat_ujian'] ?></td>
                                <td><?= $key['waktu_mulai'] ?></td>
                                <td><?= $key['waktu_selesai'] ?></td>
                                <td><?= $key['durasi'] ?></td>
                                <td class="text-center">
                                    <button type="button" data-toggle="modal" data-target="#editSesi<?= $key['id']; ?>" class="btn btn-success btn-sm" id="btn-edit-Sesi" title="Edit"><i class="fas fa-edit "></i></button>
                                    <form action="/Admin/SesiUjian/arsipSesiUjian/<?= $key['id']; ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-secondary btn-sm" id="btn-archive-kategori" title="Arsip" onclick="return confirm('Apakah anda ingin mengarsipkan sesi <?= $key['nama_ujian']; ?> ?')"><i class="fas fa-archive "></i></button>
                                    </form>
                                    <form action="/Admin/SesiUjian/deleteSesiUjian/<?= $key['id']; ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus sesi <?= $key['nama_ujian']; ?> ?')" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Add Sesi Ujian -->
<div class="modal fade" id="addSesi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/SesiUjian/addSesiUjian') ?>">
                    <div class="form-group">
                        <label>Nama Ujian</label>
                        <input autocomplete="off" class="form-control" type="text" name="nama_param" placeholder="Masukkan nama ujian..." />
                    </div>
                    <div class="form-group">
                        <label>Lokasi Ujian</label>
                        <input autocomplete="off" class="form-control" type="text" name="lokasi_param" placeholder="Masukkan lokasi ujian..." />
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Ujian</label>
                                <input type="date" class="form-control" name="tanggal_ujian_param">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Jam Ujian</label>
                                <input type="time" class="form-control" name="jam_ujian_param" min="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Durasi</label>
                        <input autocomplete="off" class="form-control" type="number" min="0" name="durasi_param" placeholder="Masukkan durasi dalam menit..." />
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="buttonAddSesiUjian" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Add Sesi Ujian -->

<!-- Modal Edit Sesi Ujian -->
<?php
$no = 0;
foreach ($sesi as $row) : $no++;
    $waktu_mulai_param = explode(' ', $row['waktu_mulai']);
?>
    <div class="modal fade" id="editSesi<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <input autocomplete="off" class="form-control" type="text" name="nama_param" placeholder="Masukkan nama ujian..." value="<?= $row['nama_ujian'] ?>" />
                        </div>
                        <div class="form-group">
                            <label>Lokasi Ujian</label>
                            <input autocomplete="off" class="form-control" type="text" name="lokasi_param" placeholder="Masukkan lokasi ujian..." value="<?= $row['tempat_ujian'] ?>" />
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Ujian</label>
                                    <input type="date" class="form-control" name="tanggal_ujian_param" value="<?= $waktu_mulai_param[0] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jam Ujian</label>
                                    <input type="time" class="form-control" name="jam_ujian_param" value="<?= $waktu_mulai_param[1] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Durasi</label>
                            <input autocomplete="off" class="form-control" type="number" min="0" name="durasi_param" placeholder="Masukkan durasi dalam menit..." value="<?= $row['durasi'] ?>" />
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
<!-- End of Modal Edit Sesi Ujian -->