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
                <h5 class="mb-0">Data</h5>
                <h3 class="mb-0 text-info">Detail Data Produk</h3>
            </div>
        </div>
    </div>
</div>     
<!-- end page title -->

<div class="row">
    <div class="col-3 text-center">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($get_data->foto)): ?>
                    <a class="image-popup" href="<?= base_url() ?>assets/admin/images/upload/<?= $get_data->foto ?>"><img class="img-thumbnail" width="150" src="<?= base_url() ?>assets/admin/images/upload/<?= $get_data->foto ?>" data-holder-rendered="true"></a>
                <?php else: ?>
                    <a class="image-popup" href="<?= base_url() ?>assets/admin/images/img-thumbnail.svg"><img class="img-thumbnail" width="150" src="<?= base_url() ?>assets/admin/images/img-thumbnail.svg" data-holder-rendered="true"></a>
                <?php endif ?>
                <br><br>
                <strong>Kode SKU</strong>
                <p class="text-muted"><?= $get_data->kode_sku ?></p>
                <strong>Kategori</strong>
                <p class="text-muted"><?= $get_data->nama_kategori.' -> '.$get_data->nama_sub_kategori ?></p>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <strong>Nama Produk</strong>
                <p class="text-muted"><?= $get_data->nama_produk ?></p>
                <strong>Harga</strong>
                <p class="text-muted"><?= rupiah($get_data->harga) ?></p>
                <strong>Stok</strong>
                <p class="text-muted"><?= $get_data->stok ?></p>
                <strong>Deskripsi</strong>
                <p class="text-muted"><?= $get_data->deskripsi ?></p>
                <strong>Tanggal Input</strong>
                <p class="text-muted"><?= date_indo(explode(' ', $get_data->created_datetime)[0]) ?></p>
            </div>
        </div>

        <div class="text-right mb-4">
            <a href="<?= base_url().'admin/produk/edit/'.encrypt_text($get_data->id_produk) ?>" class="btn btn-lg btn-success waves-effect waves-light mr-3 mt-2"><i class="fas fa-edit mr-2"></i>&ensp;Perbaharui Data</a>
            <a href="javascript:;" class="btn btn-lg btn-danger waves-effect waves-light mr-3 mt-2" onclick="modal_delete('<?= encrypt_text($get_data->id_produk) ?>')"><i class="far fa-trash-alt mr-2"></i>&ensp;Hapus Data</a>
            <a href="<?= base_url() ?>admin/produk" class="btn btn-lg btn-info waves-effect waves-light mt-2"><i class="fas fa-arrow-alt-circle-left mr-2"></i>&ensp;Kembali</a>
        </div>
    </div>
</div>
<!-- end row -->