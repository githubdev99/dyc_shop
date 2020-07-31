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
                                    <h5 class="mb-0">Data</h5>
                                    <h3 class="mb-0 text-info">Detail Data Kategori </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <strong>Kategori Produk</strong>
                                    <p class="text-muted"><?= $get_data->nama_kategori ?></p>
                                </div>
                            </div>

                            <div class="text-right mb-4">
                                <a href="javascript:;" class="btn btn-lg btn-success waves-effect waves-light mr-3 mt-2" onclick="modal_edit_kategori('<?= encrypt_text($get_data->id_kategori) ?>')"><i class="fas fa-edit mr-2"></i>&ensp;Perbaharui Data</a>
                                <a href="javascript:;" class="btn btn-lg btn-danger waves-effect waves-light mr-3 mt-2" onclick="modal_delete_kategori('<?= encrypt_text($get_data->id_kategori) ?>')"><i class="far fa-trash-alt mr-2"></i>&ensp;Hapus Data</a>
                                <a href="<?= base_url() ?>admin/kategori_produk" class="btn btn-lg btn-info waves-effect waves-light mt-2"><i class="fas fa-arrow-alt-circle-left mr-2"></i>&ensp;Kembali</a>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row" id="data_peminjaman">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="float-left">
                                        <h4 class="card-title">List Sub Kategori</h4>
                                        <p class="card-title-desc">Data yang ditampilkan adalah data seluruh sub kategori produk : <?= $get_data->nama_kategori ?>.</p>
                                    </div>

                                    <div class="float-right">
                                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-toggle="modal" data-target="#addData">
                                            <i class="fas fa-plus mr-2"></i>Tambah Sub Kategori Baru
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>

                                    <table id="datatable" class="table table-bordered table-hover dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-info">
                                            <tr>
                                                <th>No.</th>
                                                <th>Sub Kategori</th>
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