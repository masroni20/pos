<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {

	public function no_invoice() {
		$sql = "SELECT MAX(MID(invoice,9,4)) AS no_invoice
		FROM penjualan
		WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n = ((int) $row->no_invoice) + 1;
			$no = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$invoice = "AT" . date('ymd') . $no;
		return $invoice;
	}

	public function getKeranjang($params = null) {
		$this->db->select('*, item.nama_item as item_produk, keranjang.harga as keranjang_harga');
		$this->db->from('keranjang');
		$this->db->join('item', 'item.id_item = keranjang.id_item');
		if ($params != null) {
			$this->db->where($params);
		}
		// sesuaikan dengan id user yang login
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query;
	}

	public function tambahKeranjang($post) {
		// $sql = "SELECT MAX(id_keranjang) AS no_keranjang FROM keranjang";
		$query = $this->db->query("SELECT MAX(id_keranjang) AS no_keranjang FROM keranjang");

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$no_ker = ((int) $row->no_keranjang) + 1;
		} else {
			$no_ker = "1";
		}

		$data = [
			'id_keranjang' => $no_ker,
			'id_item' => $post['id_item'],
			'harga' => $post['harga'],
			'qty' => $post['qty'],
			'diskon_item' => 0,
			'total' => $post['harga'] * $post['qty'],
			'id_user' => $this->session->userdata('id_user'),
		];

		$this->db->insert('keranjang', $data);
	}

	public function updateKeranjang($post) {
		$data = [
			'harga' => $post['harga'],
			'qty' => $post['qty'],
			'diskon_item' => $post['diskon'],
			'total' => $post['total'],
		];
		$this->db->where('id_keranjang', $post['idkeranjang']);
		$this->db->update('keranjang', $data);
	}

	public function updateKeranjangQty($post) {
		$id_item = $post['id_item'];
		$harga = $post['harga'];
		$qty = $post['qty'];

		$sql = "UPDATE keranjang SET harga = '$harga',
		qty = qty + '$qty',
		total = '$harga' * qty
		WHERE id_item = '$id_item'";
		$this->db->query($sql);
	}

	public function hapus_item_keranjang($params = null) {
		if ($params != null) {
			$this->db->where($params);
		}

		$this->db->delete('keranjang');
	}

	public function tambahPenjualan($post) {
		$data = [
			'invoice' => $this->no_invoice(),
			'id_customer' => $post['id_pelanggan'] == '' ? 0 : $post['id_pelanggan'],
			'total_harga' => $post['subtotal'],
			'diskon' => $post['diskon'],
			'total_akhir' => $post['grandtotal'],
			'cash' => $post['cash'],
			'kembalian' => $post['kembalian'],
			'catatan' => $post['catatan'],
			'tanggal' => $post['tanggal'],
			'id_user' => $this->fungsi->user_login()->id_user,
			'created' => time(),
		];
		$this->db->insert('penjualan', $data);
		return $this->db->insert_id();
	}

	public function tambahDetailPenjualan($params) {
		$this->db->insert_batch('detail_transaksi_penjualan', $params);
	}

	public function getPenjualan($id = null) {
		$this->db->select('*,penjualan.created as created, penjualan.updated as updated');
		$this->db->from('penjualan');
		$this->db->join('user', 'user.id_user = penjualan.id_user');
		$this->db->join('customer', 'customer.id_customer = penjualan.id_customer', 'left');
		if ($id != null) {
			$this->db->where('id_penjualan', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function getDetailPenjualan($id_penjualan = null) {
		$this->db->from('detail_transaksi_penjualan');
		$this->db->join('item', 'item.id_item = detail_transaksi_penjualan.id_item');
		if ($id_penjualan != null) {
			$this->db->where('id_penjualan', $id_penjualan);
		}
		$query = $this->db->get();
		return $query;
	}

}

/* End of file Penjualan_model.php */
/* Location: ./application/models/Penjualan_model.php */
