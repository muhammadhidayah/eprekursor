<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User_model');

	}

	public function index() {
		if($this->session->userdata() != NULL) {
			switch ($this->session->userdata('id_jenis_user')) {
				case 1:
				case 2:
					redirect(site_url('admin/dashboard'));
				break;
				case 3:
				case 4:
					redirect(site_url('user/dashboard'));
				break;
			}
		}
		
		$this->signIn();
	}

	public function signIn() {
		$this->load->view('v_login');
	}

	public function doLogin() {
		$this->form_validation->set_rules('username', 'Username', 'required', array('required' => 'Username Harus di Isi'));

		$this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'Password Harus di Isi'));

		if($this->form_validation->run() === FALSE) {
			$this->signIn();
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$result = $this->User_model->doLogin($username, $password);

			if(count($result) < 1) {
				$this->session->set_flashdata('msg', 'Username dan Password Salah');
				redirect(site_url('auth/signIn'));
			}

			if($result[0]->status_user == "menunggu") {
				$this->session->set_flashdata('msg', 'Akun Anda Sedang Tahap Review. Mohon Menunggu');
				redirect(site_url('auth/signIn'));
			}

			$jenis_user = $result[0]->id_jenis_user;
			$data_session = array('id_user'  		=> $result[0]->id_user,
								  'username' 		=> $result[0]->username_login,
								  'logged_in'		=> TRUE,
								  'id_jenis_user'	=> $result[0]->id_jenis_user);

			$this->session->set_userdata($data_session);

			if($jenis_user == 1 || $jenis_user == 2) {

				$pegawai = $this->User_model->getUserPegawaiByUser($result[0]->id_user);

				$datapegawai = array('nama' 		=> $pegawai->nama_pegawai,
									 'nip'			=> $pegawai->nip);

				$this->session->set_userdata($datapegawai);

				redirect(site_url('admin/dashboard'));

			} else {
				$perusahaan = $this->User_model->getPerusahaanByUser($result[0]->id_user);

				$dataperusahaan = array('id_perusahaan' => $perusahaan->id_perusahaan,'nama' => $perusahaan->nama_perusahaan);

				$this->session->set_userdata($dataperusahaan);

				redirect(site_url('user/dashboard'));
			}

		}
	}

	public function logOut() {
		$this->session->sess_destroy();
    	$this->session->set_flashdata('msg', 'Anda Berhasil LogOut');
    	redirect(site_url('auth'));
	}
}
