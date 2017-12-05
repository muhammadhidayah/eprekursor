<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi_model extends CI_Model{

	public function getAllProvinsi() {
		$this->db->select('*');
		$this->db->from('tbl_provinsi');

		$result = $this->db->get();

		return $result->result();
	}

}