<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// jika belum login arahkan ke halaman login
		cek_belum_login();
		$this->load->model('Penjualan_model');
		$this->load->model('Item_model');
		$this->load->model('Customer_model');
	}

	public function index() {
		$data['title'] = 'Input Penjualan';
		$data['item'] = $this->Item_model->getItem()->result();
		$data['customer'] = $this->Customer_model->getCustomer();
		$data['invoice'] = $this->Penjualan_model->no_invoice();
		$data['keranjang'] = $this->Penjualan_model->getKeranjang();

		$this->load->view('templates/header', $data);
		$this->load->view('transaksi/penjualan/index', $data);
		$this->load->view('templates/footer');

	}

	public function proses() {
		$data = $this->input->post(null, true);
		// jika tombol add_cart di tekan
		if (isset($_POST['add_cart'])) {
			// cek dulu keranjangnya sudah ada id_item yang sama atau belum
			$id_item = $this->input->post('id_item', true);
			$cek_keranjang = $this->Penjualan_model->getKeranjang(['keranjang.id_item' => $id_item])->num_rows();
			// jika id_item di tabel keranjang sudah ada, update keranjangnya
			if ($cek_keranjang > 0) {
				$this->Penjualan_model->updateKeranjangQty($data);
			} else {
				// jika id_item di tabel keranjang belum ada tambahkan item ke keranjang
				$this->Penjualan_model->tambahKeranjang($data);
			}

			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}

		// jika tombol edit keranjang belanja di tekan
		if (isset($_POST['edit_cart'])) {
			$this->Penjualan_model->updateKeranjang($data);
			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}

		// jika proses_pembayaran di tekan
		if (isset($_POST['proses_pembayaran'])) {
			$post = $this->input->post(null, true);
			$id_penjualan = $this->Penjualan_model->tambahPenjualan($post); // tampung insert_id
			$keranjang = $this->Penjualan_model->getKeranjang()->result();
			$row = [];
			foreach ($keranjang as $k => $value) {
				array_push($row, [
					'id_penjualan' => $id_penjualan,
					'id_item' => $value->id_item,
					'harga' => $value->harga,
					'qty' => $value->qty,
					'diskon_item' => $value->diskon_item,
					'total' => $value->total,
				]);
			}
			// tambahkan data ke tabel detail_transaksi_penjualan
			$this->Penjualan_model->tambahDetailPenjualan($row);
			// hapus tabel keranjang berdasarkan id_user (kasir)
			$this->Penjualan_model->hapus_item_keranjang(['id_user' => $this->fungsi->user_login()->id_user]);

			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true, 'id_penjualan' => $id_penjualan];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}

	}

	public function keranjang_data() {
		$keranjang = $this->Penjualan_model->getKeranjang();
		$data['keranjang'] = $keranjang;
		$this->load->view('transaksi/penjualan/keranjang_data', $data);
	}

	// hapus item keranjang
	public function hapus_keranjang() {
		if (isset($_POST['batal_pembayaran'])) {
			$this->Penjualan_model->hapus_item_keranjang(['id_user' => $this->session->userdata('id_user')]);
		} else {
			$id_keranjang = $this->input->post('idkeranjang', true);
			$this->Penjualan_model->hapus_item_keranjang(['id_keranjang' => $id_keranjang]);
		}

		if ($this->db->affected_rows() > 0) {
			$params = ['success' => true];
		} else {
			$params = ['success' => false];
		}
		echo json_encode($params);
	}

	// cetak invoice
	public function cetak($id) {
		$data = [
			'penjualan' => $this->Penjualan_model->getPenjualan($id)->row(),
			'items' => $this->Penjualan_model->getDetailPenjualan($id)->result(),
		];
		$this->load->view('transaksi/penjualan/print_invoice', $data);
	}

}

/* End of file Penjualan.php */
/* Location: ./application/controllers/Penjualan.php */
