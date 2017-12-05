<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {

		parent::__construct();

		if($this->session->userdata('logged_in') != TRUE && ($this->session->userdata('id_jenis_user') != 3 || $this->session->userdata('id_jenis_user') != 4)) {

			$this->session->set_flashdata('msg', 'Anda Harus Login Sebagai Importir/Exportir');

			redirect(site_url('auth'));

		}
	}

	public function index() {
		$data['breadcrumb'] = '<li class="active">Dashboard</li>';
		$this->template->load('layout/static', 'user/dashboard', $data);
	}
}