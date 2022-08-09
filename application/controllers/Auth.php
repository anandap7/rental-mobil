<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->user->find_username($username);
		if ($user == 1) {
			$user = $this->user->get_by_username($username);
			if (password_verify($password, $user->password)){
				$data = [
					'id' => $user->id,
					'username' => $user->username,
					'role' => $user->role,
					'status' => 'Log In'
				];

				$this->session->set_userdata($data);
				switch ($user->role) {
					case 'admin':
						redirect('Admin/Home');
						break;
					case 'owner':
						redirect('Owner/Home');
						break;
					case 'driver':
						redirect('Driver/Home');
						break;
					default:
						redirect('Auth');
						break;
				}
			} else {
				$this->session->set_flashdata('error', 'Password tidak cocok');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('error', 'Username tidak ditemukan');
			redirect('Auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth');
	}
}

/* End of file Welcome.php */
