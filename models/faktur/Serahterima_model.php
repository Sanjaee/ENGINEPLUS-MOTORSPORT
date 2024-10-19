<?php

class Serahterima_model extends CI_Model
{
    function GetMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_serahterimaunit')->row();
	}

    function GetSPK($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_wo")->result();
	}

    function GetFaktur($nomor){
        $this->db->where('nomor',$nomor);
		return $this->db->get("trnt_faktur")->result();
    }
    
    function GetCustomer($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("glbm_customer")->result();
    }
    
    function GetTipe($nomor = ""){
		$this->db->where('kode',$nomor);
		return $this->db->get("glbm_tipe")->result();
    }
    
	function GetProduct($nomor = ""){
		$this->db->where('kode',$nomor);
		return $this->db->get("glbm_product")->result();
	}

	function GetSerahTerima($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_serahterimaunit")->result();
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_serahterimaunit', $data);
	}

	function CancelSerahTerima($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_serahterimaunit', $data);
	}

	function Update($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_serahterimaunit', $data);
	}






}
