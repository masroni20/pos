<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

	public function getSupplier($id = null) {
		$this->db->from('supplier');
		if ($id != null) {
			$this->db->where('id_supplier', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambahSupplier() {
		$post = $this->input->post(null, true);
		$ket = empty($post['keterangan']) ? '' : $post['keterangan'];
		$data = [
			'nama_supplier' => ucwords($post['nama']),
			'telp' => $post['telp'],
			'alamat' => ucwords($post['alamat']),
			'keterangan' => ucwords($ket),
		];
		$query = $this->db->insert('supplier', $data);
		return $query;
	}

	public function editSupplier() {
		$post = $this->input->post(null, true);
		$ket = empty($post['keterangan']) ? '' : $post['keterangan'];
		$data = [
			'nama_supplier' => ucwords($post['nama']),
			'telp' => $post['telp'],
			'alamat' => ucwords($post['alamat']),
			'keterangan' => ucwords($ket),
			'updated' => time(),
		];
		$this->db->where('id_supplier', $post['id_supplier']);
		$query = $this->db->update('supplier', $data);
		return $query;
	}

	public function deleteSupplier($id) {
		$this->db->delete('supplier', ['id_supplier' => $id]);
	}

}

/* End of file Supplier_model.php */
/* Location: ./application/models/Supplier_model.php */
