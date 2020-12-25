<h3 class="mt-5 mb-3 pt-2 text-center">Register User Perpustakaan</h3>

<form action="<?= BASEURL ?>/register/regis" method="post">
    <div class="row">
        <div class="col-sm-6 mx-auto">
            <?php if (Flasher::check()) : ?>
                <?php $flash = Flasher::flash() ?>
                <div class="alert alert-<?= $flash['tipe'] ?> alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <?= $flash['pesan'] ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input class="form-control" type="text" name="nama" id="nama" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input class="form-control" type="password" name="password1" id="confirm_password" required>
            </div>
            <button class="btn btn-primary" type="submit" name="register">Register</button>
            <button class="btn btn-danger" type="reset">Reset</button>

            <p class="mt-3">Sudah punya akun? <a href="<?= BASEURL ?>/login">Login</a></p>
        </div>
    </div>
</form>