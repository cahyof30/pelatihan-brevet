    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                            </div>
                            <?= form_open_multipart('auth/register'); ?>

                            <!-- Nama -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!-- No. Handphone -->
                            <div class="form-group">
                                <input type="tel" class="form-control form-control-user" id="no_hp" name="no_hp" pattern="[0-9]{10,13}" placeholder="Nomor Handphone" value="<?= set_value('no_hp'); ?>" required>
                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!-- Pendidikan Terakhir -->
                            <div class="form-group">
                            <select name="pendidikan" id="pendidikan" class="form-control" required>
                            <option value="">- Pilih Pendidikan Terakhir - </option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                                <?= form_error('domisili', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!-- Domisili -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="domisili" name="domisili" placeholder="Domisili (Kota/Kabupaten)" value="<?= set_value('domisili'); ?>" required>
                                <?= form_error('domisili', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!-- Password -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <!-- Repeat Password -->
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>

                            </div>
                            <!-- Upload Bukti Pembayaran -->
                            <!-- <div class="form-group">
                                <strong>Silakan Upload Bukti Pembayaran</strong>
                                <div class="form-group">
                                    <input type="file" class="" id="buktibayar" placeholder="Upload Bukti Pembayaran" name="buktibayar" value="<?= set_value('buktibayar'); ?>" required>
                                    <?= form_error('bukti_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div> -->


                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <!-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                            <!-- </form> -->
                            <?= form_close(); ?>
                            <hr>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>