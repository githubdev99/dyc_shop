<!-- Start Page Preloader -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
        </div>
    </div>
</div>
<!-- End Page Preloader -->

<!-- Start Page Title -->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Detail Produk</h1>
        </div>
    </div>
</div>
<!-- End Page Title -->
<!-- Start Page Content -->
<div class="container padding-top-1x padding-bottom-3x">
    <div class="row">
        <!-- Start Product Content -->
        <div class="col-lg-9 order-lg-2">
            <div class="row">
                <!-- Start Product Gallery -->
                <div class="col-md-6">
                    <img src="<?= base_url() ?>assets/admin/images/upload/<?= $get_data->foto ?>" style="height: 350px; width: 400px;">
                </div>
                <!-- End Product Gallery -->
                <!-- Start Product Info -->
                <div class="col-md-6 single-shop">
                    <div class="hidden-md-up"></div>
                    <h2 class="text-normal with-side"><?= $get_data->nama_produk ?></h2>
                    <span class="h2 d-block with-side"><?= rupiah($get_data->harga) ?></span>
                    <p><?= $get_data->deskripsi ?></p>
                    <div class="row margin-top-1x">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="1" min="1" max="<?= $get_data->stok ?>">
                            </div>
                        </div>
                    </div>
                    <div class="pt-1 mb-2"><span class="text-medium">SKU (Stock Keeping Unit):</span> <?= $get_data->kode_sku ?></div>
                    <div class="pt-1 mb-2"><span class="text-medium">Stok Tersedia:</span> <?= $get_data->stok ?></div>
                    <div class="padding-bottom-1x mb-2">
                        <span class="text-medium">Kategori Produk:&nbsp;</span>
                        <a class="navi-link" href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($get_data->id_kategori) ?>"><?= $get_data->nama_kategori ?></a>,
                        <a class="navi-link" href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($get_data->id_kategori) ?>&sub_kategori=<?= encrypt_text($get_data->id_sub_kategori) ?>"><?= $get_data->nama_sub_kategori ?></a>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="mt-30 mb-30">
                    <div class="d-flex flex-wrap justify-content-between mb-30 pull-right">
                        <div class="sp-buttons mt-2 mb-2">
                            <?php if (empty($this->session->userdata('customer'))): ?>
                                <button class="btn btn-primary" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-icon="icon-ban" data-toast-title="Gagal!" data-toast-message="Anda harus login terlebih dahulu!"><i class="icon-bag"></i> Add to Cart</button>
                            <?php else: ?>
                                <button class="btn btn-primary" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Berhasil!" data-toast-message="Produk berhasil di tambahkan ke keranjang!"><i class="icon-bag"></i> Add to Cart</button>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <!-- End Product Info -->
            </div>
        </div>
        <!-- End Product Content -->
        <!-- Start Sidebar -->
        <div class="col-lg-3 order-lg-1 hidden-md-down">
            <aside class="sidebar">
                <div class="padding-top-2x hidden-lg-up"></div>
                <!-- Start Categories Widget -->
                <section class="widget widget-categories">
                    <h3 class="widget-title">Kategori Produk</h3>
                    <ul>
                        <li><a href="<?= base_url() ?>home/produk">Semua Produk</a></li>
                        <?php foreach ($setup_app['produk_kategori'] as $key_kategori): ?>
                            <li class="has-children">
                                
                                <ul class="sub-menu">
                                    <?php foreach ($setup_app['produk_sub_kategori'] as $key_sub_kategori): ?>
                                        <?php if ($key_kategori->id_kategori == $key_sub_kategori->id_kategori): ?>
                                            <li><a href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($key_kategori->id_kategori) ?>&sub_kategori=<?= encrypt_text($key_sub_kategori->id_sub_kategori) ?>"><?= $key_sub_kategori->nama_sub_kategori ?></a></li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            </li>

                            <li class="has-children">
                                <a href="#"><?= $key_kategori->nama_kategori ?></a>
                                <ul>
                                    <li><a href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($key_kategori->id_kategori) ?>">Semua</a></li>
                                    <?php foreach ($setup_app['produk_sub_kategori'] as $key_sub_kategori): ?>
                                        <?php if ($key_kategori->id_kategori == $key_sub_kategori->id_kategori): ?>
                                            <li><a href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($key_kategori->id_kategori) ?>&sub_kategori=<?= encrypt_text($key_sub_kategori->id_sub_kategori) ?>"><?= $key_sub_kategori->nama_sub_kategori ?></a></li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </section>
                <!-- End Categories Widget -->
            </aside>
        </div>
        <!-- End Sidebar -->
    </div>
</div>
<!-- End Page Content -->