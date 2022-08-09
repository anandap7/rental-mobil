	<div class="modal-header">
		<div class="modal-title"><h5>Update Data Pengemudi</h5></div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	<div class="modal-body">
		<div class="form-msg"></div>
		<form id="form-update-driver" method="post">
			<input type="hidden" name="id" value="<?= $driver->id ?>">
			<input type="hidden" name="user_id" value="<?= $driver->user_id ?>">
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user-tie"></span>
					</div>
				</div>
				<input type="text" class="form-control" name="name" placeholder="Nama Pengemudi" value="<?= $driver->name ?>" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-car"></span>
					</div>
				</div>
				<select name="vehicle_id" class="form-control" required>
					<option value="" hidden>Pilih Kendaraan</option>
					<?php foreach ($vehicles as $key => $vehicle) { ?>
						<option value="<?= $vehicle->id ?>" <?= $vehicle->id == $driver->vehicle_id ? 'selected' : ''?>><?= $vehicle->vehicle_name ?> (<?= $vehicle->license_plate ?>)</option>
					<?php } ?>
				</select>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user"></span>
					</div>
				</div>
				<input type="text" class="form-control" name="username" placeholder="Username" value="<?= $driver->username ?>" readonly>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-key"></span>
					</div>
				</div>
				<input type="password" class="form-control" name="password" placeholder="Password" value="<?= $driver->password ?>" readonly>
			</div>
			<button type="submit" class="form-control btn btn-primary"><i class="fa fa-ok"></i> Update Data</button>
		</form>
	</div>
