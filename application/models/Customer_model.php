<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function getCustomer($id = null) {
		$this->db->from('customer');
		if ($id != null) {
			$this->db->where('id_customer', $id);
		}
		return $this->db->get();
	}

	public function tambahCustomer() {
		$alamat = !empty($this->input->post('alamat', true)) ? $this->input->post('alamat', true) : '';
		$data = [
			'nama_customer' => ucwords($this->input->post('nama', true)),
			'telp' => $this->input->post('telp', true),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
			'alamat' => ucwords($alamat),
		];
		$this->db->insert('customer', $data);
	}

	public function editCustomer() {
		$data = [
			'nama_customer' => ucwords($this->input->post('nama', true)),
			'telp' => $this->input->post('telp', true),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
			'alamat' => ucwords($this->input->post('alamat', true)),
		];
		$this->db->where('id_customer', $this->input->post('id_customer', true));
		$this->db->update('customer', $data);
	}

	public function deleteCustomer($id) {
		$this->db->delete('customer', ['id_customer' => $id]);
	}

}

/* End of file Customer_model.php */
/* Location: ./application/models/Customer_model.php */
