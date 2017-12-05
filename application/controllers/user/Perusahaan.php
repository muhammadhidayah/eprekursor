<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') != TRUE && ($this->session->userdata('id_jenis_user') != 3 || $this->session->userdata('id_jenis_user') != 4)) {

			$this->session->set_flashdata('msg', 'Anda Harus Login Sebagai Importir/Exportir');

			redirect(site_url('auth'));

		}

		$this->load->model('Perusahaan_model');
	}

	public function index() {
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$data['cabang'] = $this->Perusahaan_model->getCabangPerusahaanById($id_perusahaan);
		$data['breadcrumb'] = '<li>Perusahaan</li><li class="active">Cabang Perusahaan</li>';
		$this->template->load('layout/static', 'user/cabangperusahaan', $data);
	}

	public function tambahcabang() {
		$data['breadcrumb'] = '<li>Perusahaan</li><li class="active">Cabang Perusahaan</li>';
		$this->template->load('layout/static', 'user/tambahcabang', $data);
	}

	public function tambah() {
		$this->form_validation->set_rules('nama_cabperusahaan', 'Nama Cabang Perusahaan', 'required', 
									array('required' => 'Nama Cabang Harus di Isi'));

		$this->form_validation->set_rules('alamat_cabperusahaan', 'Alamat Cabang Perusahaan', 'required',
									array('required' => 'Alamat Cabang Perusahaan Harus di Isi'));

		$this->form_validation->set_rules('nomor_telp_cabperusahaan', 'Nomor Telepon Cabang Perusahaan', 
																	  'required|numeric|max_length[12]',
									array('required' 	=> 'Nomor Telepon Cabang Perusahaan Harus di Isi',
										  'numeric'	 	=> 'Nomor Telepon Harus Berupa Angka',
										  'max_length'	=> 'Nomor Telepon Perusahaan Lebih Dari 12 digit'));

		if($this->form_validation->run() === FALSE) {
			$this->tambahcabang();
		} else {

			$data = array('id_perusahaan'			=> $this->session->userdata('id_perusahaan'),
						  'nama_cabperusahaan'		=> $this->input->post('nama_cabperusahaan'),
						  'alamat_cabperusahaan'	=> $this->input->post('alamat_cabperusahaan'),
						  'nomor_telp_cabperusahaan'=> $this->input->post('nomor_telp_cabperusahaan'));

			$this->Perusahaan_model->insertCabangPerusahaan($data);

			$this->session->set_flashdata('sukses', 'Cabang Perusahaan Berhasil di Tambah');

			redirect(site_url('user/perusahaan'));

		}
	}

	public function editcabang($id_perusahaan) {
		$data['cabang'] = $this->Perusahaan_model->getCabangById($id_perusahaan);
		$data['breadcrumb'] = '<li>Perusahaan</li><li class="active">Cabang Perusahaan</li>';
		$this->template->load('layout/static', 'user/editcabang', $data);
	}

	public function simpancabang() {

		$this->form_validation->set_rules('nama_cabperusahaan', 'Nama Cabang Perusahaan', 'required', 
									array('required' => 'Nama Cabang Harus di Isi'));

		$this->form_validation->set_rules('alamat_cabperusahaan', 'Alamat Cabang Perusahaan', 'required',
									array('required' => 'Alamat Cabang Perusahaan Harus di Isi'));

		$this->form_validation->set_rules('nomor_telp_cabperusahaan', 'Nomor Telepon Cabang Perusahaan', 
																	  'required|numeric|max_length[12]',
									array('required' 	=> 'Nomor Telepon Cabang Perusahaan Harus di Isi',
										  'numeric'	 	=> 'Nomor Telepon Harus Berupa Angka',
										  'max_length'	=> 'Nomor Telepon Perusahaan Lebih Dari 12 digit'));

		if($this->form_validation->run() === FALSE) {
			$id_perusahaan = $this->input->post('id_cabperusahaan');
			$this->editcabang($id_perusahaan);
		} else {

			$data = array('nama_cabperusahaan'		=> $this->input->post('nama_cabperusahaan'),
						  'alamat_cabperusahaan'	=> $this->input->post('alamat_cabperusahaan'),
						  'nomor_telp_cabperusahaan'=> $this->input->post('nomor_telp_cabperusahaan'));

			$id_cabperusahaan = $this->input->post('id_cabperusahaan');

			$this->Perusahaan_model->editCabangPerusahaan($id_cabperusahaan, $data);

			$this->session->set_flashdata('sukses', 'Cabang Perusahaan Berhasil di Perbarui');

			redirect(site_url('user/perusahaan'));

		}
	}

	public function hapuscabang($id_cabperusahaan) {
		$this->Perusahaan_model->hapusCabang($id_cabperusahaan);

		$this->session->set_flashdata('sukses', 'Cabang Perusahaan Berhasil di Hapus');

		redirect(site_url('user/perusahaan'));
	}

}