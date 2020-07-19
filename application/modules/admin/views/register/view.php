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
										<h5 class="text-primary">Register</h5>
										<p>Register your account for access.</p>
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
										<label>Email</label>
										<input type="email" class="form-control" placeholder="Enter email...">
									</div>

									<div class="form-group">
										<label>Username</label>
										<input type="text" class="form-control" placeholder="Enter username...">
									</div>

									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" placeholder="Enter password...">
									</div>

									<div class="mt-4">
										<button class="btn btn-primary btn-block waves-effect waves-light" type="submit" name="register">Register</button>
									</div>

									<div class="mt-4 text-center">
										<p class="mb-0">By registering you agree to the DYC Shop <a href="#" class="text-primary">Terms of Use</a></p>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="text-center">
						<p>Already have an account ? <a href="<?= base_url() ?>admin/login" class="font-weight-medium text-primary"> Login Here! </a> </p>
						<?= $setup_app['copyright_auth'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>