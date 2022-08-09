<div class="row">
	<div class="col-12">
		<h2 class="text-center mt-3">Daftar Mobil</h2>
		<div class="row row-cols-sm-1 row-cols-md-3">
			<?php foreach ($vehicles as $key => $vehicle) { ?>
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
	</div>
</div>

<?= $modal_booking ?>
<div id="modals"></div>
