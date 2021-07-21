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

    <div class="card">
        <div class="card-body">
            <div class="btn btn-primary mb-4 mr-4" data-toggle="modal" data-target="#addKategori">
                <i class="fa fa-plus"></i>
                Tambah Kategori
            </div>
            <form action="<?= base_url('Admin/Kategori/kategoriArsip'); ?>" method="POST" class="d-inline">
                <button class="btn btn-primary mb-4 float-right">
                    <i class=" fa fa-save"></i>
                    Arsip Kategori
                </button>
            </form>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="dataTable" height="100%" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <td class="col-1">No</td>
                            <td class="col-2">Kode Kategori</td>
                            <td class="col-5">Nama Kategori</td>
                            <!-- <td class="col-1">Jumlah Soal</td> -->
                            <td class="col-1">Bobot Nilai</td>
                            <td class="col-2">Aksi</td>
                        </tr>
                        <?php $i = 1 ?>
                        <?php
                        foreach ($kategori as $key) : ?>
                            <tr class="text-center ">
                                <td><?= $i; ?></td>
                                <td><?= $key['kode'] ?></td>
                                <td class="text-left"><?= $key['nama']; ?></td>
                                <!-- <td> -->
                                <? //= (base_url('/Admin/Kategori/getJumlahSoalByKategori') . '/' . $key['id']) 
                                ?>
                                <!-- </td> -->
                                <td><?= $key['nilai'] ?></td>
                                <td class="text-center">
                                    <button type="button" data-toggle="modal" data-target="#modalEditKategori<?= $key['id']; ?>" class="btn btn-success btn-sm" id="btn-edit-kategori" title="Edit"><i class="fas fa-edit "></i></button>
                                    <form action="/Admin/kategori/arsipKategori/<?= $key['id']; ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-secondary btn-sm" id="btn-archive-kategori" title="Arsip" onclick="return confirm('Apakah anda ingin mengarsipkan kategori <?= $key['nama']; ?> ?')"><i class="fas fa-archive "></i></button>
                                    </form>
                                    <form action="/Admin/kategori/deleteKategori/<?= $key['id']; ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus kategori <?= $key['nama']; ?> ?')" title="Hapus"><i class="fas fa-trash"></i></button>
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

<!-- Modal Add Kategori -->
<div class="modal fade" id="addKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <input autocomplete="off" class="form-control" type="text" name="nama_param" placeholder="Masukkan nama kategori..." />
                    </div>
                    <div class="form-group">
                        <label>Nilai Kategori</label>
                        <input autocomplete="off" class="form-control" type="number" min="0" name="nilai_param" placeholder="Masukkan nilai kategori..." />
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
<!-- End of Modal Add Kategori -->

<!-- Modal Edit Kategori -->
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
                            <input class="form-control" type="text" name="nama_param" id="nama-param" value="<?= $row['nama'] ?>" />
                        </div>
                        <div class="form-group">
                            <label>Nilai Kategori</label>
                            <input class="form-control" type="number" min="0" name="nilai_param" value="<?= $row['nilai'] ?>" />
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
<!-- End of Modal Edit Kategori -->