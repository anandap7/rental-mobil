<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rent extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'admin') redirect('Auth');
	}

	public function index()
	{
		$data['title'] = 'Data Persewaan';
		$data['modal_hapus_rent'] = show_confirm('hapus-rent');
		$this->template->admin('admin/rent/home', $data);
	}

	public function list()
	{
		$rents = $this->rent->get_all();
		foreach ($rents as $key => $rent) {
			$pickup = date_create($rent->pickup_date);
			$return = date_create($rent->return_date);
			$rent->diff = date_diff($pickup, $return)->format('%d');

			if($rent->driver_id != 0) $rent->driver = $this->driver->get_by_id($rent->driver_id)->name;
			else $rent->driver = 'Belum ditentukan';
		}
		$data['rents'] = $rents;
		$this->load->view('admin/rent/list_data', $data);
	}

	public function detail()
	{
		$id = trim($_POST['id']);
		$rent = $this->rent->get_by_id($id);
		$pickup = date_create($rent->pickup_date);
		$return = date_create($rent->return_date);
		$rent->diff = date_diff($pickup, $return)->format('%d');

		$data['rent'] = $rent;

		echo show_modal('admin/modals/detail_rent', 'detail-rent', $data);
	}

	public function invoice($id)
	{
		// $id = trim($_POST['id']);
		$rent = $this->rent->get_for_invoice($id);
		$pickup = date_create($rent->pickup_date);
		$return = date_create($rent->return_date);
		$rent->diff = date_diff($pickup, $return)->format('%d');

		$data['rent'] = $rent;
		$this->load->view('admin/rent/invoice', $data);
	}

	public function edit()
	{
		$id = trim($_POST['id']);
		$vehicle_id = trim($_POST['vehicle']);
		$rent = $this->rent->get_by_id($id);
		$data['rent'] = $rent;
		$data['drivers'] = $this->driver->get_by_vehicle($vehicle_id);
		$data['free_drivers'] = $this->driver->get_available($rent->pickup_date, $rent->return_date);

		echo show_modal('admin/modals/update_rent', 'update-rent', $data);
	}

	public function update()
	{
		$this->form_validation->set_rules('driver_id', 'pengemudi', 'trim|required');

		$data = $this->input->post();
		if($this->form_validation->run() == TRUE) {
			$result = $this->rent->update($data);
			
			if($result > 0) {
				$out['msg'] = 'Pengemudi berhasil ditentukan';
				$out['type'] = 'success';
			} else {
				$out['msg'] = 'Pengemudi gagal ditentukan';
				$out['type'] = 'error';
			}
			$out['status'] = '';
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_form_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete()
	{
		$id = trim($_POST['id']);
		$rent = $this->rent->delete($id);

		if($rent > 0) {
			$out['type'] = 'success';
			$out['msg'] = 'Data berhasil dihapus';
		} else {
			$out['type'] = 'error';
			$out['msg'] = 'Data gagal dihapus';
		}

		echo json_encode($out);
	}
}

/* End of file Rent.php */
