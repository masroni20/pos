<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_model extends CI_Model {

	public function get_stok_masuk() {
		$this->db->select('*');
		$this->db->from('stok');
		$this->db->join('item', 'item.id_item = stok.id_item');
		$this->db->join('supplier', 'supplier.id_supplier = stok.id_supplier', 'left');
		$this->db->where('type', 'in');
		$this->db->order_by('id_stok', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function getStok($id = null) {
		$this->db->from('stok');
		if ($id != null) {
			$this->db->where('id_stok', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambah_stok_masuk($post) {
		$data = [
			'id_item' => $post['id_item'],
			'type' => 'in',
			'detail' => $post['detail'],
			'id_supplier' => $post['id_supplier'] == '' ? null : $post['id_supplier'],
			'qty' => $post['qty'],
			'tanggal' => $post['tanggal'],
			'id_user' => $this->session->userdata('id_user'),
			'created' => time(),
		];
		$query = $this->db->insert('stok', $data);
	}

	public function delete($id) {
		$this->db->where('id_stok', $id);
		$this->db->delete('stok');
	}

	// kelola database data stok keluar
	public function get_stok_keluar() {
		$this->db->select('*');
		$this->db->from('stok');
		$this->db->join('item', 'item.id_item = stok.id_item');
		$this->db->join('supplier', 'supplier.id_supplier = stok.id_supplier', 'left');
		$this->db->where('type', 'out');
		$this->db->order_by('id_stok', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function tambah_stok_keluar($post) {
		$data = [
			'id_item' => $post['id_item'],
			'type' => 'out',
			'detail' => $post['detail'],
			// 'id_supplier' => $post['id_supplier'] == '' ? null : $post['id_supplier'],
			'qty' => $post['qty'],
			'tanggal' => $post['tanggal'],
			'id_user' => $this->session->userdata('id_user'),
			'created' => time(),
		];
		$query = $this->db->insert('stok', $data);
	}

}

/* End of file Stok_model.php */
/* Location: ./application/models/Stok_model.php */
