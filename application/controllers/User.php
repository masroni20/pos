<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// jika belum login arahkan ke halaman login
		cek_belum_login();
		check_admin();
		$this->load->library('form_validation');
		$this->load->model('User_model');
	}

	public function index() {
		$data = [
			'title' => 'Data Pengguna',
			'row' => $this->User_model->getUser(),
		];

		$this->load->view('templates/header', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah() {
		$data = [
			'title' => 'Tambah Pengguna Baru',
		];

		// set rule validasi form
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[password]');
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|min_length[3]|matches[password]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');

		// jalankan validasi form
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('user/form_tambah_user', $data);
			$this->load->view('templates/footer');
		} else {
			// validasi form ok
			$this->User_model->tambahUser();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data User berhasil ditambahkan! </div>');
			redirect('user');

		}
	}

	public function edit($id) {
		$data = [
			'title' => 'Edit Pengguna',
		];

		// set rule validasi form
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check');
		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[password]');
			$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|min_length[3]|matches[password]');
		}
		if ($this->input->post('password2')) {
			$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|min_length[3]|matches[password]');
		}
		$this->form_validation->set_rules('alamat', 'Konfirmasi Password', 'trim');

		// jalankan validasi form
		if ($this->form_validation->run() == false) {
			$query = $this->User_model->getUser($id);
			// jika data yang di edit ditemukan
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$this->load->view('templates/header', $data);
				$this->load->view('user/form_edit_user', $data);
				$this->load->view('templates/footer');
			} else {
				// data tidak ditemukan
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">
					Data User tidak ditemukan! </div>');
				redirect('user');

			}

		} else {
			// validasi form ok
			$result = $this->User_model->editUser();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data User berhasil diupdate! </div>');
			redirect('user');

		}
	}

	public function username_check() {
		// query untuk cek username
		$username = $this->input->post('username');
		$id_user = $this->input->post('id_user');
		// jika username yang di input sudah ada di database tapi idnya tidak sama dengan id yg di update
		$query = $this->db->query("SELECT * FROM user WHERE username = '$username' AND id_user != '$id_user' ");

		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check', '{field} ini sudah dipakai, silahkan ganti!');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function delete($id) {
		$this->User_model->deleteUser($id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">
			Data User berhasil dihapus! </div>');
		redirect('user');
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
