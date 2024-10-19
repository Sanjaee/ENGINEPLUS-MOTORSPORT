<?php

class Estimasi_model extends CI_Model
{
	
	function getdatamobil($nopol){
		return $this->db->query("select DK.nopolisi,DK.norangka, DK.kodetipe, DK.namatipe, DK.nomor_customer, C.nama,
		DK.namapic, DK.nohppic, DK.odmeterakhir, T.kodekategori as model
		from trnt_kendaraancustomer DK 
		left join glbm_customer C on C.nomor = DK.nomor_customer 
		left join glbm_tipe T on T.kode = DK.kodetipe
		where  nopolisi = '" . $nopol . "'")->result();
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

	function GetParts($nomor = "", $kode_cabang = "", $kodecompany = ""){
		// $this->db->where('kode',$nomor);
		// return $this->db->get("glbm_parts")->result();
		return $this->db->query("select CASE kategori
		WHEN 1 THEN 'INTERNAL ENGINE'
		WHEN 2 THEN 'EXTERNAL ENGINE'
		WHEN 3 THEN 'INTAKE & EXHAUST SYSTEM'
		WHEN 4 THEN 'COOLING SYSTEM'
		WHEN 5 THEN 'FUEL SYSTEM'
		WHEN 6 THEN 'ELECTRICAL'
		WHEN 7 THEN 'AIR CONDITIONER SYSTEM'
		WHEN 8 THEN 'STEERING & WHEEL'
		WHEN 9 THEN 'TRANSMISI'
		WHEN 10 THEN 'BRAKE SYSTEM'
		WHEN 11 THEN 'UNDERCARRIAGE'
		WHEN 12 THEN 'OIL & CHEMICAL'
		WHEN 13 THEN 'BODY PART'
		WHEN 14 THEN 'HOSE'
		WHEN 15 THEN 'CLAMP'
		WHEN 16 THEN 'FITTING'
		WHEN 17 THEN 'OTHER'
		WHEN 18 THEN 'SUSPENSION SYSTEM'
		WHEN 19 THEN '3D PRINTED'
		WHEN 20 THEN 'MERCHANDISE'
		WHEN 21 THEN 'CNC'
		WHEN 22 THEN 'CARBON'
		ELSE 'OTHER'
	  END AS kategoripart, *  from glbm_parts where kode = '" . $nomor . "' and kodecabang = '" . $kode_cabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
	}

	function GetTask($nomor = "", $model= ""){
		$this->db->where('kode',$nomor);
		$this->db->where('kodeproduct',$model);
		return $this->db->get("cari_jasa")->result();
	}

	function GetOPL($nomor = ""){
		$this->db->where('kode',$nomor);
		return $this->db->get("glbm_jasaopl")->result();
	}

	function GetMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,11)",$nomor);
        return $this->db->get('trnt_estimasiwo')->row();
	}

	function GetDataFindDetail($nomor){
		$this->db->where('nomorestimasi',$nomor);
		return $this->db->get("trnt_estimasiwodetail")->result();
	}

	function GetDataFind($nomor){
		// $this->db->where('nomor',$nomor);
		// return $this->db->get("trnt_wo")->result();
		return $this->db->query("select * from trnt_estimasiwo w left join glbm_tipe t on t.kode = w.tipe where  nomor = '" . $nomor . "'")->result();
	}

	function SaveDetail($data = "")
    {
		return $this->db->insert('trnt_estimasiwodetail', $data);
	}


	function DeleteDetail($nomor = "",$kode = "")
    {
		$this->db->where('nomorestimasi', $nomor);
		//$this->db->where('kodereferensi', $kode);
        return $this->db->delete('trnt_estimasiwodetail');
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_estimasiwo', $data);
	}

	function UpdateHeader($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_estimasiwo', $data);
	}

	function CancelTransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_estimasiwo', $data);
	}

	function checkestimasi($nomor = ""){
		return $this->db->query("select * from trnt_estimasiwo where  nomor = '" . $nomor . "' AND batal = false AND status <> 0")->result();
	}

	function Getregularcheck($kode = "")
	{
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_regularchecklist")->result();
	}

	function GetDataRegularDetail($kode = "", $kodemodel = "")
	{
		$this->db->where('kode_regularcheck',$kode);
		$this->db->where('kode_model',$kodemodel);
		return $this->db->get("cari_dataregularcheck")->result();
	}

}

?>