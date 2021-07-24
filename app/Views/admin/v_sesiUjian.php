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
    <div class="card border-left-primary">
        <div class="card-body">
            <a data-toggle="modal" data-target="#addSesi" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Sesi</span>
            </a>

            <a href="<?= base_url('Admin/SesiUjian/Arsip'); ?>" class="btn btn-primary btn-icon-split mb-3 float-right">
                <span class="icon text-white-50">
                    <i class=" fa fa-save"></i>
                </span>
                <span class="text">Arsip Sesi</span>
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
                                    <th class="col-1">Kode Sesi</th>
                                    <th class="col-2">Nama Ujian</th>
                                    <th class="col-2">Lokasi Ujian</th>
                                    <th class="col-1.5">Waktu Mulai</th>
                                    <th class="col-1.5">Waktu Selesai</th>
                                    <th class="col-1">Durasi</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Sesi</th>
                                    <th>Nama Ujian</th>
                                    <th>Lokasi Ujian</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Durasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($sesi as $key) : ?>
                                    <tr class="text-center">
                                        <td><?= $no; ?></td>
                                        <td><?= $key['kode']; ?></td>
                                        <td><?= $key['nama_ujian']; ?></td>
                                        <td><?= $key['tempat_ujian'] ?></td>
                                        <td><?= $key['waktu_mulai'] ?></td>
                                        <td><?= $key['waktu_selesai'] ?></td>
                                        <td><?= $key['durasi'] ?></td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#editSesi<?= $key['id']; ?>" class="btn btn-success btn-sm" id="btn-edit-Sesi" title="Edit"><i class="fas fa-edit "></i></button>
                                            <form action="/Admin/SesiUjian/arsipSesiUjian/<?= $key['id']; ?>" method="POST" class="d-inline">
                                                <button type="submit" class="btn btn-secondary btn-sm" id="btn-archive-kategori" title="Arsip" onclick="return confirm('Apakah anda ingin mengarsipkan sesi <?= $key['nama_ujian']; ?> ?')"><i class="fas fa-archive "></i></button>
                                            </form>
                                            <form action="/Admin/SesiUjian/deleteSesiUjian/<?= $key['id']; ?>" method="POST" class="d-inline">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus sesi <?= $key['nama_ujian']; ?> ?')" title="Hapus"><i class="fas fa-trash"></i></button>
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
<!-- End of Modal Edit Sesi Ujian -->