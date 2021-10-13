<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function login($username) {
		return $this->db->get_where('user', ['username' => $username]); // mengembalikan data objek
	}

	public function getUser($id = null) {
		$this->db->from('user');
		if ($id != null) {
			$this->db->where('id_user', $id);
			$this->db->or_where('username', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambahUser() {
		$password = $this->input->post('password', true);
		$alamat = $this->input->post('alamat') ? $this->input->post('alamat') : null;
		$data = [
			'username' => $this->input->post('username', true),
			'nama' => $this->input->post('nama', true),
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'alamat' => $alamat,
			'level' => $this->input->post('level'),
			'created' => time(),
		];
		$this->db->insert('user', $data);
	}

	public function editUser() {
		$data['username'] = $this->input->post('username', true);
		$data['nama'] = $this->input->post('nama', true);
		if (!empty($this->input->post('password2', true))) {
			$data['password'] = password_hash($this->input->post('password2', true), PASSWORD_DEFAULT);
		}
		$data['alamat'] = $this->input->post('alamat', true);
		$data['level'] = $this->input->post('level', true) ? $this->input->post('level', true) : null;
		$data['updated'] = time();

		$this->db->where('id_user', $this->input->post('id_user'));
		$this->db->update('user', $data);
	}

	public function deleteUser($id) {
		$this->db->delete('user', ['id_user' => $id]);
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
