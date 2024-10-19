<?php


class Otorisasi_discount_model extends CI_Model{
  
  private $_table = "stpm_grupdiscount";

  public function get($kode = "", $module = "")
  {
    $this->db->where('grup',$kode);
    $this->db->where('module', $module);
    return $this->db->get($this->_table)->result();
  }

  function GetOD($_module = "", $grup= ""){
    $this->db->where('module',$_module);
		$this->db->where('grup',$grup);
		return $this->db->get("stpm_grupdiscount")->result();
	}

  function Carigrupdetail($nomor = "")
  {
    $this->db->where('kode',$nomor);
    return $this->db->get("stpm_grup")->result();
  }

  function CariODetail($kode = "")
  {
    $this->db->where('kode',$kode);
    return $this->db->get("stpm_grupdiscount")->result();
  }

  function SaveData($data = "")
  {
    return $this->db->insert('stpm_grupdiscount', $data);
  }

  public function update($data = "", $module = "", $kode = "")
  {
    $this->db->trans_start(); # Starting Transaction
    $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

    $this->db->where('module', $module);
    $this->db->where('grup', $kode);
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