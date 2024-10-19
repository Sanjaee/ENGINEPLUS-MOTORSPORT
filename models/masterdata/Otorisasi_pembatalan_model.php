<?php


class Otorisasi_pembatalan_model extends CI_Model{
  
  private $_table = "stpm_otorisasipembatalan";

  public function get($kodegrup = "", $nama_menu = "")
  {
    $this->db->where('grup',$kodegrup);
    $this->db->where('nama_menu',$nama_menu);
    return $this->db->get($this->_table)->result();
  }

  function GetGrup($kode_grup= ""){
		$this->db->where('kode',$kode_grup);
		return $this->db->get("stpm_grup")->result();
	}

  function Carigrupdetail($nomor = "")
  {
    $this->db->where('kode',$nomor);
    return $this->db->get("stpm_grup")->result();
  }

  function CariMenuDetail($menu = "")
  {
    $this->db->where('menu',$menu);
    return $this->db->get("stpm_menu")->result();
  }

  function SaveData($data = "")
  {
    return $this->db->insert('stpm_otorisasipembatalan', $data);
  }

  public function update($data = "", $kodegrup = "", $nama_menu = "")
  {
    $this->db->trans_start(); # Starting Transaction
    $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

    $this->db->where('grup', $kodegrup);
    $this->db->where('nama_menu', $nama_menu);
    $result = $this->db->update($this->_table, $data);

    $this->db->trans_complete();
    
    if ($this->db->trans_status() === FALSE) {
      # Something went wrong.
      $this->db->trans_rollback();
      return FALSE;
    } 
    else {
      # Everything is Perfect. 
      # Committing data to the database.
      $this->db->trans_commit();
      return $result;
    }
  }

  function DeleteMenu($kode ="")
  {
		$this->db->where('grup', $kode);
    return $this->db->delete('stpm_menu');
	}



}

?>