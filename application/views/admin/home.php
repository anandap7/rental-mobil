<div class="card">
	<div class="card-header text-center"><b>Laporan Pemasukan</b></div>
	<div class="card-body">
		<canvas id="income"></canvas>
	</div>
</div> <!-- /.card -->
<div class="card">
	<div class="card-header text-center"><b>Laporan Frekuensi Sewa</b></div>
	<div class="card-body">
		<select class="form-control" id="freq">
			<?php foreach($months as $month): ?>
			<option value="<?= date('m Y', strtotime($month)) ?>" <?= $month === end($months) ? 'selected':'' ?>><?= $month ?></option>
			<?php endforeach ?>
		</select><br>
		<canvas id="rent-freq"></canvas>
	</div>
</div> <!-- /.card -->

