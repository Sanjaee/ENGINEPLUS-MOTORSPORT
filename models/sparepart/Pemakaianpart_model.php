<?php

class Pemakaianpart_model extends CI_Model
{
	function checkdatastock($kode = "", $periode = "", $kodecabang = "",$kodecompany = "", $kodesubcabang = ""){
		$this->db->where('kodepart',$kode);
		$this->db->where('periode',$periode);
		$this->db->where('kode_cabang',$kodecabang);	
		$this->db->where('kodesubcabang',$kodesubcabang);
		$this->db->where('kodecompany',$kodecompany);
		return $this->db->get("trnt_stockparts")->result();
	}

	function insertstock($data = "")
    {
		return $this->db->insert('trnt_stockparts', $data);
	}

    function GetSPK($nomor = ""){
		$this->db->where('nospk',$nomor);
		return $this->db->get("cari_pembebananheader")->result();
	}

	function GetDataSPKDetail($nomor){
		return $this->db->query("select * from cari_pembebanandetail WHERE nospk = '" . $nomor . "' and qty > '0'")->result();
	}

	function checkstock($kode = "", $periode = "", $qty = "", $kodecabang = "" ,$kodesubcabang = "",$kodecompany = ""){
		return $this->db->query("select * from trnt_stockparts where  (qtyawal+qtymasuk-qtykeluar) >= " . $qty . " AND kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}

	function updatestock($kode, $qty, $periode, $kodecabang, $kodesubcabang, $kodecompany, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtykeluar = qtykeluar +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtymasuk = qtymasuk +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        }
	}
	
	function checkstatuswo($nomorspk = ""){
		return $this->db->query("select * from trnt_wo where  nomor = '" . $nomorspk . "' and batal = false AND status > '0'")->result();
	}

	function checkstatuswox($nomorspk = ""){
		return $this->db->query("select * from trnt_wo where  nomor = '" . $nomorspk . "' and batal = true")->result();
	}

	function getdatasparepart($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_parts")->result();
	}

    function GetTipe($nomor = ""){
		$this->db->where('kode',$nomor);
		return $this->db->get("glbm_tipe")->result();
	}
	function GetCustomer($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("glbm_customer")->result();
	}

	function GetProduct($nomor = ""){
		$this->db->where('kode',$nomor);
		return $this->db->get("glbm_product")->result();
	}
	function GetMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_pemakaianpart')->row();
	}
	
	function GetDataPemakaianDetail($nomor){
		$this->db->where('nomorpemakaian',$nomor);
		return $this->db->get("find_detail_pemakaianpart")->result();
	}
	function GetDataFind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("find_pemakaianpart")->result();
	}

	function SaveDetail($data = "")
    {
		return $this->db->insert('trnt_pemakaianpartdetail', $data);
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_pemakaianpart', $data);
	}

	function CancelPembebanan($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_pemakaianpart', $data);
	}


	function GetDataPrint($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("form_pembebananpart")->result();
	}

	function GetDataPrintDetail($nomor){
		$this->db->where('nomorpemakaian',$nomor);
		return $this->db->get("trnt_pemakaianpartdetail")->result();
	}

	function GetParts($nomor = "", $kode_cabang = "", $kodecompany = ""){
		return $this->db->query("select *  from glbm_parts where kode = '" . $nomor . "' and kodecabang = '" . $kode_cabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
	}

	function GetStock($kode = "", $kodecabang = "",$kodesubcabang = "",$kodecompany = "", $periode = ""){
		return $this->db->query("SELECT (qtyawal+qtymasuk-qtykeluar) as stockakhir from trnt_stockparts where  kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}
}


?>