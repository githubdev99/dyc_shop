<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-0">Form</h5>
                <h3 class="mb-0 text-info">Buat Data Customer Baru</h3>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<form action="" method="post" enctype="multipart/form-data" name="add_customer">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Data</h4>
                    <p class="card-title-desc">
                        Isi data sebagai berikut untuk menambahkan data customer baru.<br>
                        <i>Tanda <span class="text-danger">*</span> wajib diisi</i>
                    </p>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Nama <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Nama lengkap</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input name="nama_lengkap" type="text" class="form-control" required="" aria-required="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Username <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Username untuk customer login</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input name="username" type="text" class="form-control" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Password <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Password untuk customer login</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input name="password" type="password" class="form-control" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Konfirmasi Password <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Konfirmasi password customer</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input name="konfirmasi_password" type="password" class="form-control" required="" onkeyup="match_password(this.value);">
                            <span class="text-danger" id="text_not_match" style="display:none;">Password tidak sama</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Jenis Kelamin <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Pilih salah satu</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" name="jenis_kelamin" id="Laki-Laki" value="Laki-Laki" class="custom-control-input" required="" checked="">
                                <label class="custom-control-label" for="Laki-Laki">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" name="jenis_kelamin" id="Perempuan" value="Perempuan" class="custom-control-input" required="">
                                <label class="custom-control-label" for="Perempuan">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Email <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Email valid customer</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input name="email" type="email" class="form-control" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            No. Telp <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>No. telepon valid</i></small>
                            </span>
                        </label>
                        <div class="col-sm-4 col-md-4 col-xs-12">
                            <input name="no_telp" type="text" class="form-control" required="" aria-required="true" onkeypress="number_only(event)">
                            <span class="text-muted">Hanya berisi angka (0-9)</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Alamat <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Alamat dari customer</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <textarea name="alamat" class="form-control" required="" aria-required="true"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-12 text-right">
            <div class="form-group">
                <button type="submit" name="insert" value="insert" class="btn btn-lg btn-info waves-effect waves-light mr-3" disabled><i class="fas fa-save mr-2"></i>&ensp;Simpan Data</button>
                <a href="<?= base_url() ?>admin/customer" class="btn btn-lg btn-danger waves-effect waves-light"><i class="fas fa-times mr-2"></i>&ensp;Batal</a>
            </div>
        </div>
    </div>
    <!-- end row -->
</form>