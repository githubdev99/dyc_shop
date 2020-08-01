<?= $this->load->view('layout/header'); ?>
<body data-topbar="dark">
    <?= $this->load->view('layout/modal_popup'); ?>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->load->view('layout/navbar'); ?>

        <?= $this->load->view('layout/sidebar'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-left">
                                        <h5 class="mb-0">Data</h5>
                                        <h3 class="mb-0 text-info">Produk</h3>
                                    </div>

                                    <div class="float-right">
                                        <button type="button" class="btn btn-info btn-lg waves-effect waves-light" data-toggle="modal" data-target="#addData">
                                            <i class="fas fa-plus mr-2"></i>Buat Data Produk Baru
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">List Data</h4>
                                    <p class="card-title-desc">Data yang ditampilkan adalah data seluruh produk yang ada pada DYC Shop.</p>

                                    <table id="datatable" class="table table-bordered table-hover dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-info">
                                            <tr>
                                                <th>No.</th>
                                                <th>Foto</th>
                                                <th>Nama Produk</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?= $setup_app['copyright_app'] ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
<?= $this->load->view('layout/footer'); ?>