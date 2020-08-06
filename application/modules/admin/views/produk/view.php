<div id="deleteData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="?" method="post" enctype="multipart/form-data" name="delete_produk">
            <div class="modal-content" style="border: none;">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                        <i class="fas fa-bookmark mr-3"></i>Konfirmasi Hapus Data Produk
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <input type="hidden" name="id_produk">
                        <input type="hidden" name="nama_produk">
                        <input type="hidden" name="foto">
                        <h4>Anda yakin ingin menghapus data produk <b>"<span id="nama_produk"></span>"</b> ?</h4>
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
                    <h3 class="mb-0 text-info">Produk</h3>
                </div>

                <div class="float-right">
                    <a href="<?= base_url() ?>admin/produk/add" class="btn btn-info btn-lg waves-effect waves-light">
                        <i class="fas fa-plus mr-2"></i>Buat Data Produk Baru
                    </a>
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
                <div class="float-left">
                    <h4 class="card-title">List Data</h4>
                    <p class="card-title-desc">Data yang ditampilkan adalah data seluruh produk yang ada pada DYC Shop.</p>
                </div>

                <div class="float-right">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary waves-effect waves-light dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file-export mr-2"></i>Export Data
                        </a>
                        <div class="dropdown-menu dropdown-menu-custom">
                            <a class="dropdown-item" href="#">PDF</a>
                            <a class="dropdown-item" href="#">Excel</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

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