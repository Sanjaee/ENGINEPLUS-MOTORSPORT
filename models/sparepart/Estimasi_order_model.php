<?php


class Estimasi_order_model extends CI_Model
{

	function getdatasparepart($kode = "", $kode_cabang = "", $kodecompany = ""){
		$this->db->where('kode',$kode);
		$this->db->where('kodecabang',$kode_cabang);
		$this->db->where('kodecompany',$kodecompany);
		return $this->db->get("glbm_parts")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_estimasiorder')->row();
	}

	function getdatafinddetail($nomor){
		$this->db->where('noestimasiorder',$nomor);
		return $this->db->get("trnt_estimasiorderdetail")->result();
	}

	function getdatafind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_estimasiorder")->result();
	}
	
	function saveheader($data = "")
    {
		return $this->db->insert('trnt_estimasiorder', $data);
	}
	
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_estimasiorderdetail', $data);
	}


	function updatedata($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_estimasiorder', $data);
	}

	function checkmaster($kode, $kodecabang, $kodecompany)
	{
		return $this->db->query("select * from glbm_parts where kode = '" . $kode . "' AND kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}
	
	function updatemasterpart($data ="",$kode, $kodecabang, $kodecompany)
    {
		$this->db->where('kode', $kode);
		$this->db->where('kodecabang', $kodecabang);
		$this->db->where('kodecompany', $kodecompany);
        return $this->db->update('glbm_parts', $data);
	}

	function savemasterpart($data = "")
    {
		return $this->db->insert('glbm_parts', $data);
	}
	
	function DeleteDetail($nomor = "")
    {
		$this->db->where('noestimasiorder', $nomor);
        return $this->db->delete('trnt_estimasiorderdetail');
	}


}

?>