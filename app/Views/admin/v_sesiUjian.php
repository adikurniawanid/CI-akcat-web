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
            <a data-toggle="modal" data-target="#modalAddSesi" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>

            <a href="<?= base_url('Admin/Arsip/SesiUjian'); ?>" class="btn btn-primary btn-icon-split mb-3 float-right">
                <span class="icon text-white-50">
                    <i class=" fa fa-save"></i>
                </span>
                <span class="text">Arsip Data</span>
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
                                        <td><?= $key['durasi'] ?><br>Menit</td>
                                        <td>
                                            <form action="/Admin/SesiUjian/<?= $key['id']; ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="PATCH">
                                                <input type="hidden" name="status" value="arsip">
                                                <button type="submit" class="btn btn-success btn-sm" title="Arsip" onclick="return confirm('Apakah anda ingin mengarsipkan sesi <?= $key['nama_ujian']; ?> ?')"><i class="fas fa-archive "></i></button>
                                            </form>
                                            <form action="/Admin/SesiUjian/<?= $key['id']; ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="id" value="<?= $key['id']; ?>">
                                                <button type="submit" class="btn btn-warning btn-sm" id="btn-edit-kategori" title="Edit"><i class="fas fa-edit "></i></button>
                                            </form>
                                            <div class="dropdown no-arrow d-inline-block">
                                                <button id="moreDropdown" type="submit" class="btn btn-secondary btn-sm" title="More" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-caret-square-down"></i></button>
                                                <!-- Dropdown - User Information -->
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="moreDropdown">
                                                    <form class="dropdown-item" action="/Admin/SesiUjian/<?= $key['id']; ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <input type="hidden" name="status" value="arsip">
                                                        <button type="submit" style="border: none; background-color: transparent;" onclick="return confirm('Apakah anda ingin mengarsipkan sesi <?= $key['nama_ujian']; ?> ?')" title="Hapus"><i class="fas fa-archive fa-sm fa-fw mr-2 text-gray-400"></i>Arsip</button>
                                                    </form>
                                                    <form class="dropdown-item" action="/Admin/SesiUjian/<?= $key['id']; ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" style="border: none; background-color: transparent;" onclick="return confirm('Apakah anda yakin menghapus sesi <?= $key['nama_ujian']; ?> ?')" title="Hapus"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
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
<?= view('modal/addSesiUjian') ?>
<?= $this->endSection(); ?>