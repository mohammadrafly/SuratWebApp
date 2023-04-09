<?= $this->extend('layout/AuthLayout') ?>

<?= $this->section('content') ?>  
                                        <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <?php echo session()->getFlashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <form class="forms-sample">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                                            </div>
                                            <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input">
                                                Remember me
                                                </label>
                                            </div>
                                            <div class="mt-3">
                                                <a href="../../dashboard-one.html" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Login</a>
                                                <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                                    <i class="btn-icon-prepend" data-feather="twitter"></i>
                                                    Login with twitter
                                                </button>
                                            </div>
                                            <a href="<?= base_url('sign-up') ?>" class="d-block mt-3 text-muted">Not a user? Sign up</a>
                                        </form>
<?= $this->endSection() ?>