<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {
	private $driverData;

	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'driver') redirect('Auth');
		$this->driverData = $this->driver->get_by_user_id($this->session->id);
	}

	public function index()
	{
		$data['driverData'] = $this->driverData;
		$data['title'] = 'Kendaraan Saya';
		$this->template->driver('driver/schedule/home', $data);
	}

	public function list()
	{
		$schedules = $this->rent->get_by_driver($this->driverData->id);
		$data['schedules'] = $schedules;
		$this->load->view('driver/schedule/list_data', $data);
	}
}

/* End of file Schedule.php */
