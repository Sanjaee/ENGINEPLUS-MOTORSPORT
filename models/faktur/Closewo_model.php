<?php

class Closewo_model extends CI_Model
{
    function GetSPK($nomor = ""){
		$this->db->where('nomorspk',$nomor);
		return $this->db->get("find_wo")->result();
	}

	function checkstatuswo($nomorspk = ""){
		return $this->db->query("select * from trnt_wo where  nomor = '" . $nomorspk . "' AND status > '1'")->result();
	}

	function GetPembebananParts($nomor = ""){
		$this->db->where('nomorwo',$nomor);
		return $this->db->get("trnt_pembebananparts")->result();
	}
	function GetDataOPL($nomor = ""){
		return $this->db->query("select opd.*, op.nomor_wo from trnt_orderpekerjaanluar op 
		left join trnt_orderpekerjaanluardetail opd on opd.nomor_opl = op.nomor
		where op.batal = false and op.nomor_wo = '".$nomor."'")->result();
	}
	function GetPembebananPartsDetail($nomor = ""){
		// $this->db->where('nomorpembebanan',$nomor);
		// return $this->db->get("trnt_pembebananpartsdetail")->result();

		return $this->db->query("select opd.*, op.nomorwo from trnt_pembebananparts op 
		left join trnt_pembebananpartsdetail opd on opd.nomorpembebanan = op.nomor
		where op.batal = false and op.nomorwo = '".$nomor."'")->result();
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
	function GetMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_closewo')->row();
	}
	function GetDataSPKDetail($nomor){
		$this->db->where('nomorwo',$nomor);
		$this->db->where('jenis','2');
		return $this->db->get("trnt_wodetail")->result();
		// return $this->db->query("select * from trnt_wodetail where  nomorwo = '" . $nomor . "'")->result();
	}

	function FindCloseWO($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_closewo")->result();
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_closewo', $data);
	}

	function UpdateStatus($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_wo', $data);
	}

	function CancelWo($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_closewo', $data);
	}

	function cekstatusjasa($nomorspk = ""){
		return $this->db->query("select * from trnt_wodetail where nomorwo = '" . $nomorspk . "'AND jenis = 2 AND (statuspekerjaan = '0' OR statuspekerjaan = '1' OR statuspekerjaan = '3')")->result();
	}

	function checkopl($nomorspk = ""){
		return $this->db->query("select * from trnt_orderpekerjaanluar where  nomor_wo = '" . $nomorspk . "' AND statusselesai = False AND Batal = False")->result();
	}

	function checkdataopl($nomorspk = ""){
		return $this->db->query("select DISTINCT w.nomor from trnt_wo w 
		left join trnt_wodetail wd on wd.nomorwo = w.nomor and wd.jenis = 3
		left join (select opl.nomor, opl.nomor_wo, opd.kode_pekerjaan from trnt_orderpekerjaanluar opl left join trnt_orderpekerjaanluardetail opd on opd.nomor_opl = opl.nomor where batal = false) opl on opl.nomor_wo = w.nomor and wd.kodereferensi = opl.kode_pekerjaan
		where w.batal = false and w.status = 0 and opl.kode_pekerjaan is null and not (wd.kodereferensi is null)
		and w.nomor = '" . $nomorspk . "'")->result();
	}

	function checkdatawoopl($nomorspk = ""){
		return $this->db->query("select  DISTINCT op.nomor_wo , opd.kode_pekerjaan
		from trnt_orderpekerjaanluar op
		left join trnt_orderpekerjaanluardetail opd on op.nomor = opd.nomor_opl
		left join (
			select w.nomor, wd.kodereferensi from trnt_wo w 
			left join trnt_wodetail wd on wd.nomorwo = w.nomor and wd.jenis = 3 
		) w on w.nomor = op.nomor_wo and w.kodereferensi = opd.kode_pekerjaan
		where op.batal = false  and (w.kodereferensi is null) and not (opd.kode_pekerjaan is null)
		and op.nomor_wo = '" . $nomorspk . "'")->result();
	}

}


?>