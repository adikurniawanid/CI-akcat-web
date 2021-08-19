<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
										<br>
									</div>

									<form method="POST" class="user" enctype="multipart/form-data" action="<?= base_url('Auth/Login/Login') ?>">
										<!-- <form class="user" action="<?= 'Auth/Login/Login' ?>"> -->
										<?= view('validation/flashData') ?>
										<div class="form-group">
											<label for="email_username_param">Email atau Username</label>
											<input type="text" class="form-control form-control-user" name="email_username_param" id="email_username_param" placeholder="Masukan email atau username...">
										</div>
										<!-- <div class="form-group">
											<label for="kodeSesi">Kode Sesi</label>
											<input type="text" class="form-control form-control-user" id="kodeSesi" placeholder="Masukan kode sesi...">
										</div> -->
										<div class="form-group">
											<label for="password_param">Kata Sandi</label>
											<input type="password" class="form-control form-control-user" id="password_param" name="password_param" placeholder="Masukan kata sandi...">
										</div>
										<!-- <div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" class="custom-control-input" id="customCheck">
												<label class="custom-control-label" for="customCheck">Ingat Saya</label>
											</div>
										</div> -->
										<br>
										<button type="submit" name="buttonLogin" class="btn btn-primary btn-user btn-block">Masuk</button>
										<a href="<?= base_url('Admin') ?>" class="btn btn-danger btn-user btn-block">
											Admin
										</a>
										<a href="<?= base_url('Exam') ?>" class="btn btn-danger btn-user btn-block">
											Exam
										</a>
										<!-- <a href="<?= base_url('Auth/Login/Login') ?>" class="btn btn-primary btn-user btn-block">
											Masuk
										</a> -->
										<!-- <hr>
										<a href="index.html" class="btn btn-google btn-user btn-block">
											<i class="fab fa-google fa-fw"></i> Login with Google
										</a>
										<a href="index.html" class="btn btn-facebook btn-user btn-block">
											<i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
										</a>
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="forgot-password.html">Forgot Password?</a>
									</div>-->
										<br>
										<div class="text-center">
											<a class="small" href="<?= base_url('Auth/Register') ?>">Belum memiliki akun? Daftar!</a>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>