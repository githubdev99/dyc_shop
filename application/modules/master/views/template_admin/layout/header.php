<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?= $setup_app['title_page'] ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= $setup_app['main_icon'] ?>">

	<?php if (!empty($plugin)): ?>
		<!-- Plugin CSS -->
		<?php if (array_search('datatable', $plugin) !== false): ?>
			<link href="<?= base_url() ?>assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
			<link href="<?= base_url() ?>assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<?php endif ?>

		<?php if (array_search('select2', $plugin) !== false): ?>
			<link href="<?= base_url() ?>assets/admin/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
		<?php endif ?>

		<?php if (array_search('datepicker', $plugin) !== false): ?>
			<link href="<?= base_url() ?>assets/admin/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<?php endif ?>

		<?php if (array_search('sweetalert', $plugin) !== false): ?>
			<link href="<?= base_url() ?>assets/admin/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
		<?php endif ?>

		<?php if (array_search('magnific-popup', $plugin) !== false): ?>
			<link href="<?= base_url() ?>assets/admin/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
		<?php endif ?>
	<?php endif ?>

	<!-- Main CSS -->
	<link href="<?= base_url() ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

	<!-- Custom CSS -->
	<link href="<?= base_url() ?>assets/admin/custom/custom.css" rel="stylesheet" type="text/css" />
</head>
<body data-topbar="dark">