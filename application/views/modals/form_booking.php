	<div class="modal-header">
		<div class="modal-title"><h5>Form Booking <span id="name"></span></h5></div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	<div class="modal-body">
		<div class="form-msg"></div>
		<form id="form-booking" method="post">
			<input type="hidden" name="vehicle_id" id="id" value="">
			<input type="hidden" name="license_plate" id="license" value="">
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user-tie"></span>
					</div>
				</div>
				<input type="text" class="form-control" name="customer_name" placeholder="Nama Penyewa" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-at"></span>
					</div>
				</div>
				<input type="email" class="form-control" name="email" placeholder="Email" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-phone"></span>
					</div>
				</div>
				<input type="text" class="form-control" name="phone" placeholder="Nomor Telepon" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-calendar-alt"></span>
					</div>
				</div>
				<input type="text" class="form-control" name="date" placeholder="Tanggal Sewa" id="daterange" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-map-marker-alt"></span>
					</div>
				</div>
				<select name="pickup_option" class="form-control" required>
					<option value="" hidden>Lokasi pengambilan</option>
					<option value="garage">Garasi</option>
					<option value="delivery" disabled>Antar ke tempat (coming soon)</option>
				</select>
			</div>
			<button type="submit" class="form-control btn btn-primary"><i class="fa fa-ok"></i> Tambah Data</button>
		</form>
	</div>
