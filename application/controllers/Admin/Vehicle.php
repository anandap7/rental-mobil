<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'admin') redirect('Auth');
	}

	public function index()
	{
		$data['owners'] = $this->owner->get_all();
		$data['modal_tambah_vehicle'] = show_modal('admin/modals/tambah_vehicle', 'tambah-vehicle', $data);
		$data['modal_hapus_vehicle'] = show_confirm('hapus-vehicle');
		$data['title'] = 'Data Kendaraan';
		$this->template->admin('admin/vehicle/home', $data);
	}

	public function list()
	{
		$data['vehicles'] = $this->vehicle->get_all();
		$this->load->view('admin/vehicle/list_data', $data);
	}

	public function detail()
	{
		$id = trim($_POST['id']);
		$data['vehicle'] = $this->vehicle->get_by_id($id);

		echo show_modal('admin/modals/detail_vehicle', 'detail-vehicle', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('vehicle_name', 'nama kendaraan', 'trim|required');
		$this->form_validation->set_rules('license_plate', 'plat nomor', 'trim|required|is_unique[vehicles.license_plate]');
		$this->form_validation->set_rules('price', 'harga', 'trim|required');
		$this->form_validation->set_rules('owner_id', 'pemilik', 'trim|required');
		
		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] 		= './assets/uploads/vehicle/';
			$config['allowed_types'] 	= 'bmp|gif|jpg|jpeg|png|JPG';
			$config['max_size'] 		= '10000';
			$config['max_width'] 		= '10000';
			$config['file_name'] 		= strtolower(str_replace(' ', '_', $this->input->post('license_plate')));
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('photo')) {
				$out['status'] = 'error';
				$out['msg'] = 'Foto gagal upload';
			} else $data['photo'] = $this->upload->data()['file_name'];

			$result = $this->vehicle->insert($data);

			if($result > 0) {
				$out['msg'] = 'Data berhasil ditambahkan';
				$out['type'] = 'success';
			} else {
				$out['msg'] = 'Data gagal ditambahkan';
				$out['type'] = 'error';
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_form_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function edit()
	{
		$id = trim($_POST['id']);
		$data['owners'] = $this->owner->get_all();
		$data['vehicle'] = $this->vehicle->get_by_id($id);

		echo show_modal('admin/modals/update_vehicle', 'update-vehicle', $data);
	}

	public function update()
	{
		$this->form_validation->set_rules('vehicle_name', 'nama kendaraan', 'trim|required');
		$this->form_validation->set_rules('license_plate', 'plat nomor', 'trim|required');
		$this->form_validation->set_rules('price', 'harga', 'trim|required');
		$this->form_validation->set_rules('owner_id', 'pemilik', 'trim|required');

		$data = $this->input->post();
		if($this->form_validation->run() == TRUE) {
			$vehicle = $this->vehicle->get_by_id($data['id']);
			$config['upload_path'] 		= './assets/uploads/vehicle/';
			$config['allowed_types'] 	= 'bmp|gif|jpg|jpeg|png|JPG';
			$config['max_size'] 		= '10000';
			$config['max_width'] 		= '10000';
			$config['file_name'] 		= strtolower(str_replace(' ', '_', $this->input->post('license_plate')));
			$this->upload->initialize($config);
			
			if($_FILES['photo']['name'] == true) {
				if(!$this->upload->do_upload('photo')) {
					$out['status'] = 'error';
					$out['msg'] = 'Foto gagal upload';
					$data['photo'] = $vehicle->photo;
				} else {
					$data['photo'] = $this->upload->data()['file_name'];
					if(file_exists(FCPATH . 'assets/uploads/vehicle/' . $vehicle->photo)) 
						unlink(FCPATH . 'assets/uploads/vehicle/' . $vehicle->photo);
				}
			} else $data['photo'] = $vehicle->photo;

			$result = $this->vehicle->update($data);
			
			if($result > 0) {
				$out['msg'] = 'Data berhasil diubah';
				$out['type'] = 'success';
			} else {
				$out['msg'] = 'Data gagal diubah';
				$out['type'] = 'error';
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_form_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update_ready()
	{
		$id = trim($_POST['id']);
		$vehicle = $this->vehicle->get_by_id($id);
		$data['id'] = $id;
		$data['is_ready'] = $vehicle->is_ready == '0' ? '1' : '0';

		$result = $this->vehicle->availability_update($data);
			
		if($result > 0) {
			$out['msg'] = 'Ketersediaan berhasil diubah';
			$out['type'] = 'success';
		} else {
			$out['msg'] = 'Ketersediaan gagal diubah';
			$out['type'] = 'error';
		}
		echo json_encode($out);
	}

	public function delete()
	{
		$id = trim($_POST['id']);
		$vehicle = $this->vehicle->get_by_id($id);
		if(file_exists(FCPATH . 'assets/uploads/vehicle/' . $vehicle->photo)) unlink(FCPATH . 'assets/uploads/vehicle/' . $vehicle->photo);

		$vehicle = $this->vehicle->delete($id);

		if($vehicle > 0) {
			$out['type'] = 'success';
			$out['msg'] = 'Data berhasil dihapus';
		} else {
			$out['type'] = 'error';
			$out['msg'] = 'Data gagal dihapus';
		}

		echo json_encode($out);
	}
}

/* End of file Car.php */
