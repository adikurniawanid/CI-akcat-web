<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="dataTable" height="100%" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <td>No</td>
                            <td>Kode Sesi</td>
                            <td>Nama Ujian</td>
                            <td>Tempat Ujian</td>
                            <td>Waktu Mulai</td>
                            <td>Waktu Selesai</td>
                            <td>Durasi</td>
                            <td>Aksi</td>
                        </tr>
                        <?php $i = 1 ?>
                        <?php
                        foreach ($sesi as $key) : ?>
                            <tr class="text-center ">
                                <td><?= $i; ?></td>
                                <td><?= $key['kode']; ?></td>
                                <td class="text-left"><?= $key['nama_ujian']; ?></td>
                                <td class="text-left"><?= $key['tempat_ujian'] ?></td>
                                <td><?= $key['waktu_mulai'] ?></td>
                                <td><?= $key['waktu_selesai'] ?></td>
                                <td><?= $key['durasi'] ?></td>
                                <td class="text-center">
                                    <a type="button" class="fas fa-pen-square fa-lg text-success" href="#"></a>
                                    <a type="button" class="fas fa-user-plus fa-lg text-primary" href="#"></a>
                                    <br>
                                    <a type="button" class="fas fa-clipboard-list fa-lg text-info" href="#"></a>
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