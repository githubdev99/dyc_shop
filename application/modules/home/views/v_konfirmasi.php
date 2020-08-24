<!-- Start Page Title -->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Konfirmasi Pesanan</h1>
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
            <h6 class="text-muted text-normal text-uppercase">Profil Saya</h6>
            <hr class="margin-bottom-1x">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <form class="row" action="<?= base_url() ?>home/konfirmasi/<?= encrypt_text($get_data->id_transaksi) ?>" method="post" enctype="multipart/form-data">
                <div class="col-12">
                    <div class="form-group">
                        <label>No. Invoice</label>
                        <input class="form-control" type="text" name="no_order" value="<?= $get_data->no_order ?>" readonly>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Total Transaksi</label>
                        <input class="form-control" type="text" name="total_transaksi" value="<?= rupiah($get_data->total_transaksi) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No. Rekening</label>
                        <input class="form-control" type="text" name="no_rek" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Atas Nama</label>
                        <input class="form-control" type="text" name="atas_nama" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input class="form-control" type="text" name="nama_bank" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Foto Bukti</label>
                        <input class="form-control" type="file" name="foto_bukti" required>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <hr class="mt-2 mb-3">
                    <button class="btn btn-primary" type="submit" name="konfirmasi" value="konfirmasi">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Page Content -->