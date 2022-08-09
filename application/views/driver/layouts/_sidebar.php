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
					<a href="<?= base_url() ?>Driver/Home" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'Driver/Home') == TRUE ? 'active' : '' ?>">
						<i class="nav-icon fas fa-chart-line"></i> Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Driver/Schedule" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'Driver/Schedule') == TRUE ? 'active' : '' ?>">
						<i class="nav-icon fas fa-car-side"></i> Jadwal Berangkat
					</a>
				</li>
				<!-- <li class="nav-header">USER</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>owner/owner" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'owner/owner') == TRUE ? 'active' : '' ?>">
						<i class="nav-icon fas fa-user-tie"></i> Pemilik Kendaraan
					</a>
				</li> -->
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
