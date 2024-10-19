<?php


class Data_regularcheck_model extends CI_Model{ 

  function GetKeljasa($kode = "")
  {
    $this->db->where('kode',$kode);
    return $this->db->get("glbm_product")->result();
  }
  
  function Getregularcheck($kode = "")
  {
    $this->db->where('kode',$kode);
    return $this->db->get("glbm_regularchecklist")->result();
  }

  function GetJasa($nomor = "", $model= ""){
		$this->db->where('kode',$nomor);
		$this->db->where('kodeproduct',$model);
		return $this->db->get("cari_jasa")->result();
  }
  
  function GetParts($kode = "")
  {
    $this->db->where('kode',$kode);
    return $this->db->get("glbm_parts")->result();
  }

  function Getdetail($kode = "", $koderegular = "")
  {
    $this->db->where('kode_model',$kode);
    $this->db->where('kode_regularcheck',$koderegular);
    return $this->db->get("cari_detaildataregularcheck")->result();
  }

  function SaveData($data = "")
  {
    return $this->db->insert('glbm_dataregularcheck', $data);
  }

  function DeleteRegular($koderegular ="" , $kodekeljasa ="")
  {
    $this->db->where('kode_regularcheck', $koderegular);
    $this->db->where('kode_model', $kodekeljasa);
    return $this->db->delete('glbm_dataregularcheck');
	}



}

?>