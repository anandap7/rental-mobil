<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OwnerM extends CI_Model {
	public function get_all()
	{
		$query = $this->db->join('owners', 'users.id = owners.user_id')->get('users');
		return $query->result();
	}

	public function get_by_id($id)
	{
		$query = $this->db->join('owners', 'users.id = owners.user_id')->get_where('users', array('owners.id' => $id));
		return $query->row();
	}

	public function get_by_user_id($id)
	{
		$query = $this->db->join('owners', 'users.id = owners.user_id')->get_where('users', array('user_id' => $id));
		return $query->row();
	}

	public function insert($data)
	{
		$owner = [
			'name' => $data['name'],
			'user_id' => $data['user_id'],
		];
		$this->db->insert('owners', $owner);

		return $this->db->affected_rows();
	}

	public function update($data)
	{
		$id = $data['id'];
		$owner = [
			'name' => $data['name'],
		];
		$this->db->where('id', $id)->update('owners', $owner);

		return $this->db->affected_rows();
	}
}

/* End of file OwnerM.php */
