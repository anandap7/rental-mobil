<?php foreach ($schedules as $key => $schedule) { ?>
	<tr>
		<td><?= $key + 1 ?></td>
		<td><?= $schedule->vehicle_name ?></td>
		<td><?= $schedule->license_plate ?></td>
		<td><?= date_format(date_create($schedule->pickup_date),'d F Y') ?></td>
		<td><?= date_format(date_create($schedule->return_date),'d F Y') ?></td>
	</tr>
<?php } ?>
