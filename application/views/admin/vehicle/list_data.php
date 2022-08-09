<?php foreach ($vehicles as $key => $vehicle) { ?>
	<tr>
		<td><?= $key + 1 ?></td>
		<td><?= $vehicle->vehicle_name ?> (<?= $vehicle->license_plate ?>)</td>
		<td>Rp <?= number_format($vehicle->price, 0, ',', '.')  ?></td>
		<td>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input ready-vehicle" data-id="<?= $vehicle->id ?>" id="is_ready<?= $vehicle->id ?>" <?= $vehicle->is_ready ? 'checked' : '' ?>>
				<label class="custom-control-label" for="is_ready<?= $vehicle->id ?>"><?= $vehicle->is_ready ? 'Tersedia' : 'Tidak tersedia' ?></label>
			</div>
		</td>
		<td class="text-center">
			<button class="btn btn-info btn-sm detail-vehicle" data-id="<?= $vehicle->id ?>"><i class="fa fa-search"></i> Detail</button>
			<button class="btn btn-warning btn-sm edit-vehicle" data-id="<?= $vehicle->id ?>"><i class="fa fa-edit"></i> Update</button>
			<button class="btn btn-danger btn-sm konfirmasiHapus-vehicle" data-id="<?= $vehicle->id ?>" data-toggle="modal" data-target="#confirmation"><i class="fa fa-trash"></i> Delete</button>
		</td>
	</tr>
<?php } ?>
