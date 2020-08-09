<header id="page-topbar" style="background: linear-gradient(to right, #00b4db, #0083b0);">
	<div class="navbar-header">
		<div class="d-flex">
			<!-- LOGO -->
			<div class="navbar-brand-box">
				<a href="<?= base_url() ?>admin/dashboard" class="logo logo-dark">
					<span class="logo-sm">
						<img src="<?= $setup_app['main_icon'] ?>" alt="" height="22">
					</span>
					<span class="logo-lg" style="font-size: 22px; color: white;">
						<img src="<?= $setup_app['main_icon'] ?>" alt="" height="26">
						<?= $setup_app['app_name'] ?>
					</span>
				</a>

				<a href="<?= base_url() ?>admin/dashboard" class="logo logo-light">
					<span class="logo-sm">
						<img src="<?= $setup_app['main_icon'] ?>" alt="" height="22">
					</span>
					<span class="logo-lg" style="font-size: 22px; color: white;">
						<img src="<?= $setup_app['main_icon'] ?>" alt="" height="26">
						<?= $setup_app['app_name'] ?>
					</span>
				</a>
			</div>

			<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
				<i class="fa fa-fw fa-bars"></i>
			</button>

			<div class="d-none d-lg-block">
				<a href="<?= base_url() ?>admin/dashboard">
					<button type="button" class="btn header-item waves-effect">
						<span style="font-size: 20px; color: white;">Administrator </span><span style="font-size: 20px; font-style: italic; color: #FFC107;">Center &nbsp;</span><small>V.1.0</small>
					</button>
				</a>
			</div>
		</div>

		<div class="d-flex">
			<div class="dropdown d-inline-block">
				<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img class="rounded-circle header-profile-user" src="<?= base_url() ?>assets/admin/images/avatar_female.png" alt="Header Avatar">
				<span class="d-none d-xl-inline-block ml-1"><?= $setup_app['data_session']->nama_admin; ?></span>
				<i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-right">
					<!-- item-->
					<a class="dropdown-item text-danger" href="<?= base_url() ?>admin/logout"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
				</div>
			</div>

		</div>
	</div>
</header>