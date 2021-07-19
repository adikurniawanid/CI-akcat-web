<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <div class="card">
        <div class="card-body">
            <div class="btn btn-primary mb-4" data-toggle="modal" data-target="#addKategori">Tambah Kategori</div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="dataTable" height="100%" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <td>No</td>
                            <td>Pertanyaan</td>
                            <td>Kategori</td>
                            <td>Aksi</td>
                        </tr>
                        <?php $i = 1 ?>
                        <?php
                        foreach ($siswa as $key) : ?>
                            <tr class="text-center ">
                                <td><?= $i; ?></td>
                                <td class="text-justify"><?= $key['pertanyaan'] ?></td>
                                <td class="text-left"><?= $key['kategori']; ?></td>
                                <td class="text-center">
                                    <a type="button" class="fas fa-pen-square fa-lg text-success" href="#"></a>
                                    <a type=" button" class="fas fa-trash fa-lg text-danger" href="#"></a>
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