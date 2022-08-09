<nav class="main-header navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
		<a href="<?= base_url() ?>" class="navbar-brand">
			<img src="<?= base_url() ?>assets/adminlte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
				style="opacity: .8">
			<span class="brand-text font-weight-light">Rental Mobil</span>
		</a>
		
		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse order-3" id="navbarCollapse">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item <?= $page == 'beranda' ? 'active' : '' ?>">
					<a href="<?= base_url() ?>" class="nav-link">Beranda</a>
				</li>
				<li class="nav-item <?= $page == 'mobil' ? 'active' : '' ?>">
					<a href="<?= base_url() ?>vehicle" class="nav-link">Mobil</a>
				</li>
				<li class="nav-item <?= $page == 'tentang' ? 'active' : '' ?>">
					<a href="<?= base_url() ?>about" class="nav-link">Tentang Kami</a>
				</li>
				<li class="nav-item <?= $page == 'kontak' ? 'active' : '' ?>">
					<a href="<?= base_url() ?>contact" class="nav-link">Kontak</a>
				</li>
			</ul>
		</div>

		<ul class="order-1 order-md-3 navbar-nav ml-auto">
			<li class="nav-item">
				<a href="<?= base_url() ?>auth" class="nav-link">Login</a>
			</li>
		</ul>
    </div>
</nav>
