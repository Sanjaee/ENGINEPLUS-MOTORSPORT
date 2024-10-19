<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_report_model extends CI_Model
{

	private $_table = "glbm_jenisreport";

	public function get($jenis = "")
	{
		$this->db->where('jenis', $jenis);
		return $this->db->get($this->_table)->result();
	}


	public function save($data = "")
	{
		return $this->db->insert('glbm_jenisreport', $data);
	}

	public function savetipe($kode = "", $jam = "", $userlogin = "")
	{
		return $this->db->query("INSERT INTO glbm_jasatipe SELECT '" . $kode . "', kode, '" . $jam . "',frt,frt * " . $jam . ",true, CURRENT_TIMESTAMP, '" . $userlogin . "' from glbm_product");
	}

	public function update($data = "", $id_jenis = "")
	{
		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$this->db->where('id', $id_jenis);
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
}
