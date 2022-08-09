	<div class="modal-header">
		<div class="modal-title"><h5>Tambah Data Kendaraan</h5></div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	<div class="modal-body">
		<div class="form-msg"></div>
		<form id="form-tambah-vehicle" method="post">
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-car"></span>
					</div>
				</div>
				<input type="text" class="form-control text-capitalize" name="vehicle_name" placeholder="Nama Kendaraan" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-window-maximize"></span>
					</div>
				</div>
				<input type="text" class="form-control text-uppercase license" name="license_plate" placeholder="Plat Nomor" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-money-bill"></span>
					</div>
				</div>
				<input type="text" class="form-control money" name="price" placeholder="Harga sewa per hari" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-image"></span>
					</div>
				</div>
				<div class="form-control text-center h-auto">
					<img src="" alt="Foto Kendaraan" class="img-thumbnail" id="ct-vehicle" style="max-height: 150px;"/>
					<input type="file" class="form-control imgInput mt-3 border-0" data-img="ct-vehicle" name="photo" required>
				</div>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user-tie"></span>
					</div>
				</div>
				<select name="owner_id" class="form-control" required>
					<option value="" hidden>Pilih pemilik</option>
					<?php foreach ($owners as $key => $owner) { ?>
						<option value="<?= $owner->id ?>"><?= $owner->name ?> - <?= $owner->username ?></option>
					<?php } ?>
				</select>
			</div>
			<button type="submit" class="form-control btn btn-primary"><i class="fa fa-ok"></i> Tambah Data</button>
		</form>
	</div>
