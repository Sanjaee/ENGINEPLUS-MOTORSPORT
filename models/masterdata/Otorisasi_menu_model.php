<?php


class Otorisasi_menu_model extends CI_Model{ 

  function CariMenuDetail($menu = "")
  {
    $this->db->where('menu',$menu);
    return $this->db->get("stpm_menu")->result();
  }
  
  function Carigrupdetail($nomor = "")
  {
    $this->db->where('kode',$nomor);
    return $this->db->get("stpm_grup")->result();
  }
  
  function Getdetail($kode = "")
  {
    $this->db->where('grup',$kode);
    return $this->db->get("stpm_menu")->result();
  }

  function SaveData($data = "")
  {
    return $this->db->insert('stpm_menu', $data);
  }

  function DeleteMenu($kode ="")
  {
		$this->db->where('grup', $kode);
    return $this->db->delete('stpm_menu');
	}



}

?>