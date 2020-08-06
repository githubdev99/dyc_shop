<div id="addData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="?" method="post" enctype="multipart/form-data" name="add_kategori">
            <div class="modal-content" style="border: none;">
                <div class="modal-header bg-info">
                    <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                        <i class="fas fa-bookmark mr-3"></i>Tambah Data Kategori
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12">
                            Kategori <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Nama kategori produk</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input name="nama_kategori" type="text" class="form-control" required="" aria-required="true">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="insert" value="insert" class="btn btn-info waves-effect waves-light">
                        <i class="fas fa-save mr-2"></i>Simpan Data
                    </button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="editData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="?" method="post" enctype="multipart/form-data" name="edit_kategori">
            <div class="modal-content" style="border: none;">
                <div class="modal-header bg-success">
                    <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                        <i class="fas fa-bookmark mr-3"></i>Edit Data Kategori
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12">
                            Kategori <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Nama kategori produk</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input type="hidden" name="id_kategori">
                            <input name="nama_kategori" type="text" class="form-control" required="" aria-required="true">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" value="update" class="btn btn-success waves-effect waves-light">
                        <i class="fas fa-edit mr-2"></i>Edit Data
                    </button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="deleteData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="?" method="post" enctype="multipart/form-data" name="delete_kategori">
            <div class="modal-content" style="border: none;">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                        <i class="fas fa-bookmark mr-3"></i>Konfirmasi Hapus Data Kategori
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <input type="hidden" name="id_kategori">
                        <input type="hidden" name="nama_kategori">
                        <h4>Anda yakin ingin menghapus data kategori <b>"<span id="nama_kategori"></span>"</b> ?</h4>
                        <p>Data yang sudah dihapus tidak dapat dikembalikan!</p>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" value="delete" class="btn btn-danger waves-effect waves-light">
                        <i class="far fa-trash-alt mr-2"></i>Hapus Data
                    </button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-left">
                    <h5 class="mb-0">Data</h5>
                    <h3 class="mb-0 text-info">Kategori Produk</h3>
                </div>

                <div class="float-right">
                    <button type="button" class="btn btn-info btn-lg waves-effect waves-light" data-toggle="modal" data-target="#addData">
                        <i class="fas fa-plus mr-2"></i>Buat Data Kategori Baru
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
                <p class="card-title-desc">Data yang ditampilkan adalah data seluruh kategori produk.</p>

                <table id="datatable" class="table table-bordered table-hover dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="table-info">
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
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