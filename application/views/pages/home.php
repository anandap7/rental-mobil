<div class="jumbotron mb-0">
	<h1 class="display-4">Hello, world!</h1>
	<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
	<a class="btn btn-primary btn-lg rounded-pill" href="<?= base_url() ?>vehicle" role="button">Booking Sekarang</a>
</div>
<hr>
<div class="row">
	<div class="col-12">
		<div class="row row-cols-sm-1 row-cols-md-3">
			<?php foreach ($vehicles as $key => $vehicle) {
				if($key == 3) break;?>
			<div class="col my-3">
				<div class="card h-100 mx-3">
					<div class="card-body">
						<div class="text-center">
							<img src="<?= base_url() ?>assets/uploads/vehicle/<?= $vehicle->photo ?>" alt="Foto Kendaraan"  class="img-fluid" style="max-height: 200px;">
						</div>
						<hr>
						<h5 class="card-title text-bold"><?= $vehicle->vehicle_name ?></h5>
						<p class="card-text">Rp<?= number_format($vehicle->price, 0, ',', '.') ?>/hari</p>
						<p class="card-text"><?= $vehicle->is_ready ? 'Tersedia' : 'Tidak tersedia sementara' ?></p>
					</div>
					<div class="card-footer text-center">
						<button class="btn btn-info rounded-pill detail-vehicle" data-id="<?= $vehicle->id ?>">Detail</button>
						<button class="btn btn-success rounded-pill booking" data-toggle="modal" data-target="#booking-form" data-id="<?= $vehicle->id ?>" <?= !$vehicle->is_ready ? 'disabled' :'' ?>>Booking</button>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="row justify-content-center">
			<a href="<?= base_url() ?>vehicle" class="col-3 btn btn-outline-primary rounded-pill">Lihat semua</a>
		</div>
	</div>
</div>
<hr>
<div class="row p-5">
	<div class="col-md-6 col-sm-12">
		<h3><b>Kontak Kami</b></h3>
		<p>
			example@email.com <br>
			085 <br>
			Jl. Surabaya
		</p>
	</div>
	<div class="d-none d-md-block col-md-6 text-center">
		<img src="http://placehold.it/400x200" alt="" class="img-fluid">
	</div>
</div>

<?= $modal_booking ?>
<div id="modals"></div>
