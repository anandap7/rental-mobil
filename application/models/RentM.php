<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RentM extends CI_Model {
	private function generate_rent_id() {
		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$shuffle = substr(str_shuffle($alphabet), 0, 3);
		$id = str_pad($shuffle, 7, strrev(time()));
		if($this->is_unique($id) > 0) $id = $this->generate_rent_id();
		return $id;
	}

	public function is_unique($id)
	{
		$query = $this->db->from('vehicles')->join('rents', 'vehicles.id = rents.vehicle_id')->where(array('rents.id' => $id));
		return $query->count_all_results();
	}

	public function get_all()
	{
		$query = $this->db->join('rents', 'vehicles.id = rents.vehicle_id')->order_by('paid_on')->get('vehicles');
		return $query->result();
	}

	public function get_by_id($id)
	{
		$query = $this->db->join('rents', 'vehicles.id = rents.vehicle_id')->get_where('vehicles', array('rents.id' => $id));
		return $query->row();
	}

	public function get_by_vehicle($id)
	{
		$query = $this->db->get_where('rents', array('vehicle_id' => $id));
		return $query->result();
	}

	public function get_by_owner($id)
	{
		$query = $this->db->join('rents', 'vehicles.id = rents.vehicle_id')->join('owners', 'vehicles.owner_id = owners.id')->get_where('vehicles', array('owner_id' => $id));
		return $query->result();
	}

	public function get_by_driver($id)
	{
		$query = $this->db->join('rents', 'vehicles.id = rents.vehicle_id')->get_where('vehicles', array('rents.driver_id' => $id));
		return $query->result();
	}

	public function get_income()
	{
		$this->db->select('paid_on, SUM(rents.price) AS price');
		$query = $this->db->join('rents', 'vehicles.id = rents.vehicle_id')->group_by('MONTH(paid_on), YEAR(paid_on)')->get('vehicles');
		return $query->result();
	}

	public function get_owner_income($id)
	{
		$this->db->select('paid_on, SUM(rents.price) AS price');
		$query = $this->db->join('rents', 'vehicles.id = rents.vehicle_id')->join('owners', 'vehicles.owner_id = owners.id')->group_by('MONTH(paid_on), YEAR(paid_on)')->get_where('vehicles', array('owner_id' => $id));
		return $query->result();
	}

	public function get_for_invoice($id)
	{
		$this->db->select('*, rents.id AS rent_id, vehicles.id AS vehicle_id');
		$query = $this->db->join('rents', 'vehicles.id = rents.vehicle_id')->join('drivers', 'rents.driver_id = drivers.id')->get_where('vehicles', array('rents.id' => $id));
		return $query->row();
	}

	public function get_rent_freq($month, $year)
	{
		$this->db->select('vehicle_name, paid_on, COUNT(*) AS freq');
		$query = $this->db->join('vehicles', 'vehicles.id = rents.vehicle_id')->group_by('vehicle_id')->order_by('freq DESC')->get_where('rents', array('MONTH(rents.paid_on)' => $month, 'YEAR(rents.paid_on)' => $year));
		return $query->result();
	}

	public function insert($data)
	{
		$date = explode(' - ', $data['date']);
		$diff = date_diff(date_create($date[0]),date_create($date[1]))->format('%d');
		$unit_price = $this->vehicle->get_by_id($data['vehicle_id'])->price;
		$total_price = $unit_price * $diff;
		
		$id = $this->generate_rent_id();
		$rent = [
			'id' => $id,
			'customer_name' => $data['customer_name'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'vehicle_id' => $data['vehicle_id'],
			'pickup_option' => $data['pickup_option'],
			'pickup_date' => date('yy-m-d', strtotime($date[0])),
			'return_date' => date('yy-m-d', strtotime($date[1])),
			'price' => $total_price,
			'paid_on' => date('yy-m-d', time())
		];
		$this->db->insert('rents', $rent);

		$result['rows'] = $this->db->affected_rows();
		$result['id'] = $id;
		return $result;
	}

	public function update($data)
	{
		$id = $data['id'];
		$rent = [
			'driver_id' => $data['driver_id'],
		];
		$this->db->where('id', $id)->update('rents', $rent);

		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$this->db->delete('rents', array('id' => $id));

		return $this->db->affected_rows();
	}

}

/* End of file RentM.php */
