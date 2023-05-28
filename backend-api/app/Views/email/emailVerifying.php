<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center">Verifikasi Akun</h2>
        <p class="text-center">Halo, <?= $name ?></p>
        <p class="text-center">Verikasi akun anda dengan klik tombol dibawah ini:</p>
        <p class="text-center">
          <a href="<?= base_url('verifying/account/'.$email.'/'.$token) ?>" class="btn btn-primary">Verifikasi Akun</a>
        </p>
        <hr>
        <p class="text-center">jika tidak bisa klik tombol diatas, gunakan link berikut:</p>
        <p class="text-center"><a href="<?= base_url('verifying/account/'.$email.'/'.$token)  ?>"><?= base_url('reset-password/'.$email.'/'.$token)  ?></a></p>
      </div>
    </div>
  </div>
</body>
</html>
