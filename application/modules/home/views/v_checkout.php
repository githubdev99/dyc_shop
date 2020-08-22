<!-- Start Page Preloader -->
<div id="loading" style="display:none;">
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
            <h1>Checkout</h1>
        </div>
    </div>
</div>
<!-- End Page Title -->
<!-- Start Page Content -->
<div class="container padding-bottom-3x">
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="harga_transaksi" value="<?= $setup_app['order_total'] ?>">
        <input type="hidden" name="total_transaksi" value="">
        <div class="row">
            <!-- Start Checkout Review -->
            <div class="col-lg-9">
                <h4>Produk Dipesan</h4>
                <div class="table-responsive shopping-cart" id="order">
                </div>
                <div class="shopping-cart-footer">
                </div>
                <h4>Pilih Pengiriman</h4>
                <hr class="padding-bottom-1x">
                <div class="table-responsive" id="pengiriman">
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
                            <li>
                                <span class="text-muted">Transfer Bank:</span><br>
                                <b>BNI (Bank Negara Indonesia)</b>
                                <br>
                                <img src="<?= base_url() ?>assets/home/images/bni.png" width="100">
                                <br>
                                No. Rekening : 0971733578  (Atas Nama : Desty Triwilestari)
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="checkout-footer margin-top-1x">
                    <div class="column hidden-xs-down"><a class="btn btn-outline-secondary" href="<?= base_url() ?>home/cart"><i class="icon-arrow-left"></i>&nbsp;Kembali ke keranjang</a></div>
                    <div class="column"><button class="btn btn-primary" type="submit" name="checkout" value="checkout">Buat Pesanan</button></div>
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
                                <td class="text-medium" id="harga_ongkir">Rp. 0</td>
                            </tr>
                            <tr>
                                <td>Total Seluruh:</td>
                                <td class="text-lg text-medium" id="total_transaksi">Rp. 0</td>
                            </tr>
                        </table>
                    </section>
                    <!-- End Order Summary Widget -->
                </aside>
            </div>
        </div>
    </form>
</div>
<!-- End Page Content -->