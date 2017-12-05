<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') != TRUE && ($this->session->userdata('id_jenis_user') != 1 || $this->session->userdata('id_jenis_user') != 2)) {

			$this->session->set_flashdata('msg', 'Anda Harus Login Sebagai Admin/Kepala Subid');

			redirect(site_url('auth'));

		}
	}

	public function index() {
		$this->load->model('Perusahaan_model');
		$this->load->model('Dokumen_model');
		$this->load->model('User_model');

		$data['perusahaan'] = $this->Perusahaan_model->getAllPerusahaan();
		$data['dokumen']	= $this->Dokumen_model->getAllDokumen();
		$data['dokumenacc']	= $this->Dokumen_model->getAllDokumenByStatus("Diterima");
		$data['dokumenrej']	= $this->Dokumen_model->getAllDokumenByStatus("Ditolak");
		$data['breadcrumb'] = '<li class="active">Dashboard</li>';
		$this->template->load('layout/static', 'admin/dashboard', $data);
	}

}