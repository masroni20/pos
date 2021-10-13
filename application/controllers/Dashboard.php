<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index() {
		// jika belum login arahkan ke halaman login
		cek_belum_login();

		$this->load->model('User_model');
		$this->load->model('Item_model');
		$this->load->model('Supplier_model');
		$this->load->model('Customer_model');

		$data['title'] = 'Dashboard';
		$data['item'] = $this->Item_model->getItem();
		$data['supplier'] = $this->Supplier_model->getSupplier();
		$data['pelanggan'] = $this->Customer_model->getCustomer();
		$data['user'] = $this->User_model->getUser();

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
