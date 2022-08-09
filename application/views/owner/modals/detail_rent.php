	<div class="modal-header">
		<div class="modal-title"><h5>Detail Sewa</h5></div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	<div class="modal-body">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Nama Penyewa</th>
				<td><?= $rent->customer_name ?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?= $rent->email ?></td>
			</tr>
			<tr>
				<th>Nomor Telepon</th>
				<td><?= $rent->phone ?></td>
			</tr>
			<tr>
				<th>Nama Kendaraan</th>
				<td><?= $rent->vehicle_name ?> (<?= $rent->license_plate ?>)</td>
			</tr>
			<tr>
				<th>Durasi sewa</th>
				<td>
					<?= $rent->pickup_date ?> s/d <?= $rent->return_date ?>
					(<?= $rent->diff->format("%a hari") ?>)
				</td>
			</tr>
			<tr>
				<th>Opsi Pengambilan</th>
				<td><?= $rent->pickup_option == 'garage' ? 'Diambil ke garasi' : 'Diantar ke tempat' ?></td>
			</tr>
			<tr>
				<th>Tanggal Pembayaran</th>
				<td class="<?= $rent->paid_on == NULL ? 'text-danger' : 'text-success' ?>">
					<?= $rent->paid_on == NULL ? 'Belum bayar' : $rent->paid_on ?>
				</td>
			</tr>
		</table>
	</div>
