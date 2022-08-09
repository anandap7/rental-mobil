<div class="modal-header">
		<div class="modal-title"><h5>Tentukan Pengemudi</h5></div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	<div class="modal-body">
		<div class="form-msg"></div>
		<form id="form-update-rent" method="post">
			<input type="hidden" name="id" value="<?= $rent->id ?>">
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user-ninja"></span>
					</div>
				</div>
				<select name="driver_id" class="form-control" required>
					<option value="" hidden>Pilih Pengemudi</option>
					<?php foreach ($drivers as $key => $driver) { ?>
						<option value="<?= $driver->id ?>" <?= !in_array($driver->id,$free_drivers) ? 'disabled' : '' ?>><?= $driver->name ?> <?= !in_array($driver->id,$free_drivers) ? '(jadwal bentrok)' : '' ?></option>
					<?php } ?>
				</select>
			</div>
			<button type="submit" class="form-control btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
		</form>
	</div>
