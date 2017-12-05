<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	public function insertDokumen($data) {
		$this->db->insert('tbl_perrekomendasi', $data);

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	public function getAllDokumen() {
		$this->db->select('tbl_perrekomendasi.*, tbl_perusahaan.nama_perusahaan');
		$this->db->from('tbl_perrekomendasi');
		$this->db->join('tbl_perusahaan', 'tbl_perrekomendasi.id_perusahaan = tbl_perusahaan.id_perusahaan');

		$result = $this->db->get();

		return $result->result();
	}

	public function getDokumenById($id_dokumen) {
		$this->db->select('*');
		$this->db->from('tbl_perrekomendasi');
		$this->db->join('tbl_perusahaan','tbl_perusahaan.id_perusahaan = tbl_perrekomendasi.id_perusahaan');
		$this->db->where('id_perrekomendasi', $id_dokumen);

		$result = $this->db->get();

		return $result->row();

	}

	public function updateDokumen($id_dokumen,$data) {
		$this->db->where('id_perrekomendasi', $id_dokumen);
		$this->db->update('tbl_perrekomendasi', $data);

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	}

	public function getDokumenByPerusahaan($id_perusahaan) {
		$this->db->select('*');
		$this->db->from('tbl_perrekomendasi');
		$this->db->where('id_perusahaan', $id_perusahaan);
		$this->db->order_by('id_perrekomendasi', 'desc');

		$result = $this->db->get();

		return $result->result();
	}

	public function getAllDokumenByStatus($status) {
		$this->db->select('*');
		$this->db->from('tbl_perrekomendasi');
		$this->db->join('tbl_perusahaan', 'tbl_perrekomendasi.id_perusahaan = tbl_perusahaan.id_perusahaan');
		$this->db->where('status_perrekomendasi', $status);

		$result = $this->db->get();

		return $result->result();
	}

}