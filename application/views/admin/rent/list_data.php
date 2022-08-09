<?php foreach ($rents as $key => $rent) { ?>
	<tr>
		<td class="align-middle"><?= $key + 1 ?></td>
		<td class="align-middle"><?= $rent->id ?></td>
		<td class="align-middle"><?= $rent->customer_name ?></td>
		<td class="align-middle"><?= $rent->vehicle_name ?></td>
		<td class="align-middle">
			<?= $rent->pickup_date ?> s/d <?= $rent->return_date ?>
			(<?= $rent->diff ?> hari)
		</td>
		<td class="align-middle">
			<?php if($rent->driver_id == 0){?>
				Belum ditentukan<br>
				<button class="btn btn-primary btn-sm proses-rent" data-id="<?= $rent->id ?>" data-vehicle="<?= $rent->vehicle_id ?>"><i class="fa fa-user-ninja"></i> Proses</button>
			<?php } else if($rent->driver_id > 0){?>
				<?= $rent->driver?><br>
				<button class="btn btn-success btn-sm proses-rent" data-id="<?= $rent->id ?>" data-vehicle="<?= $rent->vehicle_id ?>"><i class="fa fa-user-ninja"></i> Ganti</button>
			<?php } ?>
		</td>
		<td class="text-center align-middle">
			<button class="btn btn-info btn-sm detail-rent" data-id="<?= $rent->id ?>"><i class="fa fa-search"></i> Detail</button>
			<?php if($rent->driver_id != 0) {?>
				<a href="<?= base_url()?>Admin/Rent/invoice/<?= $rent->id ?>" class="btn btn-warning btn-sm"><i class="fa fa-receipt"></i> Invoice</a>
			<?php } ?>
			<button class="btn btn-danger btn-sm konfirmasiHapus-rent" data-id="<?= $rent->id ?>" data-toggle="modal" data-target="#confirmation"><i class="fa fa-trash"></i> Delete</button>
		</td>
	</tr>
<?php } ?>
