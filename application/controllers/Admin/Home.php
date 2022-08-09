<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'admin') redirect('Auth');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		
		$months = array();
		$incomes = $this->rent->get_income();
		$income_data = array();
		foreach ($incomes as $income) {
			$year = date_format(date_create($income->paid_on), 'Y');
			$month = date_format(date_create($income->paid_on), 'F');
			$income_data[$year][$month] = $income->price;
			array_push($months, $month.' '.$year);
		}
		$data['income'] = $income_data;
		$data['months'] = $months;

		$data['freq'] = $this->rent->get_rent_freq(date('m', strtotime(end($months))), date('Y', strtotime(end($months))));
		$this->template->admin('admin/home', $data);
	}

	public function ajax_freq()
	{
		$month = trim($_POST['month']);
		$year = trim($_POST['year']);
		$freq = $this->rent->get_rent_freq($month, $year);

		$vehicle_names = array();
		$freqs = array();
		foreach ($freq as $key => $freq) {
			array_push($vehicle_names, $freq->vehicle_name);
			array_push($freqs, $freq->freq);
		}

		$out['vehicle_names'] = $vehicle_names;
		$out['freqs'] = $freqs;
		echo json_encode($out);
	}
}

/* End of file Home.php */
