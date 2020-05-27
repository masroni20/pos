<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// jika belum login arahkan ke halaman login
		cek_belum_login();
		$this->load->model('Customer_model');
	}

	public function index() {
		$data = [
			'title' => 'Data Customer',
			'row' => $this->Customer_model->getCustomer(),
		];
		$this->load->view('templates/header', $data);
		$this->load->view('customer/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah() {
		$data = [
			'title' => 'Data Customer',
		];
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('telp', 'No Telephone', 'trim|required|numeric');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$this->load->view('templates/header', $data);
			$this->load->view('customer/form_tambah_customer', $data);
			$this->load->view('templates/footer');
		} else {
			// validasi form sukses
			$this->Customer_model->tambahCustomer();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data Customer berhasil ditambahkan! </div>');
			redirect('customer');
		}
	}

	public function edit($id) {
		$data = [
			'title' => 'Data Customer',
		];
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('telp', 'No Telephone', 'trim|required|numeric');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$query = $this->Customer_model->getCustomer($id);
			// jika data yang di edit ditemukan
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$this->load->view('templates/header', $data);
				$this->load->view('customer/form_edit_customer', $data);
				$this->load->view('templates/footer');
			} else {
				// tidak ada data
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">
					Data Customer tidak ditemukan! </div>');
				redirect('customer');
			}
		} else {
			// validasi form sukses
			$this->Customer_model->editCustomer();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data Customer berhasil diupdate! </div>');
			redirect('customer');
		}
	}

	public function delete($id) {
		$this->Customer_model->deleteCustomer($id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">
			Data Customer berhasil dihapus! </div>');
		redirect('customer');
	}

}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */
