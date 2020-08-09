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
                <h5 class="mb-0">Data</h5>
                <h3 class="mb-0 text-info">Detail Data Customer</h3>
            </div>
        </div>
    </div>
</div>     
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <strong>Username</strong>
                        <p class="text-muted"><?= $get_data->username ?></p>
                        <strong>Nama Lengkap</strong>
                        <p class="text-muted"><?= $get_data->nama_lengkap ?></p>
                        <strong>Jenis Kelamin</strong>
                        <p class="text-muted"><?= $get_data->jenis_kelamin ?></p>
                    </div>
                    <div class="col-6">
                        <strong>Email</strong>
                        <p class="text-muted"><?= $get_data->email ?></p>
                        <strong>No. Telp</strong>
                        <p class="text-muted"><?= $get_data->no_telp ?></p>
                        <strong>Alamat</strong>
                        <p class="text-muted"><?= $get_data->alamat ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mb-4">
            <a href="<?= base_url().'admin/customer/edit/'.encrypt_text($get_data->id_customer) ?>" class="btn btn-lg btn-success waves-effect waves-light mr-3 mt-2"><i class="fas fa-edit mr-2"></i>&ensp;Perbaharui Data</a>
            <a href="javascript:;" class="btn btn-lg btn-danger waves-effect waves-light mr-3 mt-2" onclick="modal_delete('<?= encrypt_text($get_data->id_customer) ?>')"><i class="far fa-trash-alt mr-2"></i>&ensp;Hapus Data</a>
            <a href="<?= base_url() ?>admin/customer" class="btn btn-lg btn-info waves-effect waves-light mt-2"><i class="fas fa-arrow-alt-circle-left mr-2"></i>&ensp;Kembali</a>
        </div>
    </div>
</div>
<!-- end row -->