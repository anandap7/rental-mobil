<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
		<img src="<?= base_url() ?>assets/adminlte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-header">MENU UTAMA</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/Home" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'Admin/Home') == TRUE ? 'active' : '' ?>">
						<i class="nav-icon fas fa-chart-line"></i> Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/Rent" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'Admin/Rent') == TRUE ? 'active' : '' ?>">
						<i class="nav-icon fas fa-cash-register"></i> Data Persewaan
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/Vehicle" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'Admin/Vehicle') == TRUE ? 'active' : '' ?>">
						<i class="nav-icon fas fa-car"></i> Data Mobil
					</a>
				</li>
				<li class="nav-header">USER</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/Owner" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'Admin/Owner') == TRUE ? 'active' : '' ?>">
						<i class="nav-icon fas fa-user-tie"></i> Pemilik Kendaraan
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/Driver" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'Admin/Driver') == TRUE ? 'active' : '' ?>">
						<i class="nav-icon fas fa-user-ninja"></i> Pengemudi
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
