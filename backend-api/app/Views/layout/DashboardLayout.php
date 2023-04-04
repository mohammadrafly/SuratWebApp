<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
	<link rel="stylesheet" href="../assets/vendors/core/core.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="../assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<link rel="stylesheet" href="../assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
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
			<div class="page-content">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
                    </div>
                    <div class="d-flex align-items-center flex-wrap text-nowrap">
                        <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
                            <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
                            <input type="text" class="form-control">
                        </div>
                        <button type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
                            <i class="btn-icon-prepend" data-feather="download"></i>
                            Import
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
                            <i class="btn-icon-prepend" data-feather="printer"></i>
                            Print
                        </button>
                        <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                        </button>
                    </div>
                </div>
			</div>
            <div class="row">
                <?= $this->renderSection('content') ?>
            </div>
			<!-- partial:partials/_footer.html -->
            <?= $this->include('layout/partials/footer'); ?>
			<!-- partial -->
		</div>
	</div>
	<script src="../assets/vendors/core/core.js"></script>
    <script src="../assets/vendors/chartjs/Chart.min.js"></script>
    <script src="../assets/vendors/jquery.flot/jquery.flot.js"></script>
    <script src="../assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/feather-icons/feather.min.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/datepicker.js"></script>
</body>
</html>    