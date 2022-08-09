<script type="text/javascript">
	$(document).ready(function(){
		
	})

	var MyTable = $('#list-data').dataTable()

	window.onload = function() {
		tampilSchedule()
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
		MyTable = $('#list-data').dataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"info": true,
			"autoWidth": false
		})
	}

	<?php if(strpos($_SERVER['REQUEST_URI'], 'Driver/Home') == TRUE) {?>
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
	
	// Schedule
	// read all
	function tampilSchedule() {
		$.get('<?= base_url('Driver/Schedule/list') ?>', function(data) {
			MyTable.fnDestroy()
			$('#data-schedule').html(data)
			refresh()
		})
	}

	// read one
	$(document).on('click', '.detail-schedule', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Driver/Schedule/detail') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#detail-schedule').modal('show')
		})
	})
</script>
