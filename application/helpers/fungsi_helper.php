<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function cek_sudah_login() {
	$ci = &get_instance();
	$user_session = $ci->session->userdata('username');
	// jika ada session
	if ($user_session) {
		redirect('dashboard');
	}
}

function cek_belum_login() {
	$ci = &get_instance();
	$user_session = $ci->session->userdata('username');
	// jika ada session
	if (!$user_session) {
		redirect('auth');
	}
}

function check_admin() {
	$ci = &get_instance();
	// load library Fungsi
	$ci->load->library('Fungsi');
	$row = $ci->fungsi->user_login();
	// jika user yang login bukan admin
	if ($row->level != 1) {
		$ci->session->set_flashdata('pesan', '<div class="alert alert-danger">
			Tidak boleh diakses! </div>');
		redirect('dashboard');
	}
}

function rupiah($nomimal) {
	$result = "Rp " . number_format($nomimal, 2, '.', ',');
	return $result;
}

/* End of file fungsi_helper.php */
/* Location: ./application/helpers/fungsi_helper.php */
