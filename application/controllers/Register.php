<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Perusahaan_model');
		$this->load->model('Provinsi_model');
	}

	public function index() {
		$data['provinsi'] = $this->Provinsi_model->getAllProvinsi();
		$this->load->view('v_register', $data);
	}

	public function doRegister() {
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required', 
									array('required' => 'Nama Perusahaan Harus di Isi'));

		$this->form_validation->set_rules('bidang_usaha', 'Bidang Usaha', 'required', 
									array('required' => 'Bidang Usaha Harus di Isi'));

		$this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required', 
									array('required' => 'Jenis Barang Harus di Isi'));

		$this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required', 
									array('required' => 'Penanggung Jawab Harus di Isi'));

		$this->form_validation->set_rules('nomor_siup', 'Nomor SIUP', 'required|numeric', 
									array('required'	=> 'Nomor SIUP Harus di Isi', 
									  	  'numeric' 	=> 'Nomor SIUP Harus Berupa Angka'));

		$this->form_validation->set_rules('nomor_apiu', 'Nomor API Umum', 'required|numeric', 
									array('required' 	=> 'Nomor APIU Harus di Isi', 
										  'numeric' 	=> 'Nomor APIU Harus Berupa Angka'));

		$this->form_validation->set_rules('nomor_tdp', 'Nomor TDP', 'required|numeric', 
									array('required' => 'Nomor TDP Harus di Isi', 
										  'numeric' => 'Nomor TDP Harus Berupa Angka'));

		$this->form_validation->set_rules('nomor_npwp', 'Nomor NPWP', 'required|numeric', 
									array('required' => 'Nomor NPWP Harus di Isi', 
										  'numeric' => 'Nomor Pokok Wajib Pajak Harus Berupa Angka'));

		$this->form_validation->set_rules('alamat_perusahaan', 'Alamat Perusahaan', 'required', 
									array('required' => 'Alamat Perushaan Harus di Isi'));

		$this->form_validation->set_rules('kota_perusahaan', 'Kota Perusahaan', 'required', 
									array('required' => 'Kota Perusahaan Harus di Isi'));

		$this->form_validation->set_rules('kodepos_perusahaan', 'Kode Pos Perusahaan', 'required|numeric|exact_length[5]', 
									array('required' 	 => 'Kodepos Perusahaan Harus di Isi', 
										  'numeric' 	 => 'Kodepos Harus Berupa Angka', 
										  'exact_length' => 'Kodepos Yang di Masukkan Tidak Benar'));

		$this->form_validation->set_rules('email_perusahaan', 'Email Perushaan', 'required|valid_email', 
									array('required' 	=> 'E-mail Perusahaan Harus di Isi', 
										  'valid_email' => 'Masukkan E-mail yang valid'));

		$this->form_validation->set_rules('telepon_perusahaan', 'Nomor Telepon Perusahaan', 'required|numeric|max_length[12]', 
									array('required' 	=> 'Nomor Telepon Perusahaan Harus di Isi', 
										  'numeric' 	=> 'Nomor Telepon Harus Berupa Angka', 
										  'max_length' 	=> 'Nomor Telepon Lebih Dari 12 Digit'));

		$this->form_validation->set_rules('username_login', 'Username', 'required|is_unique[tbl_login.username_login]', 
									array('required' => 'Username Harus di Isi',
										  'is_unique'=> 'Username Sudah Terdaftar, Mohon Gunakan Username Yang Lain'));

		$this->form_validation->set_rules('password_login', 'Password Login', 'required', 
									array('required' => 'Password Harus di Isi'));

		if($this->form_validation->run() === FALSE) {
			$this->index();
		} else {

			$datalogin = array('username_login' => $this->input->post('username_login'),
							   'password_login'	=> $this->input->post('password_login'),
							   'id_jenis_user'	=> $this->input->post('jenis_user'),
							   'status_user'	=> 'menunggu');

			$id_user = $this->User_model->insertUser($datalogin);


			$dataperusahaan = array('nama_perusahaan' 	=> $this->input->post('nama_perusahaan'),
									'bidang_usaha'		=> $this->input->post('bidang_usaha'),
									'jenis_barang'		=> $this->input->post('jenis_barang'),
									'penanggung_jawab'	=> $this->input->post('penanggung_jawab'),
									'nomor_siup'		=> $this->input->post('nomor_siup'),
									'nomor_apiu'		=> $this->input->post('nomor_apiu'),
									'nomor_tdp'			=> $this->input->post('nomor_tdp'),
									'npwp'				=> $this->input->post('nomor_npwp'),
									'alamat_perusahaan'	=> $this->input->post('alamat_perusahaan'),
									'id_provinsi'		=> $this->input->post('provinsi_perusahaan'),
									'kota_perusahaan'	=> $this->input->post('kota_perusahaan'),
									'kode_pos_perusahaan'	=> $this->input->post('kodepos_perusahaan'),
									'email_perusahaan'	=> $this->input->post('email_perusahaan'),
									'telepon_perusahaan'=> $this->input->post('telepon_perusahaan'),
									'tanggal_daftar'	=> date("Y:m:d"),
									'id_user'			=> $id_user
								);

			$this->Perusahaan_model->insertPerusahaan($dataperusahaan);

			$this->session->set_flashdata('sukses', 'Anda Telah Berhasil Mendaftar. Mohon Menunggu Untuk Proses Review Dari Admin. Max 2x24 Jam ');

			redirect(site_url('register'));

		}
	}

}