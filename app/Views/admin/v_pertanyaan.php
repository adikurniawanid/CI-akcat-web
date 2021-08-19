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
            <a data-toggle="modal" data-target="#modalAddPertanyaan" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>

            <a href="<?= base_url('Admin/Arsip/Pertanyaan'); ?>" class="btn btn-primary btn-icon-split mb-3 float-right">
                <span class="icon text-white-50">
                    <i class=" fa fa-save"></i>
                </span>
                <span class="text">Arsip Data</span>
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
                                    <th class="col-1 bg-primary text-white">Kode Soal</th>
                                    <th class="col-6">Pertanyaan</th>
                                    <th class="col-2">Kategori</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th class="bg-primary text-white">Kode Soal</th>
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
                                        <td class="bg-primary"><a href=" /Admin/Pertanyaan/<?= $key['id']; ?>" class="text-white "><?= $key['kode'] ?></a></td>
                                        <td>
                                            <span style="
  display:inline-block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 50ch;">

                                                <?= $key['pertanyaan'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span style="
  display:inline-block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 15ch;">
                                                <?= $key['kategori']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form action="/Admin/Pertanyaan/<?= $key['id']; ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="id" value="<?= $key['id']; ?>">
                                                <button type="submit" class="btn btn-success btn-sm" id="btn-edit-kategori" title="Edit"><i class="fas fa-edit "></i></button>
                                            </form>
                                            <form action="/Admin/Pertanyaan/<?= $key['id']; ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="status" value="arsip">
                                                <input type="hidden" name="_method" value="PATCH">
                                                <button type="submit" class="btn btn-secondary btn-sm" id="btn-archive-kategori" title="Arsip" onclick="return confirm('Apakah anda ingin mengarsipkan pertanyaan dengan kode : <?= $key['kode']; ?> ?')"><i class="fas fa-archive "></i></button>
                                            </form>
                                            <form action="/Admin/Pertanyaan/<?= $key['id']; ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus pertanyaan dengan kode :  <?= $key['kode']; ?> ?')" title="Hapus"><i class="fas fa-trash"></i></button>
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

<!-- Modal Add Pertanyaan -->
<?= view('modal/addPertanyaan') ?>

<?= $this->endSection(); ?>