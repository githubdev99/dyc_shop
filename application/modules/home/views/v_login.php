<!-- Start Page Title -->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Login</h1>
        </div>
    </div>
</div>
<!-- End Page Title -->
<!-- Start Page Content -->
<div class="container padding-bottom-3x">
    <div class="row">
        <div class="col-12">
            <div class="hidden-md-up"></div>
            <h3>Sudah punya akun? Anda bisa langsung login disini</h3>
            <p class="margin-bottom-1x">Jika belum punya akun, Anda bisa daftar terlebih dahulu <a href="<?= base_url() ?>home/daftar">disini</a></p>
            <form class="row" method="post" action="<?= base_url() ?>home/login" enctype="multipart/form-data" name="login">
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="username" placeholder="Enter Your Username" required><span class="input-group-addon"><i class="fa fa-user"></i></span>
                </div>
                <div class="form-group input-group">
                    <input class="form-control" type="password" name="password" placeholder="Enter Your Password" required><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                </div>
                <div class="col-12 text-center text-sm-right">
                    <button class="btn btn-primary margin-bottom-none" type="submit" name="login" value="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Page Content -->