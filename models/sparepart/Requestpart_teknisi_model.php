<?php


class Requestpart_teknisi_model extends CI_Model{ 

  function fetch_all_event(){
		return $this->db->query("SELECT max(id) as id, nomor FROM trnt_dashboard GROUP BY nomor")->result();
		// return $this->db->query("SELECT * FROM trnt_dashboard");
	}

  function GetMaxNomor($nomor = ""){
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
    return $this->db->get('trnt_requestpartspk')->row();
  }

  function GetSPK($nomor = "")
  {
    $this->db->where('nomor',$nomor);
    return $this->db->get("trnt_wo")->result();
  }
  
  function GetCustomer($nomor = "")
  {
    $this->db->where('nomor',$nomor);
    return $this->db->get("glbm_customer")->result();
  }
  
  function GetTipe($nomor = "")
  {
    $this->db->where('kode',$nomor);
    return $this->db->get("glbm_tipe")->result();
  }
  
  function GetProduct($nomor = "")
  {
    $this->db->where('kode',$nomor);
    return $this->db->get("glbm_product")->result();
  }

  function GetDataMekanik($kode = "")
  {
    $this->db->where('kode',$kode);
    return $this->db->get("glbm_teknisi")->result();
  }
  
  function GetParts($nomor = "")
  {
    $this->db->where('kode',$nomor);
    return $this->db->get("glbm_parts")->result();
  }

  function GetRequest($nomor = "")
  {
    $this->db->where('nomor',$nomor);
    return $this->db->get("trnt_requestpartspk")->result();
  }

  function GetDetail($nomor)
  {
    $this->db->where('nomor_request',$nomor);
    return $this->db->get("trnt_requestpartspkdetail")->result();
  }

  function SaveHeader($data = "")
  {
  return $this->db->insert('trnt_requestpartspk', $data);
  }
  function SaveDetail($data = "")
  {
  return $this->db->insert('trnt_requestpartspkdetail', $data);
  }

  function Cancel($data ="",$nomor = "")
  {
		$this->db->where('nomor', $nomor);
    return $this->db->update('trnt_requestpartspk', $data);
	}



}

?>