<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public function getKategori($id = null) {
		$this->db->from('kategori');
		if ($id != null) {
			$this->db->where('id_kategori', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambahKategori() {
		$post = $this->input->post(null, true);
		$data = [
			'nama_kategori' => ucfirst($post['nama']),
			'created' => time(),
			'updated' => 0,
		];
		$query = $this->db->insert('kategori', $data);
		return $query;
	}

	public function editKategori() {
		$post = $this->input->post(null, true);
		$data = [
			'nama_kategori' => ucfirst($post['nama']),
			'updated' => time(),
		];
		$this->db->where('id_kategori', $post['id_kategori']);
		$query = $this->db->update('kategori', $data);
		return $query;
	}

	public function deleteKategori($id) {
		$this->db->delete('kategori', ['id_kategori' => $id]);
	}

}

/* End of file kategori_model.php */
/* Location: ./application/models/kategori_model.php */
