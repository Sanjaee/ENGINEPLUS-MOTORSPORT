<?php


class Transfer_sparepart_model extends CI_Model
{

	function getdatasparepart($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_parts")->result();
	}

	function getordering($nomororder = ""){
		$this->db->where('nomor',$nomororder);
		return $this->db->get("trnt_ordertransferparts")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_transferparts')->row();
	}

	function getdatafinddetail($nomor)
	{	
		return $this->db->query("select * from trnt_ordertransferpartsdetail where  qty <> qtygr AND nomororder = '" . $nomor . "'")->result();
	}

	function getdatafind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_ordertransferparts")->result();
	}

	function findpenerimaan($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_transferparts")->result();
	}

	function findpenerimaandetail($nomor){
		$this->db->where('nomortransfer',$nomor);
		return $this->db->get("trnt_transferpartsdetail")->result();
	}
	
	
	function saveheader($data = "")
    {
		return $this->db->insert('trnt_transferparts', $data);
	}

	
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_transferpartsdetail', $data);
	}

	function checkstock($kode = "", $periode = "", $qty = "", $kodecabang = "", $kodesubcabang = "", $kodecompany = ""){
		return $this->db->query("select * from trnt_stockparts where  ((qtyawal+qtymasuk)-qtykeluar) >= " . $qty . " AND kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "'  AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}
	
	function updatestock($kode, $qty, $periode, $kodecabang,$kodesubcabang, $kodecompany, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtykirim = qtykirim +" . $qty . ", qtykeluar = qtykeluar +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "'  AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtyterima = qtyterima +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "'  AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        }
	}

	function updatestockbatal($kode, $qty, $periode, $kodecabang,$kodesubcabang, $kodecompany, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtyterima = qtyterima -" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "'  AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtykirim = qtykirim -" . $qty . " , qtymasuk = qtymasuk +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "'  AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        }
	}

	function insertstock($data = "")
    {
		return $this->db->insert('trnt_stockparts', $data);
	}

	function checkdatapart($kode = "", $periode = "", $kodecabang = "" ,$kodesubcabang = "", $kodecompany = ""){
		$this->db->where('kodepart',$kode);
		$this->db->where('periode',$periode);
		$this->db->where('kode_cabang',$kodecabang);		
		$this->db->where('kodesubcabang',$kodesubcabang);
		$this->db->where('kodecompany',$kodecompany);
		return $this->db->get("trnt_stockparts")->result();
	}

	function updateordering($value = "", $nomor = "", $kode = "", $statusbatal)
    {
		if  ($statusbatal == TRUE) {
			return $this->db->query("update trnt_ordertransferpartsdetail set qtygr = qtygr - " . $value . "  where kodepart = '" . $kode . "' AND nomororder = '" . $nomor . "'");
		} else {
			return $this->db->query("update trnt_ordertransferpartsdetail set qtygr = qtygr + " . $value . "  where kodepart = '" . $kode . "' AND nomororder = '" . $nomor . "'");
		}
	}

	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_transferparts', $data);
	}

	function cancelhutang($data ="",$nomor)
    {
		$this->db->where('noreferensi', $nomor);
		// $this->db->where('title', $title);
        return $this->db->update('trnt_hutang', $data);
	}

	function checkorder($nomorrequest = "")
    {
		return $this->db->query("SELECT sum(qty) as qty , sum(qtygr) as qtygr from trnt_ordertransferpartsdetail where nomororder = '" . $nomorrequest . "'")->result();
	}

	function updateorder($nomorrequest = "", $statusbatal)
    {
		if  ($statusbatal == TRUE) {
			return $this->db->query("UPDATE trnt_ordertransferparts Set close = FALSE where nomor = '" . $nomorrequest . "'");
		} else {
			return $this->db->query("UPDATE trnt_ordertransferparts Set close = TRUE where nomor = '" . $nomorrequest . "'");
		}
	}

	function checkpenerimaan($nomor = "")
    {
		return $this->db->query("SELECT * from trnt_transferparts where nomor = '" . $nomor . "' and statusterima = TRUE")->result();
	}
	
	function getdatacogssparepart($kode = "", $kodecabang = "", $kodesubcabang = "",  $kodecompany = "")
	{	
        $periode = date("Y") . date("m");
		return $this->db->query("select * from trnt_stockpartsfaktur where kodepart = '" . $kode . "'  AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
		// return $this->db->query("select * from glbm_partdetail where kodepart = '" . $kode . "' AND kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}
}

?>