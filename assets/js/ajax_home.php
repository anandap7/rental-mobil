<script  type="text/javascript">
	$(document).ready(function() {
		
	})

	function daterange_refresh(disabledArr = []) {
		$('#daterange').daterangepicker({
			minDate: '<?= date('m/d/Y', strtotime('+1 day')) ?>',
			autoUpdateInput: false,
			isInvalidDate: function(arg){

				// Prepare the date comparision
				var thisMonth = arg._d.getMonth()+1;   // Months are 0 based
				if (thisMonth<10){
					thisMonth = "0"+thisMonth; // Leading 0
				}
				var thisDate = arg._d.getDate();
				if (thisDate<10){
					thisDate = "0"+thisDate; // Leading 0
				}
				var thisYear = arg._d.getYear()+1900;   // Years are 1900 based

				var thisCompare = thisMonth +"/"+ thisDate +"/"+ thisYear;

				if($.inArray(thisCompare,disabledArr)!=-1){
					return true;
				}
			}
		})

		$('#daterange').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD MMMM YYYY') + ' - ' + picker.endDate.format('DD MMMM YYYY'));
		});

		$('#daterange').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	}

	function show_alert(type, title, msg = '', toast = false) {
		if(toast) {
			const Swal = Swal.mixin({
				toast: true,
				position: 'top',
			})
		}

		Swal.fire({
			icon: type,
			title: title,
			text: msg
		}).then(function(){location.reload()})
	}

	$(document).on('click', '.detail-vehicle', function(){
		var id = $(this).attr('data-id')

		$.ajax({
			method: "POST",
			url: "<?= base_url('Api/vehicle_detail') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			$('#modals').html(data)
			$('#detail-vehicle').modal('show')
		})
	})


	// HOME & VEHICLE
	<?php if(in_array($this->router->fetch_method(), ['index', 'vehicle'])){ ?>

	$(document).on('click', '.booking', function(){
		var id = $(this).attr('data-id')
		
		$.ajax({
			method: "POST",
			url: "<?= base_url('Api/get_vehicle') ?>",
			data: 'id=' + id
		})
		.done(function(data) {
			data = jQuery.parseJSON(data)
			
			$('#name').html(data.vehicle.vehicle_name)
			$('#id').val(id)
			$('#license').val(data.vehicle.license_plate)
			daterange_refresh(data.booked)
		})
	})
	$('#form-booking').submit(function(e){
		var data = $(this).serialize()

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Home/book') ?>',
			data: data,
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data)
			
			if (out.status == 'form') {
				$('.form-msg').html(out.msg)
				effect_form_msg()
			} else {
				document.getElementById("form-booking").reset()
				$('#booking-form').modal('hide')
				if(out.type == 'success') show_alert(out.type, out.title, out.msg)
				else if(out.type == 'error') show_alert(out.type, out.title, '',true)
			}
		})
		
		e.preventDefault()
	})
	<?php } ?>
</script>
