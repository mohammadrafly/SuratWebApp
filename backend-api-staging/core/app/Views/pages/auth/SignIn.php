<?= $this->extend('layout/AuthLayout') ?>

<?= $this->section('content') ?>  
              <h4>Hello! let's get started</h4>
              <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <?php echo session()->getFlashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" id="SignIn">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="<?= base_url('reset-password-request') ?>" class="auth-link text-black">Forgot password?</a>
                </div>
              </form>
<?= $this->endSection() ?>