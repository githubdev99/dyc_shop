<!-- Start Page Title -->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Profil Saya</h1>
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
            <form class="row" action="" method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input class="form-control" type="text" name="nama_lengkap" value="<?= $setup_app['customer_session']->nama_lengkap ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group custom-box">
                        <label>Jenis Kelamin</label>
                        <br>
                        <input type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-Laki" required <?= ($setup_app['customer_session']->jenis_kelamin == 'Laki-Laki') ? 'checked' : '' ; ?>>
                        <label for="laki-laki">Laki-Laki</label>
                        <input type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required <?= ($setup_app['customer_session']->jenis_kelamin == 'Perempuan') ? 'checked' : '' ; ?>>
                        <label for="perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select class="form-control" name="province_id" required>
                            <option hidden>Pilih salah satu</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="<?= $setup_app['customer_session']->email ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kota</label>
                        <select class="form-control" name="city_id" required>
                            <option hidden>Pilih salah satu</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input class="form-control" type="text" name="no_telp" onkeypress="number_only(event)" value="<?= $setup_app['customer_session']->no_telp ?>" required>
                        <span class="text-muted">Hanya berisi angka (0-9)</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select class="form-control" name="subdistrict_id" required>
                            <option hidden>Pilih salah satu</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" required style="resize: none;"><?= $setup_app['customer_session']->alamat ?></textarea>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <hr class="mt-2 mb-3">
                    <button class="btn btn-primary" type="submit" name="update" value="update">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Page Content -->