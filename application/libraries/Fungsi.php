<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fungsi {
	protected $ci;

	public function __construct() {
		$this->ci = &get_instance();
	}

	public function user_login() {
		// load model user
		$this->ci->load->model('User_model');
		$username = $this->ci->session->userdata('username');
		$data = $this->ci->User_model->getUser($username)->row();
		return $data;

	}

}

/* End of file Fungsi.php */
/* Location: ./application/libraries/Fungsi.php */
