<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DriverM extends CI_Model {
	public function get_all()
	{
		$this->db->select('users.*, vehicles.*, drivers.*');
		$query = $this->db->join('drivers', 'users.id = drivers.user_id')->join('vehicles', 'vehicles.id = drivers.vehicle_id')->get('users');
		return $query->result();
	}

	public function get_by_id($id)
	{
		$query = $this->db->join('drivers', 'users.id = drivers.user_id')->get_where('users', array('drivers.id' => $id));
		return $query->row();
	}

	public function get_by_user_id($id)
	{
		$query = $this->db->join('drivers', 'users.id = drivers.user_id')->get_where('users', array('user_id' => $id));
		return $query->row();
	}

	public function get_by_vehicle($id)
	{
		$query = $this->db->join('drivers', 'vehicles.id = drivers.vehicle_id')->get_where('vehicles', array('drivers.vehicle_id' => $id));
		return $query->result();
	}

	public function get_available($start, $end)
	{
		$drivers = $this->db->get('drivers')->result();
		$orders = $this->db->get_where('rents', 'driver_id != 0')->result();

		$free = array();
		foreach ($drivers as $key => $driver) {
			foreach ($orders as $key => $ordered) {
				if($driver->id == $ordered->driver_id) {
					if(!($start >= $ordered->pickup_date && $end <= $ordered->return_date) && !($end >= $ordered->pickup_date && $start <= $ordered->return_date)){
						array_push($free, $driver->id);
					}
					continue 2;
				}
			}
			array_push($free, $driver->id);
		}

		return $free;
	}

	public function insert($data)
	{
		$driver = [
			'name' => $data['name'],
			'user_id' => $data['user_id'],
			'vehicle_id' => $data['vehicle_id'],
		];
		$this->db->insert('drivers', $driver);

		return $this->db->affected_rows();
	}

	public function update($data)
	{
		$id = $data['id'];
		$driver = [
			'name' => $data['name'],
			'vehicle_id' => $data['vehicle_id'],
		];
		$this->db->where('id', $id)->update('drivers', $driver);

		return $this->db->affected_rows();
	}

}

/* End of file DriverM.php */
