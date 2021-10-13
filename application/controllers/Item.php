<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// jika belum login arahkan ke halaman login
		cek_belum_login();
		$this->load->model('Item_model');
		$this->load->model('Kategori_model');
		$this->load->model('Unit_model');
	}

	public function index() {
		$data['title'] = 'Data item';
		$data['row'] = $this->Item_model->getItem();

		$this->load->view('templates/header', $data);
		$this->load->view('produk/item/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah() {
		$data['title'] = 'Tambah Data item';
		$data['barcode'] = $this->Item_model->getBarcode();
		$data['kategori'] = $this->Kategori_model->getKategori()->result();
		$data['units'] = $this->Unit_model->getUnit()->result();

		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');
		$this->form_validation->set_rules('nama_item', 'Produk', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$this->load->view('templates/header', $data);
			$this->load->view('produk/item/form_tambah_item', $data);
			$this->load->view('templates/footer');
		} else {
			// validasi form sukses
			$this->Item_model->tambahItem();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data item berhasil ditambahkan! </div>');
			redirect('item');
		}
	}

	public function edit($id) {
		$data['title'] = 'Data item';

		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');
		$this->form_validation->set_rules('nama_item', 'Produk', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');

		if ($this->form_validation->run() == false) {
			// jika validasi form gagal
			$query = $this->Item_model->getItem($id);
			// jika data yang di edit ditemukan
			if ($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$data['kategori'] = $this->Kategori_model->getKategori()->result();
				$data['units'] = $this->Unit_model->getUnit()->result();

				$this->load->view('templates/header', $data);
				$this->load->view('produk/item/form_edit_item', $data);
				$this->load->view('templates/footer');
			} else {
				// tidak ada data
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">
					Data item tidak ditemukan! </div>');
				redirect('item');
			}
		} else {
			// validasi form sukses
			$this->Item_model->editItem();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data item berhasil diupdate! </div>');
			redirect('item');
		}
	}

	public function delete($id) {
		$this->Item_model->deleteitem($id);
		$error = $this->db->error();
		// menampilkan error ketika hapus data di database
		if ($error['code'] != 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
				Data item tidak dapat dihapus! </div>');
			redirect('item');
		} else {

			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data item berhasil dihapus! </div>');
			redirect('item');
		}
	}

	public function barcodeGenerator() {
		// This will output the barcode as HTML output to display in the browser
		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
	}

}

/* End of file item.php */
/* Location: ./application/controllers/item.php */
