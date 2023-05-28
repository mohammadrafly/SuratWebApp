<?= $this->extend('layout/AuthLayout') ?>

<?= $this->section('content') ?>  
            <h4>Verifikasi Akun</h4>
                                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <?php echo session()->getFlashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>
              <h6 class="font-weight-light">Silalahkan upload foto ktp anda.</h6>
              <form class="pt-3" id="Verifikasi">
                <input type="text" hidden value="<?= $email ?>" id="email" name="email">
                <input type="text" hidden value="<?= $token ?>" id="token" name="token">
                <div class="form-group">
                  <input type="file" class="form-control form-control-lg" id="foto_ktp" name="foto_ktp">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >KIRIM</button>
                </div>
              </form>
<?= $this->endSection() ?>