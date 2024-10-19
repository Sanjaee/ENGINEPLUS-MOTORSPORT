<?php


class Transfer_partho_model extends CI_Model
{

	function getdatasparepart($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_parts")->result();
	}

	function caristockpart($kode = "", $kode_cabang = "",$periode = ""){
		return $this->db->query("select (qtyawal+qtymasuk-qtykeluar) as sisa from trnt_stockparts where  kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kode_cabang . "'")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_transferpartstoho')->row();
	}

	function findpenerimaan($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_transferpartstoho")->result();
	}

	function findpenerimaandetail($nomor){
		$this->db->where('nomortransfer',$nomor);
		return $this->db->get("trnt_transferpartstohodetail")->result();
	}
	
	
	function saveheader($data = "")
    {
		return $this->db->insert('trnt_transferpartstoho', $data);
	}

	
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_transferpartstohodetail', $data);
	}

	function checkstock($kode = "", $periode = "", $qty = "", $kodecabang = ""){
		return $this->db->query("select * from trnt_stockparts where  (qtyawal+qtymasuk-qtykeluar) >= " . $qty . " AND kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "'")->result();
	}
	
	function updatestock($kode, $qty, $periode, $kodecabang, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtykeluar = qtykeluar +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtymasuk = qtymasuk +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "'");
        }
	}

	function insertstock($data = "")
    {
		return $this->db->insert('trnt_stockparts', $data);
	}

	function checkdatapart($kode = "", $periode = "", $kodecabang = ""){
		$this->db->where('kodepart',$kode);
		$this->db->where('periode',$periode);
		$this->db->where('kode_cabang',$kodecabang);
		return $this->db->get("trnt_stockparts")->result();
	}

	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_transferpartstoho', $data);
	}

}

?>