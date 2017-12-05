<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_model extends CI_Model {

	public function insertPerusahaan($data) {

		$this->db->insert('tbl_perusahaan', $data);

		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function insertCabangPerusahaan($data) {

		$this->db->insert('tbl_cabperusahaan', $data);

		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}

	}


	public function getAllPerusahaan() {
		$this->db->select('tbl_perusahaan.*, tbl_jenis_user.jenis_user');
		$this->db->from('tbl_perusahaan');
		$this->db->join('tbl_login', 'tbl_login.id_user = tbl_perusahaan.id_user');
		$this->db->join('tbl_jenis_user', 'tbl_login.id_jenis_user = tbl_jenis_user.id_jenis_user');

		$result = $this->db->get();

		return $result->result();
	}

	public function getCabangPerusahaanById($id_perusahaan) {
		$this->db->select('*');
		$this->db->from('tbl_perusahaan');
		$this->db->join('tbl_cabperusahaan', 'tbl_cabperusahaan.id_perusahaan = tbl_perusahaan.id_perusahaan');
		$this->db->where('tbl_perusahaan.id_perusahaan', $id_perusahaan);

		$result = $this->db->get();

		return $result->result();
	}

	public function getCabangById($id_cabperusahaan) {
		$this->db->select('*');
		$this->db->from('tbl_cabperusahaan');
		$this->db->where('id_cabperusahaan', $id_cabperusahaan);

		$result = $this->db->get();

		return $result->row();
	}

	public function getPerusahaanById($id_perusahaan) {
		$this->db->select('*');
		$this->db->from('tbl_perusahaan');
		$this->db->join('tbl_login', 'tbl_perusahaan.id_user = tbl_login.id_user');
		$this->db->where('id_perusahaan', $id_perusahaan);


		$result = $this->db->get();

		return $result->row();
	}

	public function updatePerusahaan($id_perusahaan, $data) {
		$this->db->where('id_perusahaan', $id_perusahaan);
		$this->db->update('tbl_perusahaan', $data);

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	public function deletePerusahaan($id_perusahaan) {
		$this->db->where('id_perusahaan', $id_perusahaan);
		$this->db->delete('tbl_perusahaan');

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}


	public function editCabangPerusahaan($id_cabperusahaan,$data) {
		$this->db->where('id_cabperusahaan', $id_cabperusahaan);
		$this->db->update('tbl_cabperusahaan', $data);

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	public function hapusCabang($id_cabperusahaan) {
		$this->db->where('id_cabperusahaan', $id_cabperusahaan);
		$this->db->delete('tbl_cabperusahaan');

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

}