<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->role == 'admin') redirect('Auth');
	}
	
	public function index()
	{
		$data['title'] = 'Data Pemilik Kendaraan';
		$data['modal_tambah_owner'] = show_modal('admin/modals/tambah_owner', 'tambah-owner');
		$data['modal_hapus_owner'] = show_confirm('hapus-owner');
		$this->template->admin('admin/owner/home', $data);
	}

	public function list()
	{
		$data['owners'] = $this->owner->get_all();
		$this->load->view('admin/owner/list_data', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('name', 'nama', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		$data = $this->input->post();
		if($this->form_validation->run() == TRUE) {
			$data['role'] = 'owner';
			$user_id = $this->user->insert($data);
			$data['user_id'] = $user_id;

			$result = $this->owner->insert($data);
			
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
		$data['owner'] = $this->owner->get_by_id($id);

		echo show_modal('admin/modals/update_owner', 'update-owner', $data);
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'nama', 'trim|required');

		$data = $this->input->post();
		if($this->form_validation->run() == TRUE) {
			$result = $this->owner->update($data);
			
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
		$owner = $this->user->delete($id);

		if($owner > 0){
			$out['type'] = 'success';
			$out['msg'] = 'Data berhasil dihapus';
		} else {
			$out['type'] = 'error';
			$out['msg'] = 'Data gagal dihapus';
		}

		echo json_encode($out);
	}
}

/* End of file Owner.php */
