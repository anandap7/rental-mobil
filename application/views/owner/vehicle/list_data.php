<?php foreach ($vehicles as $key => $vehicle) { ?>
	<tr>
		<td><?= $key + 1 ?></td>
		<td><?= $vehicle->vehicle_name ?></td>
		<td><?= $vehicle->license_plate ?></td>
		<td>
			<?= $vehicle->rent_count > 0 ?
			"$vehicle->rent_count kali dengan total durasi sewa selama $vehicle->diff hari" :
			"Belum pernah disewa"?>
		</td>
	</tr>
<?php } ?>
