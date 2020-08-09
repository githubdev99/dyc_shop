<!-- Start Main Slider -->
<div class="hero-slider home-1-hero">
    <div class="owl-carousel large-controls dots-inside" data-owl-carousel='{"nav": true, "dots": true, "loop": true, "autoplay": true, "autoplayTimeou": 7000}'>
        <?php foreach ($setup_app['produk_banner'] as $key_produk_banner): ?>
            <div class="item">
                <div class="container padding-top-3x">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center hidden-md-down">
                            <div class="from-bottom">
                                <div class="h2 text-body text-normal mb-2 pt-1"><?= $key_produk_banner->nama_produk ?></div>
                                <div class="h2 text-body text-normal mb-4 pb-1">Mulai dari <span class="text-bold"><?= rupiah($key_produk_banner->harga) ?></span></div>
                            </div>
                            <a class="btn btn-primary scale-up delay-1" href="<?= base_url() ?>home/produk/detail/<?= encrypt_text($key_produk_banner->id_produk) ?>">Lihat Produk</a>
                        </div>
                        <div class="col-md-6 padding-bottom-2x mb-3">
                            <img class="d-block mx-auto" src="<?= base_url() ?>assets/admin/images/upload/<?= $key_produk_banner->foto ?>" style="height: 440px; border-radius: 30px;">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<!-- End Main Slider -->
<!-- Start Top Categories -->
<section class="container padding-top-3x padding-bottom-3x">
    <h3 class="text-center mb-30">Kategori Produk DYC</h3>
    <div class="row">
        <?php foreach ($setup_app['produk_kategori'] as $key_kategori): ?>
            <div class="col-md-4 col-sm-6 horizontal-center home-cat padding-bottom-2x">
                <div class="card">
                    <?php foreach ($setup_app['produk_thumbnail'] as $key_produk_thumbnail): ?>
                        <?php if ($key_produk_thumbnail->id_kategori == $key_kategori->id_kategori): ?>
                            <div class="inner">
                                <div class="main-img">
                                    <img src="<?= base_url() ?>assets/admin/images/upload/<?= $key_produk_thumbnail->foto ?>" style="width: 100%; height: 250px;">
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><?= $key_kategori->nama_kategori ?></h4>
                                <p class="text-muted">Mulai dari <?= rupiah($key_produk_thumbnail->harga) ?></p>
                                <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($key_kategori->id_kategori) ?>">View Products</a>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>
<!-- End Top Categories -->
<!-- Start Services -->
<section class="bg-faded padding-top-3x padding-bottom-3x text-center">
    <div class="container row" style="margin: 0 auto; float: none;">
        <div class="col-md-4 col-sm-6 text-center home-cat">
            <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="<?= base_url() ?>assets/home/images/services/02.png">
            <h6>Uang Kembali</h6>
            <p class="text-muted margin-bottom-none">Dijamin uang kembali jika produk tidak diterima oleh pelanggan</p>
        </div>
        <div class="col-md-4 col-sm-6 text-center home-cat">
            <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="<?= base_url() ?>assets/home/images/services/03.png">
            <h6>24/7 Support</h6>
            <p class="text-muted margin-bottom-none">Konsultasi online selama 24 jam</p>
        </div>
        <div class="col-md-4 col-sm-6 text-center home-cat">
            <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="<?= base_url() ?>assets/home/images/services/04.png">
            <h6>Transaksi Aman</h6>
            <p class="text-muted margin-bottom-none">Pembayaran yang aman melalui bank</p>
        </div>
    </div>
</section>
<!-- End Services -->