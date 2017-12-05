<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') != TRUE && ($this->session->userdata('id_jenis_user') != 1 || $this->session->userdata('id_jenis_user') != 2)) {

			$this->session->set_flashdata('msg', 'Anda Harus Login Sebagai Admin/Kepala Subid');

			redirect(site_url('auth'));

		}

		$this->load->model('Perusahaan_model');
		$this->load->model('Provinsi_model');
		$this->load->model('User_model');
	}

	public function index() {
		$data['perusahaan'] = $this->Perusahaan_model->getAllPerusahaan();
		$data['breadcrumb'] = '<li class="active">Perusahaan</li>';
		$this->template->load('layout/static', 'admin/perusahaan', $data);
	}

	public function tambah() {

		$data['provinsi'] = $this->Provinsi_model->getAllProvinsi();
		$data['breadcrumb'] = '<li>Perusahaan</li><li class="active">Tambah Perusahaan</li>';
		$this->template->load('layout/static', 'admin/tambah', $data);
	}

	public function tambahPerusahaan() {

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
			$this->tambah();
		} else {

			$datalogin = array('username_login' => $this->input->post('username_login'),
							   'password_login'	=> $this->input->post('password_login'),
							   'id_jenis_user'	=> $this->input->post('jenis_user'),
							   'status_user'	=> 'aktif');

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

			$this->session->set_flashdata('sukses', 'Perusahaan Berhasil di Daftarkan!');
			redirect(site_url('admin/perusahaan'));
		}
	}

	public function cabang($id_perusahaan) {
		$data['cabang'] = $this->Perusahaan_model->getCabangPerusahaanById($id_perusahaan);
		$data['breadcrumb'] = '<li>Perusahaan</li><li class="active">Cabang Perusahaan</li>';
		$this->template->load('layout/static', 'admin/cabangperusahaan', $data);
	}

	public function editcabang($id_perusahaan) {
		$data['cabang'] = $this->Perusahaan_model->getCabangById($id_perusahaan);
		$data['breadcrumb'] = '<li>Perusahaan</li><li class="active">Cabang Perusahaan</li>';
		$this->template->load('layout/static', 'admin/editcabang', $data);
	}

	public function edit($id_perusahaan) {
		$data['perusahaan'] = $this->Perusahaan_model->getPerusahaanById($id_perusahaan);
		$data['provinsi'] = $this->Provinsi_model->getAllProvinsi();
		$data['breadcrumb'] = '<li class="active">Perusahaan</li>';
		$this->template->load('layout/static', 'admin/editperusahaan', $data);
	}

	public function editperusahaan() {
		$id_perusahaan = $this->input->post('id_perusahaan');
		$perusahaan = $data['perusahaan'] = $this->Perusahaan_model->getPerusahaanById($id_perusahaan);
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

		if($this->input->post('username_login') != $perusahaan->username_login) {
			$this->form_validation->set_rules('username_login', 'Username', 'required|
																			is_unique[tbl_login.username_login]', 
									array('required' => 'Username Harus di Isi',
										  'is_unique'=> 'Username Sudah Terdaftar, Mohon Gunakan Username Yang Lain'));
		}

		if($this->form_validation->run() === FALSE) {
			$id_perusahaan = $this->input->post('id_perusahaan');
			$this->edit($id_perusahaan);
		} else {

			if($this->input->post('password_login') == "") {
				$datalogin = array('username_login' => $this->input->post('username_login'));
			} else {
				$datalogin = array('username_login' => $this->input->post('username_login'),
								   'password_login'	=> $this->input->post('password_login'));
			}

			$this->User_model->updateUserLogin($perusahaan->id_user, $datalogin);

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
								);

			$this->Perusahaan_model->updatePerusahaan($id_perusahaan,$dataperusahaan);
			$this->session->set_flashdata('sukses', 'Data Perusahaan Berhasil di Perbarui!');

			redirect(site_url('admin/perusahaan'));

		}

	}

	public function deleteperusahaan($id_perusahaan) {
		$this->Perusahaan_model->deletePerusahaan($id_perusahaan);

		$this->session->set_flashdata('sukses', 'Data Perusahaan Berhasil di Hapus');

		redirect(site_url('admin/perusahaan'));
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

			$data = array('id_cabperusahaan' 		=> $this->input->post('id_cabperusahaan'),
						  'nama_cabperusahaan'		=> $this->input->post('nama_cabperusahaan'),
						  'alamat_cabperusahaan'	=> $this->input->post('alamat_cabperusahaan'),
						  'nomor_telp_cabperusahaan'=> $this->input->post('nomor_telp_cabperusahaan'));

			$this->Perusahaan_model->editCabangPerusahaan($this->input->post('id_cabperusahaan'));

			$this->session->set_flashdata('sukses', 'Cabang Perusahaan Berhasil di Perbarui');

			redirect(site_url('admin/perusahaan'));

		}

	}

	public function confirm() {
		$data['perusahaan'] = $this->User_model->getUserByStatus("menunggu");
		$data['breadcrumb'] = '<li class="active">Perusahaan</li>';
		$this->template->load('layout/static', 'admin/confirm', $data);
	}

	public function doconfirm($id_user, $id_perusahaan, $status) {

		$data = array('status_user' => $status);

		if ($status == "hapus") {
			$this->Perusahaan_model->deletePerusahaan($id_perusahaan);
			$this->User_model->deleteUserLogin($id_user);

			$this->session->set_flashdata('sukses', 'Perusahaan Berhasil di Delete');
		}

		$this->User_model->updateUserLogin($id_user, $data);


		$this->session->set_flashdata('sukses', 'Perusahaan Berhasil Aktifkan');

		redirect(site_url('admin/perusahaan'));
	}

	

}