<!-- Start Page Title -->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Checkout</h1>
        </div>
    </div>
</div>
<!-- End Page Title -->
<!-- Start Page Content -->
<div class="container padding-bottom-3x">
    <div class="row">
        <!-- Start Checkout Review -->
        <div class="col-lg-9">
            <h4>Produk Dipesan</h4>
            <div class="table-responsive shopping-cart" id="order">
            </div>
            <div class="shopping-cart-footer">
            </div>
            <div class="row padding-top-1x mt-3">
                <div class="col-sm-6">
                    <h5>Alamat Pengiriman:</h5>
                    <ul class="list-unstyled">
                        <li><span class="text-muted">Alamat:</span><?= $setup_app['customer_session']->alamat ?>, <?= $setup_app['customer_session']->subdistrict ?>, <?= $setup_app['customer_session']->city_name ?>, <?= $setup_app['customer_session']->province ?></li>
                        <li><span class="text-muted">No. Telp:</span><?= $setup_app['customer_session']->no_telp ?></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <h5>Metode Pembayaran:</h5>
                    <ul class="list-unstyled">
                        <li><span class="text-muted">Credit Card:</span>**** **** **** 5216</li>
                    </ul>
                </div>
            </div>
            <div class="checkout-footer margin-top-1x">
                <div class="column hidden-xs-down"><a class="btn btn-outline-secondary" href="<?= base_url() ?>home/cart"><i class="icon-arrow-left"></i>&nbsp;Kembali ke keranjang</a></div>
                <div class="column"><a class="btn btn-primary" href="checkout-complete.html">Buat Pesanan</a></div>
            </div>
        </div>
        <!-- End Checkout Review -->
        <!-- Start Sidebar -->
        <div class="col-lg-3 order-sum">
            <aside class="sidebar">
                <div class="hidden-lg-up"></div>
                <!-- Start Order Summary Widget -->
                <section class="widget widget-order-summary">
                    <h3 class="widget-title">Detail Pesanan</h3>
                    <table class="table">
                        <tr>
                            <td>Total Pesanan:</td>
                            <td class="text-medium"><?= rupiah($setup_app['order_total']) ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Pengiriman:</td>
                            <td class="text-medium">Rp. 0</td>
                        </tr>
                        <tr>
                            <td>Total Seluruh:</td>
                            <td class="text-lg text-medium">Rp. 0</td>
                        </tr>
                    </table>
                </section>
                <!-- End Order Summary Widget -->
            </aside>
        </div>
    </div>
</div>
<!-- End Page Content -->