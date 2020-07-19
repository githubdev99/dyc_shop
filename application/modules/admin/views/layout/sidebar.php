<div class="vertical-menu">

	<div data-simplebar class="h-100">

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title">Menu</li>

				<li>
					<a href="<?= base_url() ?>admin/dashboard" class="waves-effect <?= ($this->uri->segment(2) == 'dashboard') ? 'mm-active' : ''; ?>">
						<i class="mdi mdi-monitor-dashboard"></i>
						<span>Dashboard</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url() ?>admin/kategori_produk" class="waves-effect <?= ($this->uri->segment(2) == 'kategori_produk') ? 'mm-active' : ''; ?>">
						<i class="mdi mdi-monitor-dashboard"></i>
						<span>Kategori Produk</span>
					</a>
				</li>

			</ul>
		</div>
		<!-- Sidebar -->
	</div>
</div>