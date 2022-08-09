<div class="card">
	<div class="card-header">
		<button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-driver">
			<i class="fa fa-plus"></i> Tambah Data
		</button>
	</div>
	<div class="card-body">
		<table id="list-data" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Nama</th>
					<th>Kendaraan</th>
					<th>Username</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="data-driver"></tbody>
		</table>
	</div>
</div>

<?= $modal_tambah_driver ?>
<?= $modal_hapus_driver ?>
<div id="modals"></div>

