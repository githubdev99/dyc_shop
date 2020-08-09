<!-- Start Page Title -->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Produk DYC Shop</h1>
        </div>
    </div>
</div>
<!-- End Page Title -->
<!-- Start Page Content -->
<div class="container padding-top-1x padding-bottom-3x">
    <div class="row">
        <!-- Start Categories Content -->
        <div class="col-lg-9 order-lg-2">
            <!-- Start Toolbar -->
            <div class="shop-toolbar mb-30">
                <div class="column">
                    <div class="shop-sorting">
                        <span class="text-muted">Show: </span><span> <?= $get_data['produk']->num_rows() ?> items</span>
                    </div>
                </div>
            </div>
            <!-- End Toolbar -->
            <!-- Start Products Grid -->
            <div class="isotope-grid cols-3">
                <div class="gutter-sizer"></div>
                <div class="grid-sizer"></div>
                <div id="show_produk">
                    <?php if ($get_data['produk']->num_rows() == 0): ?>
                        <h5>Produk tidak ditemukan...</h5>
                    <?php else: ?>
                        <?php foreach ($get_data['produk']->result() as $key): ?>
                            <div class="grid-item">
                                <div class="product-card">
                                    <a class="product-thumb" href="#">
                                    <img src="<?= base_url() ?>assets/admin/images/upload/<?= $key->foto ?>" style="height: 150px;">
                                    </a>
                                    <h3 class="product-title"><a href="<?= base_url() ?>home/produk/detail/<?= encrypt_text($key->id_produk) ?>"><?= shorten_name($key->nama_produk) ?></a></h3>
                                    <h4 class="product-price">
                                        <?= rupiah($key->harga) ?>
                                    </h4>
                                    <div class="product-buttons">
                                        <a href="<?= base_url() ?>home/produk/detail/<?= encrypt_text($key->id_produk) ?>" class="btn btn-outline-secondary btn-sm" style="margin-bottom: 10px;">
                                            Lihat Detail
                                        </a>
                                        <?php if (empty($this->session->userdata('customer'))): ?>
                                            <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-title="Login Required" data-toast-message="Anda harus login terlebih dahulu!">Add to Cart</button>
                                        <?php else: ?>
                                            <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-title="Login Required" data-toast-message="Anda harus login terlebih dahulu!">Add to Cart</button>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
            <!-- End Products Grid -->
        </div>
        <!-- End Categories Content -->
        <!-- Start Sidebar -->
        <div class="col-lg-3 order-lg-1 hidden-md-down">
            <aside class="sidebar">
                <div class="padding-top-2x hidden-lg-up"></div>
                <!-- Start Categories Widget -->
                <section class="widget widget-categories">
                    <h3 class="widget-title">Kategori Produk</h3>
                    <ul>
                        <li <?= (empty($this->input->get('kategori')) && empty($this->input->get('sub_kategori'))) ? 'class="active"' : '' ?>><a href="<?= base_url() ?>home/produk">Semua Produk</a></li>
                        <?php foreach ($setup_app['produk_kategori'] as $key_kategori): ?>
                            <li class="has-children <?= ($this->input->get('kategori') == encrypt_text($key_kategori->id_kategori)) ? 'active expanded' : '' ?>">
                                <a href="#"><?= $key_kategori->nama_kategori ?></a>
                                <ul>
                                    <li <?= ($this->input->get('kategori') == encrypt_text($key_kategori->id_kategori) && empty($this->input->get('sub_kategori'))) ? 'class="active"' : '' ?>><a href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($key_kategori->id_kategori) ?>">Semua</a></li>
                                    <?php foreach ($setup_app['produk_sub_kategori'] as $key_sub_kategori): ?>
                                        <?php if ($key_kategori->id_kategori == $key_sub_kategori->id_kategori): ?>
                                            <li <?= ($this->input->get('sub_kategori') == encrypt_text($key_sub_kategori->id_sub_kategori)) ? 'class="active"' : '' ?>><a href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($key_kategori->id_kategori) ?>&sub_kategori=<?= encrypt_text($key_sub_kategori->id_sub_kategori) ?>"><?= $key_sub_kategori->nama_sub_kategori ?></a></li>
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