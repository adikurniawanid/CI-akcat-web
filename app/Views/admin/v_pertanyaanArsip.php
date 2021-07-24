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
        <div class="card-body ">
            <a href="<?= base_url('Admin/Pertanyaan'); ?>" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class=" fa fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
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
                                            <form action="<?= base_url('Admin/pertanyaan/recoveryPertanyaan/' . $key['id']); ?>" method="POST" class="d-inline">
                                                <button type="submit" class="btn btn-secondary btn-sm" id="btn-archive-kategori" title="Pulih" onclick="return confirm('Apakah anda ingin memulihkan arsip pertanyaan dengan kode : <?= $key['kode']; ?> ?')"><i class="fas fa-archive "></i></button>
                                            </form>
                                            <form action="<?= base_url('Admin/pertanyaan/deletePertanyaanArsip/' . $key['id']); ?>" method="POST" class="d-inline">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus arsip pertanyaan dengan kode :  <?= $key['kode']; ?> ?')" title="Hapus"><i class="fas fa-trash"></i></button>
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