<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// jika belum login arahkan ke halaman login
		cek_belum_login();
		$this->load->model('Unit_model');
	}

	public function index() {
		$data['title'] = 'Data unit';
		$data['row'] = $this->Unit_model->getunit();

		$this->load->view('templates/header', $data);
		$this->load->view('produk/unit/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah() {
		$data['title'] = 'Tambah Data unit';

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$this->load->view('templates/header', $data);
			$this->load->view('produk/unit/form_tambah_unit', $data);
			$this->load->view('templates/footer');
		} else {
			// validasi form sukses
			$this->Unit_model->tambahUnit();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data unit berhasil ditambahkan! </div>');
			redirect('unit');
		}
	}

	public function edit($id) {
		$data['title'] = 'Data unit';

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$query = $this->Unit_model->getUnit($id);
			// jika data yang di edit ditemukan
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$this->load->view('templates/header', $data);
				$this->load->view('produk/unit/form_edit_unit', $data);
				$this->load->view('templates/footer');
			} else {
				// tidak ada data
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">
					Data unit tidak ditemukan! </div>');
				redirect('unit');
			}
		} else {
			// validasi form sukses
			$this->Unit_model->editUnit();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data unit berhasil diupdate! </div>');
			redirect('unit');
		}
	}

	public function delete($id) {
		$this->Unit_model->deleteUnit($id);
		$error = $this->db->error();
		// menampilkan error ketika hapus data di database
		if ($error['code'] != 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
				Data unit tidak dapat dihapus! </div>');
			redirect('unit');
		} else {

			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data unit berhasil dihapus! </div>');
			redirect('unit');
		}
	}

}

/* End of file unit.php */
/* Location: ./application/controllers/unit.php */
