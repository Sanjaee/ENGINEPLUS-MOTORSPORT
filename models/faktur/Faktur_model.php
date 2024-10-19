<?php

class Faktur_model extends CI_Model
{
    function GetSPK($nomor = ""){
		$this->db->where('nomorspk',$nomor);
		return $this->db->get("find_wo")->result();
	}

	function CekDisc($grup, $modul, $persen)
	{
		return $this->db->query("select * from stpm_grupdiscount 
		WHERE grup = '" . $grup . "' and module = '" . $modul . "' and maxdisc >= " . $persen . "")->result();
	}

	function GetDetail($nomor = ""){
		$this->db->where('nospk',$nomor);
		return $this->db->get("cari_dataspkuntukinvoice")->result();
	}

	function GetTask($nomor = "", $model= ""){
		$this->db->where('kode',$nomor);
		$this->db->where('kodeproduct',$model);
		return $this->db->get("cari_jasa")->result();
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
		$this->db->where("left(nomor,11)",$nomor);
        return $this->db->get('trnt_faktur')->row();
	}
	
	function GetDataFakturDetail($nomor){
		$this->db->where('nomorfaktur',$nomor);
		return $this->db->get("trnt_fakturdetail")->result();
	}
	function GetDataFind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("find_faktur")->result();
	}

	function SaveDetail($data = "")
    {
		return $this->db->insert('trnt_fakturdetail', $data);
	}

	function SavePiutang($data = "")
    {
		return $this->db->insert('trnt_piutang', $data);
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_faktur', $data);
	}

	function UpdateStatusFaktur($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_wo', $data);
	}

	function CancelFaktur($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_faktur', $data);
	}

	function CancelPiutang($data ="",$nomor = "")
    {
		$this->db->where('noreferensi', $nomor);
        return $this->db->update('trnt_piutang', $data);
	}

	function checkserahterima($nomor = ""){
		return $this->db->query("select * from trnt_serahterimaunit where  noreferensi = '" . $nomor . "' AND batal = false")->result();
	}

	function checkbayar($nomor = ""){
		return $this->db->query("select * from trnt_piutang where  noreferensi = '" . $nomor . "' AND nilaipenerimaan <> '0'")->result();
	}

	function getMaxNomorAlokasi($nomor = "")
    {
        $this->db->select_max('nomor');
        $this->db->where("left(nomor,10)", $nomor);
        return $this->db->get('trnt_alokasiuangmuka')->row();
	}
	
	function savealokasi($data)
    {
        return $this->db->insert('trnt_alokasiuangmuka', $data);
	}
	
	function cancelalokasi($data, $nomor, $noreferensi)
    {
        $this->db->where('nomorpenjualan', $nomor);
        $this->db->where('noreferensi', $noreferensi);
        return $this->db->update('trnt_alokasiuangmuka', $data);
    }
	
	function checkwo($nomorspk = ""){
		return $this->db->query("select * from trnt_faktur where  nomor_spk = '" . $nomorspk . "' AND batal = false")->result();
	}
	
	function GetCogs($kodepart, $kodecabang, $kodecompany){
		return $this->db->query("SELECT p.kode, s.periode, COALESCE(s.cogs,p.hargabeli) as cogs from glbm_parts p 
		LEFT JOIN trnt_stockparts s ON to_char(CURRENT_DATE, 'mm')::INTEGER =
		CASE
			WHEN right((s.periode), 2)::INTEGER = 1 THEN 12
			ELSE right((s.periode), 2)::INTEGER - 1
		END AND date_part('YEAR', CURRENT_DATE) =
		CASE
			WHEN right((s.periode), 2)::INTEGER = 1 THEN left((s.periode), 4)::INTEGER - 1
			ELSE left((s.periode),4)::INTEGER
		END AND p.kode = s.kodepart AND p.kodecabang = s.kode_cabang  where  p.kode = '" . $kodepart . "' AND p.kodecabang = '" . $kodecabang . "' AND p.kodecompany = '" . $kodecompany . "'")->row();
	}
}
