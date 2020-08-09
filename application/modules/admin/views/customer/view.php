<div id="deleteData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="?" method="post" enctype="multipart/form-data" name="delete_customer">
            <div class="modal-content" style="border: none;">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                        <i class="fas fa-bookmark mr-3"></i>Konfirmasi Hapus Data Customer
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <input type="hidden" name="id_customer">
                        <input type="hidden" name="username">
                        <h4>Anda yakin ingin menghapus data customer <b>"<span id="username"></span>"</b> ?</h4>
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
                    <h3 class="mb-0 text-info">Customer</h3>
                </div>

                <div class="float-right">
                    <a href="<?= base_url() ?>admin/customer/add" class="btn btn-info btn-lg waves-effect waves-light">
                        <i class="fas fa-plus mr-2"></i>Buat Data Customer Baru
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
                <h4 class="card-title">List Data</h4>
                <p class="card-title-desc">Data yang ditampilkan adalah data seluruh customer yang ada pada DYC Shop.</p>

                <table id="datatable" class="table table-bordered table-hover dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="table-pink">
                        <tr>
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
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