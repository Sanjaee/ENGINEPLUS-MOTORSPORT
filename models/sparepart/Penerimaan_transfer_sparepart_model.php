<?php


class Penerimaan_transfer_sparepart_model extends CI_Model
{

	function getdatasparepart($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_parts")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_penerimaantransferparts')->row();
	}

	function getfindtfkecabangdetail($nomor)
	{	
		return $this->db->query("select * from trnt_transferpartsdetail where nomortransfer = '" . $nomor . "'")->result();
	}

	function getfindtfkecabang($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_transferparts")->result();
	}

	function findpenerimaan($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_penerimaantransferparts")->result();
	}

	function findpenerimaandetail($nomor){
		$this->db->where('nomorterima',$nomor);
		return $this->db->get("trnt_penerimaantransferpartsdetail")->result();
	}

	function gettransfer($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_transferparts")->result();
	}
	
	
	function saveheader($data = "")
    {
		return $this->db->insert('trnt_penerimaantransferparts', $data);
	}

	
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_penerimaantransferpartsdetail', $data);
	}

	function checkstock($kode = "", $periode = "", $qty = "", $kodecabang = "", $kodesubcabang = "", $kodecompany = ""){
		return $this->db->query("select * from trnt_stockparts where  ((qtyawal+qtymasuk)-qtykeluar) >= " . $qty . " AND kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}
	
	function updatestock($kode, $qty, $periode, $kodecabang, $kodesubcabang, $kodecompany, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtykirim = qtykirim -" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtymasuk = qtymasuk +" . $qty . " ,qtyterima = qtyterima -" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        }
	}

	function updatestockbatal($kode, $qty, $periode, $kodecabang, $kodesubcabang, $kodecompany, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtykirim = qtykirim +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtyterima = qtyterima +" . $qty . " , qtykeluar = qtykeluar +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        }
	}

	function insertstock($data = "")
    {
		return $this->db->insert('trnt_stockparts', $data);
	}

	function checkdatapart($kode = "", $periode = "", $kodecabang = "", $kodesubcabang = "", $kodecompany = ""){
		$this->db->where('kodepart',$kode);
		$this->db->where('periode',$periode);
		$this->db->where('kode_cabang',$kodecabang);
		$this->db->where('kodesubcabang',$kodesubcabang);
		$this->db->where('kodecompany',$kodecompany);
		return $this->db->get("trnt_stockparts")->result();
	}

	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_penerimaantransferparts', $data);
	}

	function updatetransfer($nomortransfer = "", $statusterima)
    {
		if  ($statusterima == TRUE) {
			return $this->db->query("UPDATE trnt_transferparts Set statusterima = FALSE where nomor = '" . $nomortransfer . "'");
		} else {
			return $this->db->query("UPDATE trnt_transferparts Set statusterima = TRUE where nomor = '" . $nomortransfer . "'");
		}
	}

}

?>