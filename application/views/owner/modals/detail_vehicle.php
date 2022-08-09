	<div class="modal-header">
		<div class="modal-title"><h5>Data Kendaraan</h5></div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	<div class="modal-body">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Nama Kendaraan</th>
				<td><?= $vehicle->vehicle_name ?></td>
			</tr>
			<tr>
				<th>Plat Nomor</th>
				<td><?= $vehicle->license_plate ?></td>
			</tr>
			<tr>
				<th>Harga Sewa per Hari</th>
				<td>Rp <?= number_format($vehicle->price, 0, ',', '.')  ?></td>
			</tr>
			<tr>
				<th>Foto Kendaraan</th>
				<td>
					<img src="<?= base_url() ?>assets/uploads/vehicle/<?= $vehicle->photo ?>" alt="Foto Kendaraan" class="img-thumbnail" style="max-height: 150px;max-width: 200px;">
				</td>
			</tr>
			<tr>
				<th>Nama Pemilik</th>
				<td><?= $vehicle->name ?></td>
			</tr>
		</table>
	</div>
