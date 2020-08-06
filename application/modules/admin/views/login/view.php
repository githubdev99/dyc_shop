<?= $this->load->view('master/template_admin/layout/header'); ?>
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
								<form class="form-horizontal" method="post" action="?" enctype="multipart/form-data">

									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" class="form-control" placeholder="Enter username..." required="" aria-required="true">
									</div>

									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" class="form-control" placeholder="Enter password..." required="" aria-required="true">
									</div>

									<div class="mt-3">
										<button class="btn btn-primary btn-block waves-effect waves-light" type="submit" name="login" value="login">Log In</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="text-center">
						<!-- <p>Don't have an account ? <a href="<?= base_url() ?>auth/register" class="font-weight-medium text-primary"> Register Now! </a> </p> -->
						<p>Copyright &copy; 2020 All Right Reserved <br><?= $setup_app['app_name'] ?>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?= $this->load->view('master/template_admin/layout/footer'); ?>