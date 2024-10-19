<?php


class Ordering_sparepart_model extends CI_Model
{

	function getdatasupplier($nomor = ""){
		$this->db->where('aktif',true);
		$this->db->where('nomor',$nomor);
		return $this->db->get("glbm_supplier")->result();
	}

	function getdatasparepart($kode = "", $kode_cabang = "", $kodecompany = ""){
		$this->db->where('kode',$kode);
		$this->db->where('kodecabang',$kode_cabang);
		$this->db->where('kodecompany',$kodecompany);
		return $this->db->get("glbm_parts")->result();
	}

	function getdatacabang($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_cabang")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_orderingsparepart')->row();
	}

	function getdatafinddetail($nomor){
		$this->db->where('nomororder',$nomor);
		return $this->db->get("trnt_orderingsparepartdetail")->result();
	}

	function getdatafind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_orderingsparepart")->result();
	}
	
	function saveheader($data = "")
    {
		return $this->db->insert('trnt_orderingsparepart', $data);
	}
	
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_orderingsparepartdetail', $data);
	}

	function approve($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_orderingsparepart', $data);
	}

	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_orderingsparepart', $data);
	}

	function checkpenerimaan($nomororder = "")
    {
		return $this->db->query("select * from trnt_penerimaansparepart where nomororder = '" . $nomororder . "' and batal = false")->result();
	}

	function checkuangmuka($nomor = "")
    {
		return $this->db->query("select * from trnt_orderingsparepart where nomor = '" . $nomor . "' and batal = false and nilaiuangmuka <> 0")->result();
	}

	function checkcduangmuka($nomor = "")
    {
		return $this->db->query("select * from trnt_cadanganpembayaran cp
		left join trnt_cadanganpembayarandetail cd on cd.nomorcadangan = cp.nomor 
		where noreferensi = '" . $nomor . "' and cp.batal = false")->result();
	}

	function getdataestimasi($nomor){
		$this->db->where('noestimasiorder',$nomor);
		return $this->db->get("trnt_estimasiorderdetail")->result();
	}

	
	function updatetransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_orderingsparepart', $data);
	}

	function inserthistoryorder($data = "")
    {
		return $this->db->insert('trnt_historyupdateorder', $data);
	}
}

?>