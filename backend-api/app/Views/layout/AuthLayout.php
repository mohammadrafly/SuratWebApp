<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
	<link rel="stylesheet" href="<?= base_url('assets/vendors/core/core.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/fonts/feather-font/css/iconfont.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/demo_1/style.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />
</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">
				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                                <div class="col-md-4 pr-md-0">
                                    <div class="auth-left-wrapper">
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2">Noble<span>UI</span></a>
                                        <?= $this->renderSection('content') ?>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url('assets/vendors/core/core.js') ?>"></script>
	<script src="<?= base_url('assets/vendors/feather-icons/feather.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/template.js') ?>"></script>
</body>
</html>
            
