<?php


class Jasadetail_model extends CI_Model{ 

  function GetJasaHead($kode = "")
  {
    $this->db->where('kode',$kode);
    return $this->db->get("glbm_jasa")->result();
  }
  
  function GetJasaDetail($kode = "")
  {
    return $this->db->query("SELECT * FROM glbm_jasadetail where kode_jasa = '" . $kode . "'")->result();
  }
  
  function Getdetail($kode = "")
  {
    return $this->db->query("SELECT * FROM glbm_jasadetail where kode_jasahead = '" . $kode . "'")->result();
  }

  function DeleteJasa($jasaheadkode ="")
  {
		$this->db->where('kode_jasahead', $jasaheadkode);
    return $this->db->delete('glbm_jasadetail');
	}

  function SaveData($data = "")
  {
    return $this->db->insert('glbm_jasadetail', $data);
  }

}

?>