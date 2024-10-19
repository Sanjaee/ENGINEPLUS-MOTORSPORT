<?php defined('BASEPATH') or exit('No direct script access allowed');

class Statuspekerjaanmobil_model extends CI_Model
{

	private $_table = "glbm_statuspekerjaanmobil";

	public function get($kode = "")
	{
		$this->db->where('kode', $kode);
		return $this->db->get($this->_table)->result();
	}


	public function save($data = "")
	{
		return $this->db->insert('glbm_statuspekerjaanmobil', $data);
	}

	public function update($data = "", $kode = "")
	{
		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$this->db->where('kode', $kode);
		$result = $this->db->update($this->_table, $data);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return FALSE;
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			return $result;
		}
	}


	public function last_statuspekerjaanmobil()
	{
		// PM0001
		return $this->db->query("SELECT kode FROM glbm_statuspekerjaanmobil ORDER BY kode DESC limit 1")->row();
	}
}
