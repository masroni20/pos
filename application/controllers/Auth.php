<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index() {
		// jika sudah login arahkan ke halaman dashboar
		cek_sudah_login();

		$this->load->model('User_model');

		$data = [
			'title' => 'Login',
		];
		// set rules form validasi
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		// jalankan validasi
		if ($this->form_validation->run() == false) {
			// validasi form login gagal
			$this->load->view('login', $data);
		} else {
			// validasi form sukses
			$username = $this->input->post('username', true);
			$password = $this->input->post('password', true);
			// query ke database ambil data user
			$query = $this->User_model->login($username);
			// var_dump($query);die;
			// jika data di temukan otomatis bernilai 1
			if ($query->num_rows() > 0) {
				$row = $query->row(); // extrak satu baris saja
				// username terdaftar, cek passwordnya sama atau tidak
				if (password_verify($password, $row->password)) {
					// set session user
					$params = [
						'id_user' => $row->id_user,
						'username' => $row->username,
						'level' => $row->level,
					];
					$this->session->set_userdata($params);
					// login berhasil redirect ke halaman dashboard
					redirect('dashboard');
				} else {
					// password tidak sama, redirect
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
						Password yang anda input salah! </div>');
					redirect('auth');
				}

			} else {
				// data tidak ditemukan
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
					Username tidak terdaftar! </div>');
				redirect('auth');
			}

		}

	}

	public function logout() {
		// hapus semua session
		$params = ['username', 'level'];
		$this->session->unset_userdata($params);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">
			Berhasil logout! </div>');
		redirect('auth');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
