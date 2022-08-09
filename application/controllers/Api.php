<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function vehicle_detail()
	{
		$id = trim($_POST['id']);
		$data['vehicle'] = $this->vehicle->get_by_id($id);

		echo show_modal('admin/modals/detail_vehicle', 'detail-vehicle', $data);
	}

	public function get_vehicle()
	{
		$id = trim($_POST['id']);
		$out['vehicle'] = $this->vehicle->get_by_id($id);
		$out['booked'] = array();
		$booked = $this->rent->get_by_vehicle($id);
		foreach ($booked as $booked) {
			$date = date('yy-m-d', strtotime($booked->pickup_date));
			while($date != date('yy-m-d', strtotime('1 day', strtotime($booked->return_date)))){
				array_push($out['booked'], date_format(date_create($date),'m/d/Y'));
				$date = date('yy-m-d', strtotime('1 day', strtotime($date)));
			}
		}

		echo json_encode($out);
	}
}

/* End of file Api.php */
