<?= $this->load->view('layout/header'); ?>
    <div id="layout-wrapper">
        <?= $this->load->view('layout/navbar'); ?>
        <?= $this->load->view('layout/sidebar'); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                <?php
                if (!empty($get_view)) {
                    $this->load->view($get_view);
                }
                ?>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2020 All Right Reserved
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            <?= $setup_app['app_name'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
<?= $this->load->view('layout/footer'); ?>