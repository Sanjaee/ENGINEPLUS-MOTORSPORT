<?php

class Pembatalan_model extends CI_Model
{
    function GetMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_memopembatalanspk')->row();
    }
    
    function GetSPK($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_wo")->result();
	}

    function GetMemo($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_memopembatalanspk")->result();
    }
    
    function GetDataSPKDetail($nomor){
		$this->db->where('nomorwo',$nomor);
		return $this->db->get("trnt_wodetail")->result();
    }
    
    function GetCustomer($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("glbm_customer")->result();
	}

    function GetTipe($nomor = ""){
		$this->db->where('kode',$nomor);
		return $this->db->get("glbm_tipe")->result();
    }
    
    function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_memopembatalanspk', $data);
	}

	function CekPembebanan($nomorspk = ""){
		return $this->db->query("select * from trnt_pembebananparts where  nomorwo = '" . $nomorspk . "' AND Batal = False")->result();
	}

	function checkstatuswo($nomorspk = ""){
		return $this->db->query("select * from trnt_wo where  nomor = '" . $nomorspk . "' AND batal = true")->result();
	}

	function CancelTransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_memopembatalanspk', $data);
	}










}
?>