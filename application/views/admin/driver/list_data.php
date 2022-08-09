<?php foreach ($drivers as $key => $driver) { ?>
	<tr>
		<td><?= $key + 1 ?></td>
		<td><?= $driver->name ?></td>
		<td><?= $driver->vehicle_name ?> (<?= $driver->license_plate ?>)</td>
		<td><?= $driver->username ?></td>
		<td class="text-center">
			<button class="btn btn-warning btn-sm edit-driver" data-id="<?= $driver->id ?>"><i class="fa fa-edit"></i> Update</button>
			<button class="btn btn-danger btn-sm konfirmasiHapus-driver" data-id="<?= $driver->user_id ?>" data-toggle="modal" data-target="#confirmation"><i class="fa fa-trash"></i> Delete</button>
		</td>
	</tr>
<?php } ?>
