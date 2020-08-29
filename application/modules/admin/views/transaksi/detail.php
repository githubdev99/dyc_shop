<div id="confirmData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="?" method="post" enctype="multipart/form-data" name="konfirmasi">
            <div class="modal-content" style="border: none;">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                        <i class="fas fa-receipt mr-3"></i>Konfirmasi Pembayaran
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_transaksi">
                    <table border="0" style="width: 100%;">
                        <tr>
                            <td>Nama Bank</td>
                            <td>:</td>
                            <td><span id="nama_bank"></span></td>
                        </tr>
                        <tr>
                            <td>No. Rekening</td>
                            <td>:</td>
                            <td><span id="no_rek"></span></td>
                        </tr>
                        <tr>
                            <td>Atas Nama</td>
                            <td>:</td>
                            <td><span id="atas_nama"></span></td>
                        </tr>
                        <tr>
                            <td>Foto Bukti</td>
                            <td>:</td>
                            <td><img class="img-thumbnail" width="150" src="" id="foto_bukti" data-holder-rendered="true"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="confirm" value="confirm" class="btn btn-warning waves-effect waves-light">
                        <i class="fas fa-receipt mr-2"></i>Konfirmasi Pembayaran
                    </button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="viewConfirmData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="?" method="post" enctype="multipart/form-data" name="lihat_konfirmasi">
            <div class="modal-content" style="border: none;">
                <div class="modal-header bg-success">
                    <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                        <i class="fas fa-receipt mr-3"></i>Lihat Konfirmasi Pembayaran
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table border="0" style="width: 100%;">
                        <tr>
                            <td>Nama Bank</td>
                            <td>:</td>
                            <td><span id="nama_bank"></span></td>
                        </tr>
                        <tr>
                            <td>No. Rekening</td>
                            <td>:</td>
                            <td><span id="no_rek"></span></td>
                        </tr>
                        <tr>
                            <td>Atas Nama</td>
                            <td>:</td>
                            <td><span id="atas_nama"></span></td>
                        </tr>
                        <tr>
                            <td>Foto Bukti</td>
                            <td>:</td>
                            <td><img class="img-thumbnail" width="150" src="" id="foto_bukti" data-holder-rendered="true"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
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
                <h3 class="mb-0 text-info">Detail Data Transaksi</h3>
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
                        <strong>No. Invoice</strong>
                        <p class="text-muted"><?= $get_data->no_order ?></p>
                        <strong>Jenis Ongkir</strong>
                        <p class="text-muted">
                            <?= $get_data->ongkir ?><br>
                            <?= $get_data->jenis_ongkir ?><br>
                            Estimasi : <?= $get_data->etd_ongkir ?><br>
                            Harga : <?= rupiah($get_data->harga_ongkir) ?>
                        </p>
                        <strong>Total Transaksi</strong>
                        <p class="text-muted"><?= rupiah($get_data->total_transaksi) ?></p>
                    </div>
                    <div class="col-6">
                        <strong>Nama Customer</strong>
                        <p class="text-muted"><?= $get_data->nama_lengkap ?></p>
                        <strong>Tgl Transaksi</strong>
                        <p class="text-muted"><?= date_indo(explode(' ', $get_data->created_datetime)[0]) ?></p>
                        <strong>Status Transaksi</strong>
                        <p class="text-muted">
                            <?php if ($get_data->status == 'Belum Dibayar'): ?>
                                <span class="badge badge-secondary"><?= $get_data->status ?></span>
                            <?php elseif ($get_data->status == 'Menunggu Konfirmasi'): ?>
                                <span class="badge badge-warning"><?= $get_data->status ?></span>
                            <?php else: ?>
                                <span class="badge badge-success"><?= $get_data->status ?></span>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mb-4">
            <?php if ($get_data->status == 'Belum Dibayar'): ?>
                
            <?php elseif ($get_data->status == 'Menunggu Konfirmasi'): ?>
                <a href="javascript:;" class="btn btn-lg btn-warning waves-effect waves-light mr-3 mt-2" onclick="modal_confirm('<?= encrypt_text($get_data->id_transaksi) ?>')"><i class="fas fa-receipt mr-2"></i>&ensp;Konfirmasi Pembayaran</a>
            <?php else: ?>
                <a href="javascript:;" class="btn btn-lg btn-success waves-effect waves-light mr-3 mt-2" onclick="modal_view_confirm('<?= encrypt_text($get_data->id_transaksi) ?>')"><i class="fas fa-receipt mr-2"></i>&ensp;Lihat Konfirmasi</a>
            <?php endif ?>
            <a href="<?= base_url() ?>admin/transaksi" class="btn btn-lg btn-info waves-effect waves-light mt-2"><i class="fas fa-arrow-alt-circle-left mr-2"></i>&ensp;Kembali</a>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Data</h4>
                <p class="card-title-desc">Data yang ditampilkan adalah data seluruh transaksi customer : <?= $get_data->nama_lengkap ?>.</p>

                <table id="datatable" class="table table-bordered table-hover dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="table-pink">
                        <tr>
                            <th>No.</th>
                            <th>Foto Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div>