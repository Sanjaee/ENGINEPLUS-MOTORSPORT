<?php

class Statuspekerjaan_model extends CI_Model
{
	function getWO($nomor = ""){
		// $this->db->where('nomor', $nomor);
		return $this->db->query("SELECT w.*, c.nama as namacustomer 
								FROM  trnt_wo w LEFT JOIN glbm_customer c ON c.nomor = w.nomor_customer
								WHERE w.nomor = '".$nomor."'")->result();
	}

	function getWODetail($nomor = ""){
		// $this->db->where('nomorwo', $nomor);
		// $this->db->where('jenis', 2);
		// $this->db->where('statuspekerjaan', 0 AND 1);
		return $this->db->query("SELECT * FROM trnt_wodetail WHERE nomorwo = '".$nomor."' AND jenis = '2' AND statuspekerjaan <> 3")->result();
	}

	function ceknomorwo($nomor = "", $kode){
		$this->db->where('nomorwo', $nomor);
		$this->db->where('kodereferensi', $kode);
		// return $this->db->get("trnt_pencatatanwaktu")->result();
		return $this->db->get("trnt_wodetail")->result();
	}

	function getnomorurut($nomor){
		return $this->db->query("select max(nourut) as nourut FROM trnt_pencatatanwaktu WHERE nomor_wo = '".$nomor."'")->result();
	}

	function getstatuspekerjaan($nomor, $kode){
		return $this->db->query("select max(statuspekerjaan) as statuspekerjaan FROM trnt_pencatatanwaktu WHERE nomor_wo = '".$nomor."' and kodereferensi = '".$kode."'")->result();
	}

	function updateStatus($data = "")
    {
		return $this->db->insert('trnt_pencatatanwaktu', $data);
	}

	function updateStatusWO($updatestatuswo, $nomor_wo, $kode)
    {
		$this->db->where('nomorwo', $nomor_wo);
		$this->db->where('kodereferensi', $kode);
		return $this->db->update('trnt_wodetail', $updatestatuswo);
	}

	function checkstatuswo($nomor = "", $kode){
		return $this->db->query("select * from trnt_wodetail where nomorwo = '" . $nomor . "' AND kodereferensi = '".$kode."'")->result();
	}

	function checkstatuspekerjaan($nomor = "", $kode){
		return $this->db->query("select * from trnt_pencatatanwaktu where nomor_wo = '" . $nomor . "' AND kodereferensi = '".$kode."'")->result();
	}

	function cancelStatus($data = "", $nomor, $kode)
    {
		$this->db->where('nomor_wo', $nomor);
		$this->db->where('kodereferensi', $kode);
		return $this->db->update('trnt_pencatatanwaktu', $data);
	}

	function cancelWODetail($datawodetail, $nomor_wo, $kode)
    {
		$this->db->where('nomorwo', $nomor_wo);
		$this->db->where('kodereferensi', $kode);
		return $this->db->update('trnt_wodetail', $datawodetail);
	}











	function DeleteDetail($nomor = "",$kode = "")
    {
		$this->db->where('nomorbooking', $nomor);
		//$this->db->where('kodereferensi', $kode);
        return $this->db->delete('trnt_bookingservicedetail');
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_bookingservice', $data);
	}

	function UpdateHeader($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_bookingservice', $data);
	}

	function CancelTransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_bookingservice', $data);
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
