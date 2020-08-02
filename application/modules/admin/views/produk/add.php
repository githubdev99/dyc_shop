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
                                    <h5 class="mb-0">Form</h5>
                                    <h3 class="mb-0 text-info">Buat Data Produk Baru</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <form action="" method="post" enctype="multipart/form-data" name="add_produk">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Form Data</h4>
                                        <p class="card-title-desc">
                                            Isi data sebagai berikut untuk menambahkan data produk baru.<br>
                                            <i>Tanda <span class="text-danger">*</span> wajib diisi</i>
                                        </p>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                                                Nama <span class="text-danger">*</span>
                                                <br>
                                                <span class="help-block" style="font-weight: normal;">
                                                    <small><i>Nama produk</i></small>
                                                </span>
                                            </label>
                                            <div class="col-sm-9 col-md-9 col-xs-12">
                                                <input name="nama_produk" type="text" class="form-control" required="" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                                                Kategori <span class="text-danger">*</span>
                                                <br>
                                                <span class="help-block" style="font-weight: normal;">
                                                    <small><i>Kategori untuk produk</i></small>
                                                </span>
                                            </label>
                                            <div class="col-sm-4 col-md-4 col-xs-12">
                                                <select class="form-control select2" name="id_kategori" required="" style="width: 100%;">
                                                </select>
                                            </div>
                                            <div class="col-sm-5 col-md-5 col-xs-12" id="subKategori" style="display:none;">
                                                <select class="form-control select2" name="id_sub_kategori" required="" style="width: 100%;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                                                Kode SKU <span class="text-danger">*</span>
                                                <br>
                                                <span class="help-block" style="font-weight: normal;">
                                                    <small><i>Kode SKU dari produk</i></small>
                                                </span>
                                            </label>
                                            <div class="col-sm-9 col-md-9 col-xs-12">
                                                <input name="kode_sku" type="text" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                                                Harga <span class="text-danger">*</span>
                                                <br>
                                                <span class="help-block" style="font-weight: normal;">
                                                    <small><i>Harga dari buku tersebut</i></small>
                                                </span>
                                            </label>
                                            <div class="col-sm-4 col-md-4 col-xs-12">
                                                <input name="harga" type="text" class="form-control" required="" aria-required="true" onkeypress="number_only(event)">
                                                <span class="text-muted">Hanya berisi angka (0-9)</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                                                Stok Tersedia <span class="text-danger">*</span>
                                                <br>
                                                <span class="help-block" style="font-weight: normal;">
                                                    <small><i>Jumlah stok dari produk tersebut</i></small>
                                                </span>
                                            </label>
                                            <div class="col-sm-4 col-md-4 col-xs-12">
                                                <input name="jumlah" type="text" class="form-control" required="" aria-required="true" onkeypress="number_only(event)">
                                                <span class="text-muted">Hanya berisi angka (0-9)</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                                                Deskripsi <span class="text-danger">*</span>
                                                <br>
                                                <span class="help-block" style="font-weight: normal;">
                                                    <small><i>Deskripsi dari produk tersebut</i></small>
                                                </span>
                                            </label>
                                            <div class="col-sm-9 col-md-9 col-xs-12">
                                                <textarea name="deskripsi" class="form-control" required="" aria-required="true"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                                                Foto
                                                <br>
                                                <span class="help-block" style="font-weight: normal;">
                                                    <small><i>Hanya file bertipe gambar</i></small>
                                                </span>
                                            </label>
                                            <div class="col-sm-9 col-md-9 col-xs-12">
                                                <div class="custom-file mb-4">
                                                    <input type="file" name="foto" id="foto" class="custom-file-input" id="customFile" accept="image/jpg, image/jpeg, image/png" style="cursor: pointer;">
                                                    <label class="custom-file-label" id="nama_foto"></label>
                                                    <span class="text-muted">Kosongkan bila tidak ada</span>
                                                </div>
                                                <a class="image-popup" href="<?= base_url() ?>assets/images/img-thumbnail.svg">
                                                    <img class="img-thumbnail" id="preview_foto" width="200" src="<?= base_url() ?>assets/images/img-thumbnail.svg" data-holder-rendered="true">
                                                </a>
                                                &ensp;
                                                <button type="button" id="remove_preview" class="btn btn-danger waves-effect waves-light mt-2"><i class="far fa-trash-alt mr-2"></i>Remove Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <div class="row">
                            <div class="col-12 text-right">
                                <div class="form-group">
                                    <button type="submit" name="insert" value="insert" class="btn btn-lg btn-info waves-effect waves-light mr-3"><i class="fas fa-save mr-2"></i>&ensp;Simpan Data</button>
                                    <a href="<?= base_url() ?>admin/produk" class="btn btn-lg btn-danger waves-effect waves-light"><i class="fas fa-times mr-2"></i>&ensp;Batal</a>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?= $setup_app['copyright_app'] ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
<?= $this->load->view('layout/footer'); ?>