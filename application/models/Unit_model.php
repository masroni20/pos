<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

	public function getUnit($id = null) {
		$this->db->from('unit');
		if ($id != null) {
			$this->db->where('id_unit', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambahUnit() {
		$post = $this->input->post(null, true);
		$data = [
			'nama_unit' => ucfirst($post['nama']),
			'created' => time(),
			'updated' => 0,
		];
		$query = $this->db->insert('unit', $data);
		return $query;
	}

	public function editUnit() {
		$post = $this->input->post(null, true);
		$data = [
			'nama_unit' => ucfirst($post['nama']),
			'updated' => time(),
		];
		$this->db->where('id_unit', $post['id_unit']);
		$query = $this->db->update('unit', $data);
		return $query;
	}

	public function deleteUnit($id) {
		$this->db->delete('unit', ['id_unit' => $id]);
	}

}

/* End of file unit_model.php */
/* Location: ./application/models/unit_model.php */
