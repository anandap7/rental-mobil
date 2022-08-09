<div class="msg" style="display: none;">
	<?= $this->session->flashdata('msg') ?>
</div>

<div class="card">
	<div class="card-body">
		<table id="list-data" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Nama Kendaraan</th>
					<th>Nomor Polisi</th>
					<th>Tanggal Berangkat</th>
					<th>Tanggal Kembali</th>
				</tr>
			</thead>
			<tbody id="data-schedule"></tbody>
		</table>
	</div>
</div>

<div id="modals">
</div>
