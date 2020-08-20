<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-0">Form</h5>
                <h3 class="mb-0 text-info">Edit Data Customer Baru</h3>
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
                        Edit data sebagai berikut jika terdapat kesalahan input.<br>
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
                            <input name="nama_lengkap" type="text" class="form-control" required="" aria-required="true" value="<?= $get_data->nama_lengkap ?>">
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
                            <input name="username" type="text" class="form-control" required="" value="<?= $get_data->username ?>">
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
                                <input type="radio" name="jenis_kelamin" id="Laki-Laki" value="Laki-Laki" class="custom-control-input" required="" <?= ($get_data->jenis_kelamin == 'Laki-Laki') ? 'checked' : '' ; ?>>
                                <label class="custom-control-label" for="Laki-Laki">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" name="jenis_kelamin" id="Perempuan" value="Perempuan" class="custom-control-input" required="" <?= ($get_data->jenis_kelamin == 'Perempuan') ? 'checked' : '' ; ?>>
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
                            <input name="email" type="email" class="form-control" required="" value="<?= $get_data->email ?>">
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
                            <input name="no_telp" type="text" class="form-control" required="" aria-required="true" onkeypress="number_only(event)" value="<?= $get_data->no_telp ?>">
                            <span class="text-muted">Hanya berisi angka (0-9)</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Provinsi <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Provinsi dari customer</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <select class="form-control select2" name="province_id" required="" style="width: 100%;">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Kota <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Kota dari customer</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <select class="form-control select2" name="city_id" required="" style="width: 100%;">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-md-3 col-xs-12 text-right">
                            Kecamatan <span class="text-danger">*</span>
                            <br>
                            <span class="help-block" style="font-weight: normal;">
                                <small><i>Kecamatan dari customer</i></small>
                            </span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <select class="form-control select2" name="subdistrict_id" required="" style="width: 100%;">
                            </select>
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
                            <textarea name="alamat" class="form-control" required="" aria-required="true"><?= $get_data->alamat ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-12 text-right">
            <div class="form-group">
                <button type="submit" name="update" value="update" class="btn btn-lg btn-success waves-effect waves-light mr-3"><i class="fas fa-edit mr-2"></i>&ensp;Edit Data</button>
                <a href="<?= base_url() ?>admin/customer" class="btn btn-lg btn-danger waves-effect waves-light"><i class="fas fa-times mr-2"></i>&ensp;Batal</a>
            </div>
        </div>
    </div>
    <!-- end row -->
</form>