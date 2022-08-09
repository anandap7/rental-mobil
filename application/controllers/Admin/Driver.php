<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'admin') redirect('Auth');
	}

	public function index()
	{
		$data['title'] = 'Data Pengemudi';
		$modal['vehicles'] = $this->vehicle->get_unmapped_driver();
		$data['modal_tambah_driver'] = show_modal('admin/modals/tambah_driver', 'tambah-driver', $modal);
		$data['modal_hapus_driver'] = show_confirm('hapus-driver');
		$this->template->admin('admin/driver/home', $data);
	}

	public function list()
	{
		$data['drivers'] = $this->driver->get_all();
		$this->load->view('admin/driver/list_data', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('name', 'nama', 'trim|required');
		$this->form_validation->set_rules('vehicle_id', 'kendaraan', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		$data = $this->input->post();
		if($this->form_validation->run() == TRUE) {
			$data['role'] = 'driver';
			$user_id = $this->user->insert($data);
			$data['user_id'] = $user_id;

			$result = $this->driver->insert($data);
			
			if($result > 0) {
				$out['msg'] = 'Data berhasil ditambahkan';
				$out['type'] = 'success';
			} else {
				$out['msg'] = 'Data gagal ditambahkan';
				$out['type'] = 'error';
			}
			$out['status'] = '';
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_form_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function edit()
	{
		$id = trim($_POST['id']);
		$data['driver'] = $this->driver->get_by_id($id);
		$data['vehicles'] = $this->vehicle->get_all();

		echo show_modal('admin/modals/update_driver', 'update-driver', $data);
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'nama', 'trim|required');

		$data = $this->input->post();
		if($this->form_validation->run() == TRUE) {
			$result = $this->driver->update($data);
			
			if($result > 0) {
				$out['msg'] = 'Data berhasil diubah';
				$out['type'] = 'success';
			} else {
				$out['msg'] = 'Data gagal diubah';
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
		$driver = $this->user->delete($id);

		if($driver > 0){
			$out['type'] = 'success';
			$out['msg'] = 'Data berhasil dihapus';
		} else {
			$out['type'] = 'error';
			$out['msg'] = 'Data gagal dihapus';
		}

		echo json_encode($out);
	}
}

/* End of file Driver.php */
