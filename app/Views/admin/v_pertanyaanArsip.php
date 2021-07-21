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
            <form action="<?= base_url('/Admin/Pertanyaan'); ?>" method="POST" class="d-inline">
                <button class="btn btn-primary mb-4">
                    <i class=" fa fa-arrow-left"></i>
                    Kembali
                </button>
            </form>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="dataTable" height="100%" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <td class="col-1">No</td>
                            <td class="col-1">Kode Soal</td>
                            <td class="col-6">Pertanyaan</td>
                            <td class="col-2">Kategori</td>
                            <td class="col-2">Aksi</td>
                        </tr>
                        <?php $i = 1 ?>
                        <?php
                        foreach ($pertanyaan as $key) : ?>
                            <tr class="text-center ">
                                <td><?= $i; ?></td>
                                <td class="text-center"><?= $key['kode'] ?></td>
                                <td class="text-justify"><?= $key['pertanyaan'] ?></td>
                                <td class="text-left"><?= $key['kategori']; ?></td>
                                <td class="text-center">
                                    <form action="<?= base_url('Admin/pertanyaan/recoveryPertanyaan/' . $key['id']); ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-secondary btn-sm" title="Pulih" onclick="return confirm('Apakah anda ingin memulihkan pertanyaan dengan kode : <?= $key['kode']; ?> ?')"><i class="fas fa-box "></i></button>
                                    </form>
                                    <form action="<?= base_url('Admin/pertanyaan/deletePertanyaanArsip/' . $key['id']); ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus pertanyaan dengan kode :  <?= $key['kode']; ?> ?')" title="Hapus"><i class="fas fa-trash"></i></button>
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
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('Kategori/addKategori') ?>">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input class="form-control" type="text" name="nama_param" placeholder="Masukkan nama kategori..." />
                    </div>
                    <div class="form-group">
                        <label>Nilai Kategori</label>
                        <input class="form-control" type="number" min="0" name="nilai_param" placeholder="Masukkan nilai kategori..." />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Add Kategori -->


<!-- Modal Edit Kategori -->

<!-- End of Modal Edit Kategori -->