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
						<i class="fas fa-bookmark"></i>
						<span>Kategori Produk</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url() ?>admin/produk" class="waves-effect <?= ($this->uri->segment(2) == 'produk') ? 'mm-active' : ''; ?>">
						<i class="bx bxs-archive"></i>
						<span>Produk</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url() ?>admin/customer" class="waves-effect <?= ($this->uri->segment(2) == 'customer') ? 'mm-active' : ''; ?>">
						<i class="bx bxs-user-pin"></i>
						<span>Customer</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url() ?>admin/transaksi" class="waves-effect <?= ($this->uri->segment(2) == 'transaksi') ? 'mm-active' : ''; ?>">
						<i class="bx bxs-purchase-tag"></i>
						<span>Transaksi</span>
					</a>
				</li>

			</ul>
		</div>
		<!-- Sidebar -->
	</div>
</div>