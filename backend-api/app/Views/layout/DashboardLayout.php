<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
	<link rel="stylesheet" href="<?= base_url('assets/vendors/core/core.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/fonts/feather-font/css/iconfont.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/demo_1/style.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />
</head>
<body>
	<div class="main-wrapper">
		<!-- partial:partials/_sidebar.html -->
		<?= $this->include('layout/partials/sidebar'); ?>
		<!-- partial -->
		<div class="page-wrapper">		
			<!-- partial:partials/_navbar.html -->
			<?= $this->include('layout/partials/navbar'); ?>
			<!-- partial -->
            <div class="row">
                <?= $this->renderSection('content') ?>
            </div>
			<!-- partial:partials/_footer.html -->
            <?= $this->include('layout/partials/footer'); ?>
			<!-- partial -->
		</div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?= base_url('assets/vendors/core/core.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/chartjs/Chart.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.resize.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/progressbar.js/progressbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/feather-icons/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/template.js') ?>"></script>
    <script src="<?= base_url('assets/js/datepicker.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom/main.js') ?>"></script>
    <?= $this->renderSection('script') ?>
</body>
</html>    