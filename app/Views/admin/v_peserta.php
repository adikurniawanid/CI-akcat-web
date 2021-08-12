<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Apakah anda yakin menyelesaikan sesi ujian</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">selesai</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">batal</button>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->extend('/templates/v_layout');
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
            <a data-toggle="modal" data-target="#modalAddPeserta" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Peserta</span>
            </a>

            <a href="<?= base_url('Admin/Peserta/Arsip'); ?>" class="btn btn-primary btn-icon-split mb-3 float-right">
                <span class="icon text-white-50">
                    <i class=" fa fa-save"></i>
                </span>
                <span class="text">Arsip Peserta</span>
            </a>

            <!-- DataTables -->
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
                                    <th class="col-1">Username</th>
                                    <th class="col-3">Nama Lengkap</th>
                                    <th class="col-2">No Handphone</th>
                                    <th class="col-3">Instansi</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>No Handphone</th>
                                    <th>Instansi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($peserta as $key) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $key['username'] ?></td>
                                        <td><?= $key['nama']; ?></td>
                                        <td><?= $key['no_hp'] ?></td>
                                        <td><?= $key['instansi'] ?></td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#modalEditPeserta<?= $key['id']; ?>" class="btn btn-success btn-sm" id="btn-edit-kategori" title="Edit"><i class="fas fa-edit "></i></button>
                                            <form action="/Admin/Peserta/arsipPeserta/<?= $key['id']; ?>" method="POST" class="d-inline">
                                                <button type="submit" class="btn btn-secondary btn-sm" id="btn-archive-kategori" title="Arsip" onclick="return confirm('Apakah anda ingin mengarsipkan peserta <?= $key['nama']; ?> ?')"><i class="fas fa-archive "></i></button>
                                            </form>
                                            <form action="/Admin/Peserta/deletePeserta/<?= $key['id']; ?>" method="POST" class="d-inline">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus peserta <?= $key['nama']; ?> ?')" title="Hapus"><i class="fas fa-trash"></i></button>
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

<!-- Modal Add Peserta -->
<?= view('modal/addPeserta'); ?>

<!-- Modal Edit Peserta -->
<?= view('modal/editPeserta'); ?>

<?= $this->endSection(); ?>