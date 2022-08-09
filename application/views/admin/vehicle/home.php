<div class="msg" style="display: none;">
	<?= $this->session->flashdata('msg') ?>
</div>

<div class="card">
	<div class="card-header">
		<button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-vehicle">
			<i class="fa fa-plus"></i> Tambah Data
		</button>
	</div>
	<div class="card-body">
		<table id="list-data" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Nama Kendaraan</th>
					<th>Harga Sewa / hari</th>
					<th>Ketersediaan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="data-vehicle"></tbody>
		</table>
	</div>
</div>

<?= $modal_tambah_vehicle ?>
<?= $modal_hapus_vehicle ?>
<div id="modals">
</div>
