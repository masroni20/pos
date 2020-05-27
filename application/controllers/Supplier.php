<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// jika belum login arahkan ke halaman login
		cek_belum_login();
		$this->load->model('Supplier_model');
		$this->load->library('form_validation');
	}

	public function index() {
		$data = [
			'title' => 'Data Supplier',
			'row' => $this->Supplier_model->getSupplier(),
		];
		$this->load->view('templates/header', $data);
		$this->load->view('supplier/index', $data);
		$this->load->view('templates/footer');

	}

	public function tambah() {
		$data = [
			'title' => 'Data Supplier',
		];

		$this->form_validation->set_rules('nama', 'Nama Supplier', 'trim|required');
		$this->form_validation->set_rules('telp', 'No Telephone', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$this->load->view('templates/header', $data);
			$this->load->view('supplier/form_tambah_supplier', $data);
			$this->load->view('templates/footer');
		} else {
			// validasi form sukses
			$this->Supplier_model->tambahSupplier();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data Supplier berhasil ditambahkan! </div>');
			redirect('supplier');
		}
	}

	public function edit($id) {
		$data = [
			'title' => 'Edit Supplier',
		];

		$this->form_validation->set_rules('nama', 'Nama Supplier', 'trim|required');
		$this->form_validation->set_rules('telp', 'No Telephone', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$query = $this->Supplier_model->getSupplier($id);
			// jika data yang di edit ada
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$this->load->view('templates/header', $data);
				$this->load->view('supplier/form_edit_supplier', $data);
				$this->load->view('templates/footer');
			} else {
				// jika tidak ada data
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">
					Data Supplier tidak ditemukan! </div>');
				redirect('supplier');
			}
		} else {
			// validasi form sukses
			$this->Supplier_model->editSupplier();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data Supplier berhasil diupdate! </div>');
			redirect('supplier');
		}
	}

	public function delete($id) {
		$this->Supplier_model->deleteSupplier($id);
		$error = $this->db->error();
		// menampilkan error ketika hapus data di database
		if ($error['code'] != 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
				Data Supplier tidak dapat dihapus! </div>');
			redirect('supplier');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data Supplier berhasil dihapus! </div>');
			redirect('supplier');
		}
	}

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */
