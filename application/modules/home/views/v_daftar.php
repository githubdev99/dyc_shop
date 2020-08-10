<!-- Start Page Title -->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Daftar</h1>
        </div>
    </div>
</div>
<!-- End Page Title -->
<!-- Start Page Content -->
<div class="container padding-bottom-3x">
    <div class="row">
        <div class="col-12">
            <div class="hidden-md-up"></div>
            <h3>Belum punya akun? Daftar disini</h3>
            <p class="margin-bottom-1x">Isi data sesuai form yang disediakan, atau Jika sudah punya akun bisa langsung login <a href="<?= base_url() ?>home/login">disini</a></p>
            <form method="post" action="" enctype="multipart/form-data" name="daftar">
                <div class="form-group">
                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="nama_lengkap" required>
                </div>
                <div class="form-group">
                    <label>Username <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="konfirmasi_password" onkeyup="match_password(this.value);" required>
                    <span class="text-danger" id="text_not_match" style="display:none;">Password tidak sama</span>
                </div>
                <div class="form-group custom-box">
                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <br>
                    <input type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-Laki" required>
                    <label for="laki-laki">Laki-Laki</label>
                    <input type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required>
                    <label for="perempuan">Perempuan</label>
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>No. Telp <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="no_telp" onkeypress="number_only(event)" required>
                    <span class="text-muted">Hanya berisi angka (0-9)</span>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="alamat" required style="resize: none;"></textarea>
                </div>
                <div class="col-12 text-center text-sm-right">
                    <button class="btn btn-primary margin-bottom-none" type="submit" name="insert" value="insert">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Page Content -->