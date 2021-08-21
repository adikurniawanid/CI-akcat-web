<?php
echo $this->extend('/templates/user/v_layout');
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
            <a data-toggle="modal" data-target="#modalAddKategori" class="btn btn-primary btn-icon-split mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Masukan Kode Sesi</span>
            </a>

            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Sesi Ujian</h6>
                </div>
                <div class="row p-3">
                    <?php
                    $no = 1;
                    foreach ($sesi as $key) : ?>
                        <div class="card-body col-6">
                            <div class="card border-primary text-gray-900">
                                <input type="hidden" name="id" value="<?= $key['id']; ?>">

                                <div class="card-header border-primary bg-primary text-white">

                                    <i class="fas fa-file-alt" title="Sesi Ujian"></i> <?= $key['nama_ujian']; ?>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                    <table>
                                        <tr>
                                            <td> <i class="fas fa-map-marker-alt" title="Sesi Ujian"> </i> Lokasi</td>
                                            <td> : </td>
                                            <td><?= $key['tempat_ujian']; ?></td>
                                        </tr>
                                        <tr>
                                            <td> <i class="fas fa-calendar-alt" title="Waktu Mulai"></i> Waktu Mulai</td>
                                            <td> : </td>
                                            <td><?= $key['waktu_mulai']; ?></td>
                                        </tr>
                                        <tr>
                                            <td> <i class="fas fa-calendar-alt" title="Waktu Selesai"></i> Waktu Selesai</td>
                                            <td> : </td>
                                            <td><?= $key['waktu_selesai']; ?></td>
                                        </tr>
                                        <tr>
                                            <td> <i class="fas fa-clock" title="Durasi"></i> Durasi</td>
                                            <td>:</td>
                                            <td><?= $key['durasi']; ?> Menit</td>
                                        </tr>
                                        <tr>
                                            <td> <i class="fas fa-fingerprint" title="Kode Sesi"></i></i> Kode Sesi</td>
                                            <td> : </td>
                                            <td><?= $key['kode']; ?></td>
                                        </tr>
                                    </table>
                                    <a href="Exam" class="btn btn-primary btn-icon-split mb-3 float-right">
                                        <span class="icon text-white-50">
                                            <i class="fa fa-sign-in-alt"></i>
                                        </span>
                                        <span class="text">Masuk Sesi</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php $no++;
                    endforeach ?>
                </div>
            </div>
            <!-- End of Data Table -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Add Kategori -->
<?= view('modal/joinSesi') ?>

<?= $this->endSection(); ?>