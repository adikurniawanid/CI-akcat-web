<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <?php

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
            <a data-toggle="modal" data-target="#addPeserta" class="btn btn-primary btn-icon-split mb-3">
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
                                            <button type="button" data-toggle="modal" data-target="#modalEditKategori<?= $key['id']; ?>" class="btn btn-success btn-sm" id="btn-edit-kategori" title="Edit"><i class="fas fa-edit "></i></button>
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
<div class="modal fade" id="addPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah <?= $judul ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/Peserta/addPeserta') ?>">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input maxlength="50" autocomplete="off" class="form-control" required type="text" name="nama_param" placeholder="Masukkan nama lengkap..." />
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input pattern="[a-z0-9._%+-].{8,}" maxlength="20" autocomplete="off" class="form-control" required type="text" name="username_param" placeholder="Masukkan username (minimal 8 karakter)..." />
                    </div>
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" autocomplete="off" class="form-control" required type="email" name="email_param" placeholder="Masukkan email..." />
                    </div>
                    <div class="form-group">
                        <label>Instansi</label>
                        <input maxlength="50" autocomplete="off" class="form-control" required type="text" name="instansi_param" placeholder="Masukkan asal instansi..." />
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="noHp">No Handphone</label>
                        </div>
                        <div class="col-6">
                            <label for="jenisKelamin">Jenis Kelamin</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input required type="tel" pattern="[0-9]{11,}" maxlength="15" class="form-control form-control-user" id="noHp" placeholder="Masukan no handphone..." name="no_hp_param">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check form-check-inline">
                                <?php
                                foreach ($jenisKelamin as $row) : ?>
                                    <input required class="form-check-input" type="radio" name="jenis_kelamin_id_param" id="<?= "jenis_kelamin_" . $row['id']; ?>" value="<?= $row['id']; ?>" required>
                                    <label class="form-check-label mr-4" for="<?= "jenis_kelamin_" . $row['id']; ?>">
                                        <?= $row['description']; ?>
                                    </label>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <input pattern="[a-z0-9._%+-].{8,}" autocomplete="off" class="form-control" required type="password" name="password_param" placeholder="Masukkan kata sandi (minimal 8 karakter)..." />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="buttonAddPeserta" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Add Kategori -->

<!-- Modal Edit Kategori -->

<!-- End of Modal Edit Kategori -->