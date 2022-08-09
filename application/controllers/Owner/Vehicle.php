<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {
	private $ownerData;

	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'owner') redirect('Auth');
		$this->ownerData = $this->owner->get_by_user_id($this->session->id);
	}

	public function index()
	{
		$data['title'] = 'Kendaraan Saya';
		$this->template->owner('owner/vehicle/home', $data);
	}

	public function list()
	{
		$vehicles = $this->vehicle->get_by_owner($this->ownerData->id);
		foreach ($vehicles as $key => $vehicle) {
			$rented = $this->rent->get_by_vehicle($vehicle->id);
			if(count($rented) > 0)
				foreach ($rented as $key => $rented) {
					$pickup = date_create($rented->pickup_date);
					$return = date_create($rented->return_date);
					$vehicle->diff = date_diff($pickup, $return)->format('%d');
				}
			$vehicle->rent_count = count($rented);
		}
		$data['vehicles'] = $vehicles;
		$this->load->view('owner/vehicle/list_data', $data);
	}
}

/* End of file Vehicle.php */
