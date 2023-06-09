<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Surat Web App</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url('assets/vendors/feather/feather.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/ti-icons/css/themify-icons.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/ti-icons/css/themify-icons.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/select.dataTables.min.css') ?>">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('assets/css/vertical-layout-light/style.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />
  <style>
  .enlarge {
      position: relative;
      display: inline-block;
  }

  .enlarge img {
      transition: transform 0.3s ease-in-out;
  }

  .enlarge.fullscreen img {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      object-fit: contain;
      cursor: zoom-out;
  }
  </style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?= $this->include('layout/partials/navbar') ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?= $this->include('layout/partials/sidebar') ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
		      <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
				        <?= $this->renderSection('content') ?>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
		    <?= $this->include('layout/partials/footer') ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base_url('js/Main.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/chart.js/Chart.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>
  <script src="<?= base_url('assets/js/dataTables.select.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
  <script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
  <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="<?= base_url('js/bundle.js') ?>"></script>
  <script>
	$(document).ready( function () {
		$('#data').DataTable();
	} );
  function limitInput(element, maxLength) {
      if (element.value.length > maxLength) {
          element.value = element.value.slice(0, maxLength);
      }
  }
  </script>
  <?= $this->renderSection('script') ?>
</body>
</html>

