<!DOCTYPE html>
<html>
<head>
	<!-- meta -->
	<?= $_meta ?>

	<title><?= $title ?> | AdminLTE 3</title>

	<!-- css -->
	<?= $_css ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
		<!-- Navbar -->
		<?= $_navbar ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?= $_sidebar ?>
		
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><?= $title ?></h1>
						</div>
					</div>
				</div><!-- /.container -->
			</section>
			
			<section class="content">
				<div class="container">
					<?= $_content ?>
				</div>
			</section>
		</div> <!-- /.content-wrapper -->

		<?= $_footer ?>

</div>
<!-- ./wrapper -->

<?= $_js ?>
</body>
</html>
