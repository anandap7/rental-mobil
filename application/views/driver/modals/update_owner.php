	<div class="modal-header">
		<div class="modal-title"><h5>Update Data Pengemudi</h5></div>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	<div class="modal-body">
		<div class="form-msg"></div>
		<form id="form-update-owner" method="post">
			<input type="hidden" name="id" value="<?= $owner->id ?>">
			<input type="hidden" name="user_id" value="<?= $owner->user_id ?>">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="name" placeholder="Nama Pengemudi" value="<?= $owner->name ?>" required>
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user-tie"></span>
					</div>
				</div>
			</div>
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="username" placeholder="Username" value="<?= $owner->username ?>" readonly>
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user"></span>
					</div>
				</div>
			</div>
			<div class="input-group mb-3">
				<input type="password" class="form-control" name="password" placeholder="Password" value="<?= $owner->password ?>" readonly>
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-key"></span>
					</div>
				</div>
			</div>
			<button type="submit" class="form-control btn btn-primary"><i class="fa fa-ok"></i> Update Data</button>
		</form>
	</div>
