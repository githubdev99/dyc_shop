<?= $this->load->view('layout/header'); ?>
<?= $this->load->view('layout/navbar'); ?>
<div class="offcanvas-wrapper">
        
    <?php
    if (!empty($get_view)) {
        $this->load->view($get_view);
    }
    ?>

    <!-- Start Footer -->
    <footer class="site-footer">
        <div class="container">
            <!-- Start Footer Info -->
            <div class="row" style="justify-content: center; display: flex;">
                <!-- Start Contact Info -->
                <div class="col-lg-6">
                    <section class="widget widget-light-skin">
                        <h3 class="widget-title text-center"><?= $setup_app['app_name'] ?> Contact Info</h3>
                        <p class="text-white"><i class="fa fa-phone"></i> 082112422030</p>
                        <p class="text-white"><a href="mailto:dailymoodday@gmail.com" style="text-decoration: none; color: white !important;"><i class="fa fa-envelope-o"></i> dailymoodday@gmail.com</a></p>
                        <p class="text-white"><i class="fa fa-map-marker"></i> Lubang Buaya, Cipayung, Jakarta Timur, 13810</p>
                        <ul class="list-unstyled text-sm text-white">
                            <li><span class="opacity-50">Senin - Jumat: </span>09:00 - 20:00</li>
                        </ul>
                        <center>
                            <a class="social-button shape-circle sb-instagram sb-light-skin" href="https://www.instagram.com/aksesoris_dyc/" target="_blank">
                                <i class="socicon-instagram"></i>
                            </a>
                        </center>
                    </section>
                </div>
                <!-- End Contact Info -->
            </div>
            <!-- End Footer Info -->
            <hr class="hr-light">
            <!-- Start Copyright -->
            <p class="footer-copyright text-center">© 2020 <?= $setup_app['app_name'] ?> | All rights reserved</p>
            <!-- End Copyright -->
        </div>
    </footer>
    <!-- End Footer -->
</div>
<?= $this->load->view('layout/footer'); ?>