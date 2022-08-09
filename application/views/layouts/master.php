<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<?= $_meta ?>

	<title>AdminLTE 3 | Top Navigation</title>

	<?= $_css ?>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<?= $_navbar ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			
			<!-- Main content -->
			<div class="content">
				<div class="container">
					<?= $_content ?>
				</div> <!-- /.container -->
			</div> <!-- /.content -->

		</div> <!-- /.content-wrapper -->

		<!-- Main Footer -->
		<?= $_footer ?>
	</div> <!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->
	<?= $_js ?>

</body>
</html>
