<?php
echo $this->extend('/templates/admin/v_layout');
echo $this->section('content');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <!-- Validation -->
    <?= view('validation/flashData') ?>

    <div class="card border-left-primary">
        <div class="card-body">
            <a href="<?= base_url('Admin/Kategori'); ?>" class="btn btn-primary btn-icon-split mb-3">
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
                        <table class="table table-bordered table-hover" id="toDataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th class="col-1">No</th>
                                    <th class="col-1">Kode Soal</th>
                                    <th class="col-8">Pertanyaan</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Soal</th>
                                    <th>Pertanyaan</th>
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
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#modalEditPertanyaan<?= $key['id']; ?>" class="btn btn-success btn-sm" id="btn-edit-Pertanyaan" title="Edit"><i class="fas fa-edit "></i></button>
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

<!-- Modal Edit Pertanyaan -->
<?= view('modal/editPertanyaan') ?>

<?= $this->endSection(); ?>