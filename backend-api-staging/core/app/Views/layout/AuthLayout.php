<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Surat Web App</title>
  <link rel="stylesheet" href="<?= base_url('assets/vendors/feather/feather.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/ti-icons/css/themify-icons.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/vertical-layout-light/style.css') ?>">
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?= base_url('assets/images/logo.svg') ?>" alt="logo">
              </div>
              <?= $this->renderSection('content') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base_url('js/Auth.js') ?>"></script>
  <script src="<?= base_url('js/Main.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
  <script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
  <script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
  <script src="<?= base_url('assets/js/template.js') ?>"></script>
  <script src="<?= base_url('assets/js/settings.js') ?>"></script>
  <script src="<?= base_url('assets/js/todolist.js') ?>"></script>
</body>

</html>
