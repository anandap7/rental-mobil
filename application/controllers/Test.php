<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index($id)
	{
		$rent = $this->rent->get_by_id($id);
		$diff = date_diff(date_create($rent->pickup_date), date_create($rent->return_date));
		$rent->diff = $diff->format('%d');
		$data['rent'] = $rent;
		$this->load->view('admin/rent/invoice', $data);
	}

	public function get_available()
	{
		$start = '2020-07-25';
		$end = '2020-08-03';
		$drivers = $this->db->get('drivers')->result();
		$orders = $this->db->get('driver_orders')->result();

		$free = array();
		foreach ($drivers as $key => $driver) {
			foreach ($orders as $key => $ordered) {
				if($driver->id == $ordered->driver_id) {
					if(!($start >= $ordered->start_date && $end <= $ordered->end_date) && !($end >= $ordered->start_date && $start <= $ordered->end_date)){
						array_push($free, $driver->id);
					}
					continue 2;
				}
			}
			array_push($free, $driver->id);
		}

		print_r($free);
	}

	// public function rent_id()
	// {
	// 	$rent = new RentM();
	// 	echo $rent->generate_rent_id();
	// }
}

/* End of file Test.php */
