	<div class="modal-header">
		<div class="modal-title"><h5>Tambah Data Pemilik Kendaraan</h5></div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	<div class="modal-body">
		<div class="form-msg"></div>
		<form id="form-tambah-owner" method="post">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="name" placeholder="Nama Pemilik" required>
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user-tie"></span>
					</div>
				</div>
			</div>
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="username" placeholder="Username" required>
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user"></span>
					</div>
				</div>
			</div>
			<div class="input-group mb-3">
				<input type="password" class="form-control" name="password" placeholder="Password" required>
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-key"></span>
					</div>
				</div>
			</div>
			<button type="submit" class="form-control btn btn-primary"><i class="fa fa-ok"></i> Tambah Data</button>
		</form>
	</div>
