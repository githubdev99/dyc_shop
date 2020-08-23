<!-- Start Page Title -->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Pesanan Saya</h1>
        </div>
    </div>
</div>
<!-- End Page Title -->
<!-- Start Page Content -->
<div class="container padding-bottom-3x">
    <div class="row">
        <div class="col-lg-4">
            <aside class="user-info-wrapper">
                <div class="user-cover account-details">
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <?php if ($setup_app['customer_session']->jenis_kelamin == 'Laki-Laki'): ?>
                            <img src="<?= base_url() ?>assets/admin/images/avatar_male.png">
                        <?php else: ?>
                            <img src="<?= base_url() ?>assets/admin/images/avatar_female.png">
                        <?php endif ?>
                    </div>
                    <div class="user-data">
                        <h4><?= $setup_app['customer_session']->nama_lengkap ?></h4><span>Customer</span>
                    </div>
                </div>
            </aside>
            <nav class="list-group">
                <a class="list-group-item <?= ($this->uri->segment(2) == 'profil') ? 'active' : ''; ?>" href="<?= base_url() ?>home/profil"><i class="icon-head"></i>Profil Saya</a>
                <a class="list-group-item with-badge <?= ($this->uri->segment(2) == 'pesanan') ? 'active' : ''; ?>" href="<?= base_url() ?>home/pesanan"><i class="icon-bag"></i>Pesanan Saya<span class="badge badge-primary badge-pill"><?= $setup_app['count_pesanan'] ?></span></a>
            </nav>
        </div>
        <div class="col-lg-8">
            <h6 class="text-muted text-normal text-uppercase">Pesanan Saya</h6>
            <hr class="margin-bottom-1x">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active show" href="#" data-toggle="tab" role="tab" aria-selected="true">Belum Dibayar</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Menunggu Konfirmasi</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Sudah Dibayar</a></li>
            </ul>
            <div class="tab-content" id="list_pesanan">
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->