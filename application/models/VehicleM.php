<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VehicleM extends CI_Model {
	public function get_all()
	{
		$query = $this->db->order_by('is_ready','desc')->get('vehicles');
		return $query->result();
	}

	public function get_by_id($id)
	{
		$query = $this->db->join('vehicles', 'owners.id = vehicles.owner_id')->get_where('owners', array('vehicles.id' => $id));
		return $query->row();
	}

	public function get_by_owner($id)
	{
		$query = $this->db->join('vehicles', 'owners.id = vehicles.owner_id')->get_where('owners', array('owner_id' => $id));
		return $query->result();
	}

	public function get_unmapped_driver()
	{
		$query = $this->db->join('vehicles', 'vehicles.id = drivers.vehicle_id', 'right')->get_where('drivers', 'drivers.vehicle_id IS NULL');
		return $query->result();
	}

	public function insert($data)
	{
		$vehicle = [
			'vehicle_name' => ucwords($data['vehicle_name']),
			'license_plate' => strtoupper($data['license_plate']),
			'price' => str_replace('.','',substr($data['price'],3)),
			'photo' => $data['photo'],
			'owner_id' => $data['owner_id'],
		];
		$this->db->insert('vehicles', $vehicle);

		return $this->db->affected_rows();
	}

	public function update($data)
	{
		$id = $data['id'];
		$vehicle = [
			'vehicle_name' => ucwords($data['vehicle_name']),
			'license_plate' => strtoupper($data['license_plate']),
			'price' => str_replace('.','',substr($data['price'],3)),
			'photo' => $data['photo'],
			'owner_id' => $data['owner_id'],
		];
		$this->db->where('id', $id)->update('vehicles', $vehicle);

		return $this->db->affected_rows();
	}

	public function availability_update($data)
	{
		$id = $data['id'];
		$vehicle = ['is_ready' => $data['is_ready']];
		$this->db->where('id', $id)->update('vehicles', $vehicle);

		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$this->db->delete('vehicles', array('id' => $id));

		return $this->db->affected_rows();
	}

}

/* End of file DriverM.php */
