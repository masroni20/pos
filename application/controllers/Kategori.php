<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// jika belum login arahkan ke halaman login
		cek_belum_login();
		$this->load->model('Kategori_model');
	}

	public function index() {
		$data['title'] = 'Data Kategori';
		$data['row'] = $this->Kategori_model->getkategori();

		$this->load->view('templates/header', $data);
		$this->load->view('produk/kategori/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah() {
		$data['title'] = 'Tambah Data Kategori';

		$this->form_validation->set_rules('nama', 'Kategori', 'trim|required');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$this->load->view('templates/header', $data);
			$this->load->view('produk/kategori/form_tambah_kategori', $data);
			$this->load->view('templates/footer');
		} else {
			// validasi form sukses
			$this->Kategori_model->tambahKategori();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data kategori berhasil ditambahkan! </div>');
			redirect('kategori');
		}
	}

	public function edit($id) {
		$data['title'] = 'Data kategori';

		$this->form_validation->set_rules('nama', 'Kategori', 'trim|required');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$query = $this->Kategori_model->getKategori($id);
			// jika data yang di edit ditemukan
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$this->load->view('templates/header', $data);
				$this->load->view('produk/kategori/form_edit_kategori', $data);
				$this->load->view('templates/footer');
			} else {
				// tidak ada data
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">
					Data kategori tidak ditemukan! </div>');
				redirect('kategori');
			}
		} else {
			// validasi form sukses
			$this->Kategori_model->editKategori();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data kategori berhasil diupdate! </div>');
			redirect('kategori');
		}
	}

	public function delete($id) {
		$this->Kategori_model->deleteKategori($id);
		$error = $this->db->error();
		// menampilkan error ketika hapus data di database
		if ($error['code'] != 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
				Data kategori tidak dapat dihapus! </div>');
			redirect('kategori');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data kategori berhasil dihapus! </div>');
			redirect('kategori');
		}
	}

}

/* End of file kategori.php */
/* Location: ./application/controllers/kategori.php */
