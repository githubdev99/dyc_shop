<?= $this->load->view('layout/header'); ?>
<body>
	<div class="account-pages my-5 pt-sm-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">
					<div class="card overflow-hidden">
						<div class="bg-soft-primary">
							<div class="row">
								<div class="col-8">
									<div class="text-primary p-4">
										<h5 class="text-primary">Log in</h5>
										<p>Log in to your account to continue.</p>
									</div>
								</div>
								<div class="col-4 align-self-end">
									<img src="<?= base_url() ?>assets/images/profile-img.png" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="card-body pt-0"> 
							<div>
								<div class="avatar-md profile-user-wid mb-4">
									<span class="avatar-title rounded-circle bg-light">
										<img src="<?= $setup_app['main_icon'] ?>" alt="" height="34">
									</span>
								</div>
							</div>
							<div class="p-2">
								<form class="form-horizontal" method="post" action="#" enctype="multipart/form-data">

									<div class="form-group">
										<label>Username</label>
										<input type="text" class="form-control" placeholder="Enter username...">
									</div>

									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" placeholder="Enter password...">
									</div>

									<!-- <div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="rememberMe">
										<label class="custom-control-label" for="rememberMe">Remember me</label>
									</div> -->

									<div class="mt-3">
										<a href="<?= base_url() ?>admin/dashboard">
											<button class="btn btn-primary btn-block waves-effect waves-light" type="button" name="login">Log In</button>
										</a>
									</div>

									<!-- <div class="mt-4 text-center">
										<a href="#" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
									</div> -->
								</form>
							</div>
						</div>
					</div>
					<div class="text-center">
						<!-- <p>Don't have an account ? <a href="<?= base_url() ?>auth/register" class="font-weight-medium text-primary"> Register Now! </a> </p> -->
						<?= $setup_app['copyright_auth'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>