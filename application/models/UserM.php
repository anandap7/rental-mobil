<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserM extends CI_Model {
	public function find_username($username)
	{
		$query = $this->db->where(array('username' => $username))->from('users');
		return $query->count_all_results();
	}

	public function get_by_username($username)
	{
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row();
	}

	public function insert($data)
	{
		$user = [
			'username' => $data['username'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			'role' => $data['role']
		];
		$this->db->insert('users', $user);

		return $this->db->insert_id();
	}

	public function delete($id)
	{
		$this->db->delete('users', array('id' => $id));

		return $this->db->affected_rows();
	}
}

/* End of file AuthM.php */
