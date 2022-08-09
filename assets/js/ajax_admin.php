<script type="text/javascript">
	function inputmask_refresh() {
		$('.license').inputmask('a[a] 9[9][9][9] a[a][a]')
		
		$(".money").inputmask("numeric", {
			radixPoint: ",",
			groupSeparator:".",
			autoGroup:true,
			prefix:'Rp ',
			rightAlign:false
		})
	}

	function datepicker_refresh() {
		$('.datepicker').datepicker({
			autoclose: true,
			format:'dd MM yyyy',
			todayBtn:true,
			todayHighlight:true,
			language:'id'
		})
	}

	var MyTable = $('#list-data').dataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false
	})

	window.onload = function() {
		inputmask_refresh()
		tampilRent()
		tampilVehicle()
		tampilOwner()
		tampilDriver()
	}

	$(document).on("change", ".imgInput", function() {
		var target = '#' + $(this).attr("data-img")
		loadPreview(this, target)
	})

	function loadPreview(input, target) {
		if (input.files && input.files[0]) {
			var reader = new FileReader()
			
			reader.onload = function (e) {
				$(target).attr('src', e.target.result)
			}
			
			reader.readAsDataURL(input.files[0])
		}
	}

	function show_toast(type, msg) {
		const Toast = Swal.mixin({
			toast: true,
			position: 'bottom-left',
			showConfirmButton: false,
			timer: 3000,
  			timerProgressBar: true,
		})

		Toast.fire({
			icon: type,
			title: msg
		})
	}

	function effect_form_msg() {
		$('.msg').show(1000)
		setTimeout(function() { $('.form-msg').fadeOut(1000) }, 3000)
	}

	function refresh() {
		MyTable = $('#list-data').dataTable()
	}

	
	<?php if(strpos($_SERVER['REQUEST_URI'], 'Admin/Home') == TRUE) {?>
	var incomeData = {
		labels:[
			<?php foreach($income as $year => $value){
				foreach($value as $month => $value){
					echo "'$month $year',";
				}
			}?>
		],
		datasets: [{
			backgroundColor:'lightgreen',
			borderColor:'blue',
			data: [
				<?php foreach($income as $key => $year){
					foreach($year as $key => $month){
						echo "'$month',";
					}
				}?>
			]
		}]
	}

	var incomeChart = new Chart($('#income'), {
		type: 'bar',
		data: incomeData,
		options: {
			responsive: true,
			legend:{
				display:false
			},
			tooltips:{
				displayColors:false,
				callbacks:{
					label:function(tooltipItem, data){
						return 'Rp '+tooltipItem.yLabel.toLocaleString().replace(',','.').replace(',','.');
					}
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						min:0,
						// Include a dollar sign in the ticks
						callback: function(value, index, values) {
							return 'Rp' + value.toLocaleString().replace(',','.').replace(',','.');
						}
					}
				}]
			}
		}
	});

	var rentData = {
		labels:[
			<?php foreach ($freq as $vehicle) {
				echo "'$vehicle->vehicle_name',";
			}?>
		],
		datasets: [{
			backgroundColor:[
				<?php foreach ($freq as $vehicle) {
					echo "'rgb(".rand(0,255).",".rand(0,255).",".rand(0,255).")',";
				}?>
			],
			borderColor:'blue',
			data: [
				<?php foreach ($freq as $vehicle) {
					echo "'$vehicle->freq',";
				}?>
			]
		}]
	}

	var rentChart = new Chart($('#rent-freq'), {
		type: 'bar',
		data: rentData,
		options: {
			responsive: true,
			legend:{
				display:false
			}, scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						stepSize: 1
					}
				}]
			}
		}
	});

	$('#freq').change(function(){
		var data = $(this).val().split(' ');

		$.ajax({
			method: "POST",
			url: "<?= base_url('Admin/Home/ajax_freq') ?>",
			data: 'month=' + data[0] + '&year=' + data[1]
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			
			rentChart.data.labels = out.vehicle_names
			rentChart.data.datasets[0].data = out.freqs
			rentChart.update()
		})
	})
	<?php } ?>
	
	// Rent
	// read all
	function tampilRent() {
		$.get('<?= base_url('Admin/Rent/list') ?>', function(data) {
			MyTable.fnDestroy()
			$('#data-rent').html(data)
			refresh()
		})
	}

	<?php if(strpos($_SERVER['REQUEST_URI'], 'Admin/Rent') == TRUE) {?>
	// read one
	$(document).on('click', '.detail-rent', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Admin/Rent/detail') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#detail-rent').modal('show')
		})
	})

	// invoice
	$(document).on('click', '.invoice-rent', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Admin/Rent/invoice') ?>",
			data: 'id=' + id
		})
	})

	// update
	$(document).on('click', '.proses-rent', function(){
		var id = $(this).attr('data-id')
		var vehicle = $(this).attr('data-vehicle')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Admin/Rent/edit') ?>",
			data: `id=${id}&vehicle=${vehicle}`
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#update-rent').modal('show')
			datepicker_refresh()
		})
	})
	$(document).on('submit','#form-update-rent', function(e){
		var data = $(this).serialize()

		$.ajax({
			method: 'POST',
			url: '<?= base_url('Admin/Rent/update') ?>',
			data: data,
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			tampilRent()
			if (out.status == 'form') {
				$('.form-msg').html(out.msg)
				effect_form_msg()
			} else {
				document.getElementById("form-update-rent").reset()
				$('#update-rent').modal('hide')
				show_toast(out.type, out.msg)
			}
		})
		
		e.preventDefault()
	})

	// delete
	var id_rent
	$(document).on('click', '.konfirmasiHapus-rent', function() {
		id_rent = $(this).attr('data-id')
	})
	$(document).on('click', '.hapus-rent', function() {
		var id = id_rent
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Admin/Rent/delete') ?>",
			data: "id=" +id
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			$('#confirmation').modal('hide')
			tampilRent()
			show_toast(out.type, out.msg)
		})
	})
	<?php } ?>
	
	// Vehicle
	// read all
	function tampilVehicle() {
		$.get('<?= base_url('Admin/Vehicle/list') ?>', function(data) {
			MyTable.fnDestroy()
			$('#data-vehicle').html(data)
			refresh()
		})
	}

	<?php if(strpos($_SERVER['REQUEST_URI'], 'Admin/Vehicle') == TRUE) {?>
	// read one
	$(document).on('click', '.detail-vehicle', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Admin/Vehicle/detail') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#detail-vehicle').modal('show')
		})
	})

	// create
	$('#form-tambah-vehicle').submit(function(e){
		var data = new FormData(this)

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Admin/Vehicle/store') ?>',
			data: data,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			tampilVehicle()
			if (out.status == 'form') {
				$('.form-msg').html(out.msg)
				effect_form_msg()
			} else {
				document.getElementById("form-tambah-vehicle").reset()
				$('#tambah-vehicle').modal('hide')
				show_toast(out.type, out.msg)
			}
		})
		
		e.preventDefault()
	})

	// update
	$(document).on('click', '.edit-vehicle', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Admin/Vehicle/edit') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#update-vehicle').modal('show')
			inputmask_refresh()
		})
	})
	$(document).on('submit','#form-update-vehicle', function(e){
		var data = new FormData(this)

		$.ajax({
			method: 'POST',
			url: '<?= base_url('Admin/Vehicle/update') ?>',
			data: data,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			tampilVehicle()
			if (out.status == 'form') {
				$('.form-msg').html(out.msg)
				effect_form_msg()
			} else {
				document.getElementById("form-update-vehicle").reset()
				$('#update-vehicle').modal('hide')
				show_toast(out.type, out.msg)
			}
		})
		
		e.preventDefault()
	})

	// update is_ready
	$(document).on('change', '.ready-vehicle', function(e){
		var id = $(this).attr('data-id')

		$.ajax({
			method: 'POST',
			url: '<?= base_url('Admin/Vehicle/update_ready') ?>',
			data: 'id=' + id,
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			tampilVehicle()
			show_toast(out.type, out.msg)
		})
		
		e.preventDefault()
	})

	// delete
	var id_vehicle
	$(document).on('click', '.konfirmasiHapus-vehicle', function() {
		id_vehicle = $(this).attr('data-id')
	})
	$(document).on('click', '.hapus-vehicle', function() {
		var id = id_vehicle
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Admin/Vehicle/delete') ?>",
			data: "id=" +id
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			$('#confirmation').modal('hide')
			tampilVehicle()
			show_toast(out.type, out.msg)
		})
	})
	<?php } ?>
	
	// Owner
	// read all
	function tampilOwner() {
		$.get('<?= base_url('Admin/Owner/list') ?>', function(data) {
			MyTable.fnDestroy()
			$('#data-owner').html(data)
			refresh()
		})
	}

	<?php if(strpos($_SERVER['REQUEST_URI'], 'Admin/Owner') == TRUE) {?>
	// create
	$('#form-tambah-owner').submit(function(e){
		var data = $(this).serialize()

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Admin/Owner/store') ?>',
			data: data,
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			tampilOwner()
			if (out.status == 'form') {
				$('.form-msg').html(out.msg)
				effect_form_msg()
			} else {
				document.getElementById("form-tambah-owner").reset()
				$('#tambah-owner').modal('hide')
				show_toast(out.type, out.msg)
			}
		})
		
		e.preventDefault()
	})

	// update
	$(document).on('click', '.edit-owner', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Admin/Owner/edit') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#update-owner').modal('show')
		})
	})
	$(document).on('submit','#form-update-owner', function(e){
		var data = $(this).serialize()

		$.ajax({
			method: 'POST',
			url: '<?= base_url('Admin/Owner/update') ?>',
			data: data,
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			tampilOwner()
			if (out.status == 'form') {
				$('.form-msg').html(out.msg)
				effect_form_msg()
			} else {
				document.getElementById("form-update-owner").reset()
				$('#update-owner').modal('hide')
				show_toast(out.type, out.msg)
			}
		})
		
		e.preventDefault()
	})

	// delete
	var id_owner
	$(document).on('click', '.konfirmasiHapus-owner', function() {
		id_owner = $(this).attr('data-id')
	})
	$(document).on('click', '.hapus-owner', function() {
		var id = id_owner
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Admin/Owner/delete') ?>",
			data: "id=" +id
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			$('#confirmation').modal('hide')
			tampilOwner()
			show_toast(out.type, out.msg)
		})
	})
	<?php } ?>

	// Driver
	// read all
	function tampilDriver() {
		$.get('<?= base_url('Admin/Driver/list') ?>', function(data) {
			MyTable.fnDestroy()
			$('#data-driver').html(data)
			refresh()
		})
	}

	<?php if(strpos($_SERVER['REQUEST_URI'], 'Admin/Driver') == TRUE) {?>
	// create
	$('#form-tambah-driver').submit(function(e){
		var data = $(this).serialize()

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Admin/Driver/store') ?>',
			data: data,
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			tampilDriver()
			if (out.status == 'form') {
				$('.form-msg').html(out.msg)
				effect_form_msg()
			} else {
				document.getElementById("form-tambah-driver").reset()
				$('#tambah-driver').modal('hide')
				show_toast(out.type, out.msg)
			}
		})
		
		e.preventDefault()
	})

	// update
	$(document).on('click', '.edit-driver', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Admin/Driver/edit') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#update-driver').modal('show')
		})
	})
	$(document).on('submit','#form-update-driver', function(e){
		var data = $(this).serialize()

		$.ajax({
			method: 'POST',
			url: '<?= base_url('Admin/Driver/update') ?>',
			data: data,
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			tampilDriver()
			if (out.status == 'form') {
				$('.form-msg').html(out.msg)
				effect_form_msg()
			} else {
				document.getElementById("form-update-driver").reset()
				$('#update-driver').modal('hide')
				show_toast(out.type, out.msg)
			}
		})
		
		e.preventDefault()
	})

	// delete
	var id_driver
	$(document).on('click', '.konfirmasiHapus-driver', function() {
		id_driver = $(this).attr('data-id')
	})
	$(document).on('click', '.hapus-driver', function() {
		var id = id_driver
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Admin/Driver/delete') ?>",
			data: "id=" +id
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			$('#confirmation').modal('hide')
			tampilDriver()
			show_toast(out.type, out.msg)
		})
	})
	<?php } ?>
</script>
