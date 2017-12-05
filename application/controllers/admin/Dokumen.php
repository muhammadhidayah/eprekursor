<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct() {
		parent::__construct();


		$this->load->model('Dokumen_model');
	}

	public function index() {
		$data['dokumen'] = $this->Dokumen_model->getAllDokumen();
		$data['breadcrumb'] = '<li class="active">Dokumen</li>';
		$this->template->load('layout/static', 'admin/dokumen', $data);
	}

	public function updatestatus($id_dokumen, $status) {
		$data = array('status_perrekomendasi' => $status);

		$this->Dokumen_model->updateDokumen($id_dokumen, $data);

		$this->session->set_flashdata('sukses', 'Status Laporan Berhasil di Perbarui');

		if($statu == "Diterima"){
			redirect(site_url('admin/dokumen/diterima'));
		} else {
			redirect(site_url('admin/dokumen/ditolak'));
		}
	}

	public function disetujui() {
		$data['dokumen'] = $this->Dokumen_model->getAllDokumenByStatus("Diterima");
		$data['breadcrumb'] = '<li>Dokumen</li><li class="active">Disetujui</li>';
		$this->template->load('layout/static', 'admin/dokumen', $data);	
	}

	public function ditolak() {
		$data['dokumen'] = $this->Dokumen_model->getAllDokumenByStatus("Ditolak");
		$data['breadcrumb'] = '<li>Dokumen</li><li class="active">Ditolak</li>';
		$this->template->load('layout/static', 'admin/dokumen', $data);
	}

	public function daftarmenunggu() {
		$data['dokumen'] = $this->Dokumen_model->getAllDokumenByStatus("menunggu");
		$data['breadcrumb'] = '<li>Dokumen</li><li class="active">Menunggu</li>';
		$this->template->load('layout/static', 'admin/dokumen', $data);	
	}

	public function detaildokumen($id_dokumen) {

		$data = $this->Dokumen_model->getDokumenById($id_dokumen);

		echo json_encode($data);
	}


	public function download($id_dokumen) {
		$data = $this->Dokumen_model->getDokumenById($id_dokumen);

		force_download('assets/doc/upload/laporan/'.$data->berkas_perrekomendasi, NULL);
	}



}