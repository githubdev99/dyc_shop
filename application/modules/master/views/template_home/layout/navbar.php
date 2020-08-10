<!-- Start TopBar -->
<div class="topbar" style="background-color: #f2c2d8;">
    <div class="topbar-column">
        <a class="hidden-md-down"><i class="fa fa-phone"></i>&nbsp;082112422030</a>
        <a class="hidden-md-down"><i class="fa fa-envelope-o"></i>&nbsp;dailymoodday@gmail.com</a>
        <a class="hidden-md-down"><i class="fa fa-map-marker"></i>&nbsp;Lubang Buaya, Cipayung, Jakarta Timur, 13810</a>
    </div>
    <div class="topbar-column">
        <?php if (empty($this->session->userdata('customer'))): ?>
            <div class="lang-currency-switcher-wrap">
                <div class="lang-currency-switcher dropdown-toggle">
                    <span class="currency"><i class="fa fa-user"></i>&ensp;Account</span>
                </div>
                <div class="dropdown-menu">
                    <center>
                        <a href="<?= base_url() ?>home/login">
                            <button class="btn btn-sm btn-rounded btn-secondary">Login</button>
                        </a>
                        <a href="<?= base_url() ?>home/daftar">
                            <button class="btn btn-sm btn-rounded btn-secondary">Daftar</button>
                        </a>
                    </center>
                </div>
            </div>
        <?php endif ?>
        <a class="social-button sb-facebook shape-none sb-dark soc-border" href="https://www.facebook.com" target="_blank"><i class="socicon-facebook"></i></a>
        <a class="social-button sb-twitter shape-none sb-dark" href="http://www.twitter.com" target="_blank"><i class="socicon-twitter"></i></a>
        <a class="social-button sb-instagram shape-none sb-dark" href="https://www.instagram.com" target="_blank"><i class="socicon-instagram"></i></a>
    </div>
</div>
<!-- End TopBar -->
<!-- Start NavBar -->
<header class="navbar navbar-sticky">
    <!-- Start Logo -->
    <div class="site-branding">
        <div class="inner">
            <a class="site-logo" href="<?= base_url() ?>"><img src="<?= $setup_app['main_full_icon'] ?>"></a>
        </div>
    </div>
    <!-- End Logo -->
    <!-- Start Nav Menu -->
    <nav class="site-menu">
        <ul>
            <li <?= ($this->uri->segment(2) == '') ? 'class="active"' : '' ?>>
                <a href="<?= base_url() ?>home"><span>Beranda</span></a>
            </li>
            <li <?= ($this->uri->segment(2) == 'produk') ? 'class="active"' : '' ?>>
                <a href="<?= base_url() ?>home/produk"><span>Produk</span></a>
                <ul class="sub-menu">
                    <?php foreach ($setup_app['produk_kategori'] as $key_kategori): ?>
                        <li class="has-children <?= ($this->input->get('kategori') == encrypt_text($key_kategori->id_kategori)) ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($key_kategori->id_kategori) ?>"><span><?= $key_kategori->nama_kategori ?></span></a>
                            
                            <ul class="sub-menu">
                                <?php foreach ($setup_app['produk_sub_kategori'] as $key_sub_kategori): ?>
                                    <?php if ($key_kategori->id_kategori == $key_sub_kategori->id_kategori): ?>
                                        <li <?= ($this->input->get('sub_kategori') == encrypt_text($key_sub_kategori->id_sub_kategori)) ? 'class="active"' : '' ?>><a href="<?= base_url() ?>home/produk?kategori=<?= encrypt_text($key_kategori->id_kategori) ?>&sub_kategori=<?= encrypt_text($key_sub_kategori->id_sub_kategori) ?>"><?= $key_sub_kategori->nama_sub_kategori ?></a></li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    <?php endforeach ?>
                </ul>
            </li>
            <li <?= ($this->uri->segment(2) == 'bantuan') ? 'class="active"' : '' ?>>
                <a href="#"><span>Bantuan</span></a>
                <ul class="sub-menu">
                    <li <?= ($this->uri->segment(3) == 'tentang_kami') ? 'class="active"' : '' ?>><a href="<?= base_url() ?>home/bantuan/tentang_kami">Tentang Kami</a></li>
                    <li <?= ($this->uri->segment(3) == 'cara_belanja') ? 'class="active"' : '' ?>><a href="<?= base_url() ?>home/bantuan/cara_belanja">Cara Belanja & Metode Pembayaran</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- End Nav Menu -->
    <!-- Start Toolbar -->
    <div class="toolbar">
        <div class="inner">
            <div class="tools">
                <?php if (!empty($this->session->userdata('customer'))): ?>
                    <!-- Start Account -->
                    <div class="account">
                        <a href="#"></a><i class="icon-head"></i>
                        <ul class="toolbar-dropdown">
                            <li class="sub-menu-user">
                                <div class="user-ava">
                                    <?php if ($setup_app['customer_session']->jenis_kelamin == 'Laki-Laki'): ?>
                                        <img src="<?= base_url() ?>assets/admin/images/avatar_male.png">
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>assets/admin/images/avatar_female.png">
                                    <?php endif ?>
                                </div>
                                <div class="user-info">
                                    <h6 class="user-name"><?= $setup_app['customer_session']->nama_lengkap; ?></h6>
                                    <span class="text-xs text-muted">Customer</span>
                                </div>
                            </li>
                            <li class="sub-menu-separator"></li>
                            <li><a href="<?= base_url() ?>home/logout"><i class="fa fa-lock"></i> Sign Out</a></li>
                        </ul>
                    </div>
                    <!-- End Account -->
                    <!-- Start Cart -->
                    <div class="cart">
                        <a href="#"></a>
                        <i class="icon-bag"></i>
                        <span class="count">3</span>
                        <span class="subtotal">$1920</span>
                        <div class="toolbar-dropdown">
                            <div class="dropdown-product-item">
                                <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                <a class="dropdown-product-thumb" href="shop-single-1.html">
                                    <img src="<?= base_url() ?>assets/home/images/cart-dropdown/01.jpg" alt="Product">
                                </a>
                                <div class="dropdown-product-info">
                                    <a class="dropdown-product-title" href="shop-single-1.html">Samsung Galaxy A8</a>
                                    <span class="dropdown-product-details">1 x $520</span>
                                </div>
                            </div>
                            <div class="dropdown-product-item">
                                <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                <a class="dropdown-product-thumb" href="shop-single-2.html">
                                    <img src="<?= base_url() ?>assets/home/images/cart-dropdown/02.jpg" alt="Product">
                                </a>
                                <div class="dropdown-product-info">
                                    <a class="dropdown-product-title" href="shop-single-2.html">Panasonic TX-32</a>
                                    <span class="dropdown-product-details">2 x $400</span>
                                </div>
                            </div>
                            <div class="dropdown-product-item">
                                <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                <a class="dropdown-product-thumb" href="shop-single-3.html">
                                    <img src="<?= base_url() ?>assets/home/images/cart-dropdown/03.jpg" alt="Product">
                                </a>
                                <div class="dropdown-product-info">
                                    <a class="dropdown-product-title" href="shop-single-3.html">Acer Aspire 15.6 i3</a>
                                    <span class="dropdown-product-details">1 x $600</span>
                                </div>
                            </div>
                            <div class="toolbar-dropdown-group">
                                <div class="column">
                                    <span class="text-lg">Total:</span>
                                </div>
                                <div class="column text-right">
                                    <span class="text-lg text-medium">$1920 </span>
                                </div>
                            </div>
                            <div class="toolbar-dropdown-group">
                                <div class="column">
                                    <a class="btn btn-sm btn-block btn-secondary" href="cart.html">View Cart</a>
                                </div>
                                <div class="column">
                                    <a class="btn btn-sm btn-block btn-success" href="checkout-address.html">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Cart -->
                <?php endif ?>
            </div>
        </div>
    </div>
    <!-- End Toolbar -->
</header>
<!-- End NavBar -->