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
            <form action="<?= base_url('Admin/Kategori'); ?>" method="POST" class="d-inline">
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
                            <td class="col-1">Kode Kategori</td>
                            <td class="col-7">Nama Kategori</td>
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
                                <td><?= $key['nilai'] ?></td>
                                <td class="text-center">
                                    <form action="<?= base_url('Admin/Kategori/recoveryKategori'); ?>/<?= $key['id']; ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-secondary btn-sm" title="Pulih" onclick="return confirm('Apakah anda ingin memulihkan kategori <?= $key['nama']; ?> ?')"><i class="fas fa-box "></i></button>
                                    </form>
                                    <form action="<?= base_url('Admin/Kategori/deleteKategoriArsip'); ?>/<?= $key['id']; ?>" method="POST" class="d-inline">
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