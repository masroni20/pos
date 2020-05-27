<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// jika belum login arahkan ke halaman login
		cek_belum_login();
		$this->load->model('Stok_model');
		$this->load->model('Item_model');
		$this->load->model('Supplier_model');
	}

	// menampilkan data stok in
	public function stok_in_index() {
		$data['title'] = 'Stok In';
		$data['row'] = $this->Stok_model->get_stok_masuk()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('transaksi/in/stok_in_index', $data);
		$this->load->view('templates/footer');

	}

	// menampilkan form tambah stok masuk
	public function stok_in_tambah() {
		$data['title'] = 'Stok In';
		$data['item'] = $this->Item_model->getItem()->result();
		$data['supplier'] = $this->Supplier_model->getSupplier()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('transaksi/in/stok_in_tambah', $data);
		$this->load->view('templates/footer');
	}

	public function stok_in_delete() {
		$id_stok = $this->uri->segment(4);
		$id_item = $this->uri->segment(5);
		$qty = $this->Stok_model->getStok($id_stok)->row()->qty;
		$data = ['qty' => $qty, 'id_item' => $id_item];
		$this->Item_model->update_stok_keluar($data); // update stok di tabel item filed stok
		$this->Stok_model->delete($id_stok); // hapus stok di tabel stok

		// jika berhasil
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data stok masuk berhasil hapus! </div>');
			redirect('stok/in');
		}
	}

	public function proses() {
		// cek jika tombol tambah stok_masuk di tekan
		if (isset($_POST['stok_masuk'])) {
			$post = $this->input->post(null, true);
			// input ke database stok masuk
			$this->Stok_model->tambah_stok_masuk($post); // tambahkan data stok masuk di tabel stok
			$this->Item_model->update_stok_masuk($post); // update stok juga di tabel item

			// jika berhasil
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-success">
					Data stok masuk berhasil disimpan! </div>');
				redirect('stok/in');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">
					Data stok masuk gagal disimpan! </div>');
				redirect('stok/in');
			}
		} elseif (isset($_POST['stok_keluar'])) {
			$post = $this->input->post(null, true);
			// input ke database data stok keluar di tabel stok
			$this->Stok_model->tambah_stok_keluar($post);
			// update stok juga di tabel item
			$this->Item_model->update_stok_keluar($post);

			// jika berhasil
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-success">
					Data stok keluar berhasil disimpan! </div>');
				redirect('stok/out');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning">
					Data stok keluar gagal disimpan! </div>');
				redirect('stok/out');
			}
		}
	}

	// kelola daftar stok out
	public function stok_out_index() {
		$data['title'] = 'Stok Out';
		$data['row'] = $this->Stok_model->get_stok_keluar()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('transaksi/out/stok_out_index', $data);
		$this->load->view('templates/footer');
	}

	// menampilkan form tambah stok keluar
	public function stok_out_tambah() {
		$data['title'] = 'Stok Out';
		$data['item'] = $this->Item_model->getItem()->result();
		// $data['supplier'] = $this->Supplier_model->getSupplier()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('transaksi/out/stok_out_tambah', $data);
		$this->load->view('templates/footer');
	}

	public function stok_out_delete() {
		$id_stok = $this->uri->segment(4);
		$id_item = $this->uri->segment(5);
		$qty = $this->Stok_model->getStok($id_stok)->row()->qty;
		$data = ['qty' => $qty, 'id_item' => $id_item];
		$this->Item_model->update_stok_masuk($data); // update stok di tabel item filed stok
		$this->Stok_model->delete($id_stok); // hapus stok di tabel stok

		// jika berhasil
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success">
				Data stok keluar berhasil hapus! </div>');
			redirect('stok/out');
		}
	}

}

/* End of file Stok.php */
/* Location: ./application/controllers/Stok.php */
