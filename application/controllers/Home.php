<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['page'] = 'beranda';
		$data['vehicles'] = $this->vehicle->get_all();
		$data['modal_booking'] = show_modal('modals/form_booking', 'booking-form', $data);
		$this->template->home('pages/home', $data);
	}

	public function vehicle()
	{
		$data['page'] = 'mobil';
		$data['vehicles'] = $this->vehicle->get_all();
		$data['modal_booking'] = show_modal('modals/form_booking', 'booking-form', $data);
		$this->template->home('pages/vehicle', $data);
	}

	public function about()
	{
		$data['page'] = 'tentang';
		$this->template->home('pages/about', $data);
	}

	public function contact()
	{
		$data['page'] = 'kontak';
		$this->template->home('pages/contact', $data);
	}

	public function book()
	{
		$this->form_validation->set_rules('customer_name', 'nama penyewa', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'nomor telepon', 'trim|required');
		$this->form_validation->set_rules('date', 'tanggal sewa', 'trim|required');
		$this->form_validation->set_rules('pickup_option', 'lokasi pengambilan', 'trim|required');
		
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->rent->insert($data);

			if($result['rows'] > 0) {
				$out['title'] = $result['id'];
				$out['msg'] = 'Mohon catat kode booking Anda';
				$out['type'] = 'success';
			} else {
				$out['title'] = 'Booking gagal';
				$out['type'] = 'error';
			}
		} else {
			$out['status'] = 'form';
			$out['title'] = show_form_msg(validation_errors());
		}

		echo json_encode($out);
	}
}
