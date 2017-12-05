<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('logged_in') != TRUE && ($this->session->userdata('id_jenis_user') != 3 || $this->session->userdata('id_jenis_user') != 4)) {

			$this->session->set_flashdata('msg', 'Anda Harus Login Sebagai Importir/Exportir');

			redirect(site_url('auth'));

		}

		$this->load->model('Dokumen_model');

	}

	public function index() {
		$id_perusahaan = $this->session->userdata('id_perusahaan');
		$dokumen = $this->Dokumen_model->getDokumenByPerusahaan($id_perusahaan);

		if(count($dokumen) > 0) {

			if($dokumen[0]->status_perrekomendasi == "menunggu" || 
				$dokumen[0]->status_perrekomendasi == "Diterima") {
				echo "<script>
						alert('Anda Sudah Melakukan Upload Dokumen');
						window.location.href='".site_url('user/dashboard')."';
					  </script>";
			}

		}

		$data['breadcrumb'] = '<li class="active">Dokumen</li>';
		$this->template->load('layout/static', 'user/dokumen', $data);
	}

	public function insertlaporan() {
		$this->form_validation->set_rules('negara_asal', 'Negara Asal', 'required', array('required' => 'Negara Asal Harus di Isi'));

		$this->form_validation->set_rules('negara_tujuan', 'Negara Tujuan', 'required', array('required' => 'Negara Tujuam Harus di Isi'));

		$this->form_validation->set_rules('nama_perusahaan_asal', 'Nama Perusahaan Asal Prekursor', 'required', array('required' => 'Nama Perusahaan Asal Harus di Isi'));

		$this->form_validation->set_rules('pelabuhan_tujuan', 'Pelabuhan Tujuan', 'required', array('required' => 'Pelabuhan Tujuan Harus di Isi'));

		$this->form_validation->set_rules('jumlah_berat', 'Jumlah Berat', 'required|numeric', array('required' => 'Berat Massa Harus di Isi', 'numeric' => 'Berat Massa Harus di Isi dengan Angka dengan satuan Kg'));

		if($this->form_validation->run() === FALSE)	 {
			$this->index();
		}	else {
			
			$config['upload_path'] = './assets/doc/upload/laporan';
			$config['allowed_types'] = 'pdf|docx|doc';
			$config['max_size'] = '50000';

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('berkas_perrekomendasi')) {
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				print_r($this->upload->display_errors());
			} else {
				$upload_data = array('uploads' => $this->upload->data());

				$data = array('jenis_prekursor' 		=> $this->input->post('jenis_prekursor'),
							  'negara_asal' 			=> $this->input->post('negara_asal'),
							  'negara_tujuan' 			=> $this->input->post('negara_tujuan'),
							  'id_perusahaan' 			=> $this->session->userdata('id_perusahaan'),
							  'pelabuhan_tujuan' 		=> $this->input->post('pelabuhan_tujuan'),
							  'jumlah_berat' 			=> $this->input->post('jumlah_berat'),
							  'berkas_perrekomendasi' 	=> $upload_data['uploads']['file_name'],
							  'status_perrekomendasi' 	=> 'menunggu',
							  'nama_perusahaan_asal' 	=> $this->input->post('nama_perusahaan_asal'),
							  'tanggalberkasupload' 	=> date("Y:m:d"));

				$this->Dokumen_model->insertDokumen($data);

				$this->kirimEmailToAdmin($upload_data['uploads']['file_name']);

				echo "<script>
						alert('Anda Berhasil Upload Dokumen');
						window.location.href='".site_url('user/dashboard')."';
					  </script>";

			}

		}
	}

	public function kirimEmailToAdmin($nama_file) {
		$config = Array(  
		    'protocol' => 'smtp',  
		    'smtp_host' => 'ssl://smtp.googlemail.com',  
		    'smtp_port' => 465,  
		    'smtp_user' => 'masukkanemailnyadisini',   
		    'smtp_pass' => 'masukkanpassworddisini',   
		    'mailtype' => 'html',   
		    'charset' => 'iso-8859-1'  
	   	);

	   	$berkas = $_SERVER["DOCUMENT_ROOT"].'/eprekursor/assets/doc/upload/laporan/'.$nama_file;


	   	$pesan = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Demystifying Email Design</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head><body><div style="font-family:"San Francisco",Arial,Helvetica,san-serif,serif;font-size:14px;margin:0;box-sizing:border-box;color:black"><div class="adM">
</div><table style="width:100%;height:100%;max-width:650px;border-spacing:0;border-collapse:collapse;margin:0 auto;background:#f2f2f2" align="center"><tbody><tr><td style="padding:20px"><table style="width:100%;height:100%;max-width:600px;border-spacing:0;border-collapse:collapse;border:1px solid #e6e7eb;margin:0 auto" align="center"><tbody>
 
 <tr><td><table width="100%" align="center" style="border-spacing:0;border-collapse:collapse;width:100%"><thead><tr bgcolor="#F9AE3C"><th width="90%"><h2 style="margin:0;padding:20px;text-align:left; color: #fff">E-PREKURSOR</h2></th><th width="10%"><h2 style="padding:20px;margin:0;box-sizing:border-box"></h2></th></tr></thead></table></td></tr>
<tr bgcolor="white"><td style="padding:20px 20px 10px"><table style="border-spacing:0;border-collapse:collapse;width:100%"><tbody><tr><td><span style="font-size:17px"> Hi <span style="font-weight:700">Admin,</span></span></td></tr><tr><td><p style="color:#636363">Perusahaan '.$this->session->userdata("nama").' telah melakukan upload dokumen, mohon untuk melakukan review. <br />untuk melakukan tindakan selanjutnya</p></td></tr><tr><td></td></tr></tbody></table></td></tr>

<tr bgcolor="#E8E8E8"><td style="padding:0 20px"><h2 style="text-align:center;margin:0;padding:10px 0 3px 0"><img src="https://seeklogo.com/images/B/badan-narkotika-nasional-logo-DBE5C40622-seeklogo.com.png" width="100px" height="90px" alt="Badan Narkotika Nasional" class="CToWUd"></h2><p style="font-size:11px;color:#999;text-align:center;padding:5px 0">Badan Narkotika Nasional 2017</p><h2 style="margin:0;text-align:center;padding:8px 0 18px 0"></h2></td></tr></tbody></table><div class="yj6qo"></div><div class="adL"></div></div></body></html>';

		$this->load->library('email', $config);  
		$this->email->set_newline("\r\n");  
		$this->email->from('masukkanemailandadisini', 'Admin Re:Code');   
		$this->email->to('masukkanemailtujuan');   
		$this->email->subject('Percobaan email');   
		$this->email->message($pesan);
		$this->email->attach($berkas);
	   
	   if (!$this->email->send()) {  
	    show_error($this->email->print_debugger());   
	   } else {  
	    return true;   
	   }
	}

}