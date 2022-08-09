<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $ownerData;
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'owner') redirect('Auth');
		$this->ownerData = $this->owner->get_by_user_id($this->session->id);
	}

	public function index()
	{
		$data['title'] = 'Laporan Pemasukan';
		$rents = $this->rent->get_owner_income($this->ownerData->id);
		$income = [];
		foreach ($rents as $rent) {
			$year = date_format(date_create($rent->paid_on), 'Y');
			$month = date_format(date_create($rent->paid_on), 'F');
			$income[$year][$month] = $rent->price;
		}
		$data['income'] = $income;
		$this->template->owner('owner/home', $data);
	}
}

/* End of file Home.php */
