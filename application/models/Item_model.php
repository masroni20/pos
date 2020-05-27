<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

	public function getItem($id = null) {
		$this->db->select('*');
		$this->db->from('item');
		$this->db->join('kategori', 'kategori.id_kategori = item.id_kategori');
		$this->db->join('unit', 'unit.id_unit = item.id_unit');
		if ($id != null) {
			$this->db->where('id_item', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambahItem() {
		$post = $this->input->post(null, true);
		$data = [
			'barcode' => strtoupper($post['barcode']),
			'nama_item' => ucwords($post['nama_item']),
			'id_kategori' => $post['id_kategori'],
			'id_unit' => $post['id_unit'],
			'harga' => $post['harga'],
			'created' => time(),
			'updated' => 0,
		];
		$query = $this->db->insert('item', $data);
		return $query;
	}

	public function editItem() {
		$post = $this->input->post(null, true);
		$data = [
			'barcode' => strtoupper($post['barcode']),
			'nama_item' => ucwords($post['nama_item']),
			'id_kategori' => $post['id_kategori'],
			'id_unit' => $post['id_unit'],
			'harga' => $post['harga'],
			'updated' => time(),
		];
		$this->db->where('id_item', $post['id_item']);
		$query = $this->db->update('item', $data);
		return $query;
	}

	public function deleteItem($id) {
		$this->db->delete('item', ['id_item' => $id]);
	}

	public function getBarcode() {
		$this->db->select_max('barcode');
		$query = $this->db->get('item')->row('barcode');
		// ambil angkanya saja
		$angka = preg_replace('/([^0-9]+)/', '', $query);
		$hasil = (int) $angka + 1;
		$kode = sprintf("%04s", $hasil);
		return 'A' . $kode;
	}

	public function update_stok_masuk($data) {
		$qty = $data['qty'];
		$id = $data['id_item'];
		$sql = "UPDATE item SET stok = stok + '$qty' WHERE id_item = '$id' ";
		$this->db->query($sql);
	}

	public function update_stok_keluar($data) {
		$qty = $data['qty'];
		$id = $data['id_item'];
		$sql = "UPDATE item SET stok = stok - '$qty' WHERE id_item = '$id' ";
		$this->db->query($sql);
	}

}

/* End of file item_model.php */
/* Location: ./application/models/item_model.php */
