<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat akun</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm mb-3 mb-sm-0">
                                        <label for="nama">Nama Lengkap</label>
                                        <input required type="text" class="form-control form-control-user" id="nama" placeholder="Masukan nama lengkap...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm mb-3 mb-sm-0">
                                        <label for="username">Username</label>
                                        <input required type="text" class="form-control form-control-user" id="username" placeholder="Masukan username...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required type="email" class="form-control form-control-user" id="email" placeholder="Masukan alamat e-mail...">
                                </div>
                                <div class="form-group">
                                    <label for="instansi">Instansi</label>
                                    <input required type="instansi" class="form-control form-control-user" id="instansi" placeholder="Masukan instansi...">
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
                                        <input required type="tel" pattern="[0-9]{11,}" class="form-control form-control-user" id="noHp" placeholder="Masukan no handphone...">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <?php
                                            foreach ($jenisKelamin as $row) : ?>
                                                <input required class="form-check-input" type="radio" name="jenis_kelamin_param" id="<?= "jenis_kelamin_" . $row['id']; ?>" value="<?= $row['id']; ?>" required>
                                                <label class="form-check-label mr-4" for="<?= "jenis_kelamin_" . $row['id']; ?>">
                                                    <?= $row['description']; ?>
                                                </label>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="password">Kata Sandi</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required type="password" class="form-control form-control-user" id="password" placeholder="Masukan kata sandi...">
                                    </div>
                                    <div class="col-sm-6">
                                        <input required type="password" class="form-control form-control-user" id="repeatPassword" placeholder="Masukan ulang kata sandi...">
                                    </div>
                                </div>
                                <a href="<?= base_url('Auth/Register/Register') ?>" class="btn btn-primary btn-user btn-block">
                                    Daftar
                                </a>
                                <!-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                            </form>
                            <hr>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="<?= base_url('Auth/Login') ?>">Telah memiliki akun? Masuk!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>