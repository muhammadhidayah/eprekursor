<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	public function insertUser($data) {
		$this->db->insert('tbl_login', $data);

		if($this->db->affected_rows() > 0) {
			$id_user = $this->db->insert_id();

			return $id_user;

		} else {
			return "";
		}
	}

	public function doLogin($username, $password) {
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('username_login', $username);
		$this->db->where('password_login', $password);

		$result = $this->db->get();

		return $result->result();
	}

	public function getUserPegawaiByUser($id_user) {
		$this->db->select('*');
		$this->db->from('tbl_pegawai');
		$this->db->where('id_user', $id_user);

		$result = $this->db->get();

		return $result->row();
	}

	public function getPerusahaanByUser($id_user) {
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->join('tbl_perusahaan', 'tbl_login.id_user = tbl_perusahaan.id_user');
		$this->db->where('tbl_login.id_user', $id_user);


		$result = $this->db->get();

		return $result->row();
	}

	public function updateUserLogin($id_user, $data) {
		$this->db->where('id_user', $id_user);
		$this->db->update('tbl_login', $data);

		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
 
	public function getUserByStatus($status) {
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->join('tbl_perusahaan', 'tbl_login.id_user = tbl_perusahaan.id_user');
		$this->db->join('tbl_jenis_user', 'tbl_jenis_user.id_jenis_user = tbl_login.id_jenis_user');
		$this->db->where('status_user', $status);


		$result = $this->db->get();

		return $result->result();
	}

	public function deleteUserLogin($id_user) {
		$this->db->where('id_user', $id_user);
		$this->db->delete('tbl_login');

		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}