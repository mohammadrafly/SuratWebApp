<?= $this->extend('layout/AuthLayout') ?>

<?= $this->section('content') ?>  

<h4>Kata Sandi Baru</h4>
              <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <?php echo session()->getFlashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>
              <h6 class="font-weight-light">Masukkan kata sandi baru anda.</h6>
              <form class="pt-3" id="resetPassword">
                <input type="text" id="email" name="email" hidden value="<?= $email ?>">
                <input type="text" id="token" name="token" hidden value="<?= $token ?>">
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Kata Sandi Baru">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password-confirm" name="password-confirm" placeholder="Konfirmasi Kata Sandi Baru">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIMPAN</button>
                </div>
              </form>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $('#resetPassword').submit(function(event) {
        event.preventDefault();
  
        const passwordInput = $('#password');
        const passwordConfirmInput = $('#password-confirm');
        const emailInput = $('#email');
        const tokenInput = $('#token');
  
        const password = passwordInput.val();
        const passwordConfirm = passwordConfirmInput.val();

        const email = emailInput.val();
        const token = tokenInput.val();
    
        if (!password) {
            showAlert('error', 'Input Invalid', 'Kata sandi tidak boleh kosong');
            return;
        }
  
        if (!passwordConfirm) {
            showAlert('error', 'Input Invalid', 'Konfirmasi kata sandi tidak boleh kosong.');
            return;
        }

        if (password !== passwordConfirm) {
            showAlert('error', 'Peringatan!', 'Kata sandi tidak sama.');
            return;
        }
  
        $.ajax({
            url: `${base_url}api/V1/reset-password/${email}/${token}`,
            type: 'POST',
            data: { password },
            dataType: 'JSON',
            success: function(response) {
              console.log(response.role)
                if (response.status) {
                  swal.fire({
                      icon: response.icon,
                      title: response.title,
                      text: response.text,
                      showCancelButton: false,
                      showConfirmButton: false,
                      timer: 3000
                  }).then (function() {
                    window.location.href = `${base_url}`;
                  });
                } else {
                  showAlert(response.icon, response.title, response.text);
                }
            },
            error: function(response, error) {
                console.log(error);
              showAlert(response.icon, response.title, response.text);
            }
        });
    });
</script>
<?= $this->endSection() ?>