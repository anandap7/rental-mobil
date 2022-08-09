<script type="text/javascript">
	$(document).ready(function(){

	})

	var MyTable = $('#list-data').dataTable()

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
		MyTable = $('#list-data').dataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"info": true,
			"autoWidth": false
		})
	}

	<?php if(strpos($_SERVER['REQUEST_URI'], 'Owner/Home') == TRUE) {?>
	var barChartData = {
		labels:[
			<?php foreach($income as $year => $value){
				foreach($value as $month => $value){
					echo "'$month $year',";
				}
			}?>
		],
		datasets: [{
			label:'',
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
	window.onload = function() {
		var chart = new Chart($('#chart'), {
			type: 'bar',
			data: barChartData,
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
	}
	<?php } ?>
	
	// Vehicle
	<?php if(strpos($_SERVER['REQUEST_URI'], 'Owner/Vehicle') == TRUE) {?>
	window.onload = function() {
		tampilVehicle()
	}

	// read all
	function tampilVehicle() {
		$.get('<?= base_url('Owner/Vehicle/list') ?>', function(data) {
			MyTable.fnDestroy()
			$('#data-vehicle').html(data)
			refresh()
		})
	}

	// read one
	$(document).on('click', '.detail-vehicle', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Owner/Vehicle/detail') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#detail-vehicle').modal('show')
		})
	})
<?php } ?>
</script>
