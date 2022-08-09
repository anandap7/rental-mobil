<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $driverData;

	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'driver') redirect('Auth');
		$this->driverData = $this->driver->get_by_user_id($this->session->id);
	}

	public function index()
	{
		$data['title'] = 'Laporan Pemasukan';
		$rents = $this->rent->get_by_driver($this->driverData->id);
		$income = [];
		foreach ($rents as $rent) {
			$year = date_format(date_create($rent->paid_on), 'Y');
			$month = date_format(date_create($rent->paid_on), 'F');
			$diff = date_diff(date_create($rent->pickup_date), date_create($rent->return_date))->format('%d') + 1;
			$income[$year][$month] += 100000 * $diff;
		}
		$data['income'] = $income;
		$this->template->driver('driver/home', $data);
	}
}

/* End of file Home.php */
