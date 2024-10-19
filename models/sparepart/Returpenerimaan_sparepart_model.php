<?php


class Returpenerimaan_sparepart_model extends CI_Model
{
	function checkstock($kode = "", $periode = "", $qty = "", $kodecabang = "", $kodesubcabang = "", $kodecompany = ""){
		return $this->db->query("select * from trnt_stockparts where  (qtyawal+qtymasuk-qtykeluar) >= " . $qty . " AND kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}
	
	function checkdatastock($kode = "", $periode = "", $kodecabang = "", $kodesubcabang = "", $kodecompany = ""){
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

	function updatestock($kode, $qty, $periode, $kodecabang, $kodesubcabang, $kodecompany, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtykeluar = qtykeluar +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtymasuk = qtymasuk +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        }
	}

	function getdatasupplier($nomor = ""){
		$this->db->where('aktif',true);
		$this->db->where('nomor',$nomor);
		return $this->db->get("glbm_supplier")->result();
	}

	function getdatasparepart($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_parts")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_returpenerimaansparepart')->row();
	}

	function getdatafinddetail($nomor){
		return $this->db->query("select * from trnt_returpenerimaansparepartdetail where nomorretur = '" . $nomor . "'")->result();
	}

	function getdatafind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_returpenerimaansparepart")->result();
	}

	function getdatapenerimaan($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_penerimaansparepart")->result();
	}

	function getpenerimaandetail($nomor){
		// $this->db->where('nomorpenerimaan',$nomor);
		// return $this->db->get("trnt_penerimaansparepartdetail")->result();
		return $this->db->query("select * from trnt_penerimaansparepartdetail where  qty <> qtyretur AND nomorpenerimaan = '" . $nomor . "'")->result();
	}

	function saveheader($data = "")
    {
		return $this->db->insert('trnt_returpenerimaansparepart', $data);
	}

	function piutang($data = "")
    {
		return $this->db->insert('trnt_piutang', $data);
	}
		
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_returpenerimaansparepartdetail', $data);
	}

	function updatepenerimaan($value = "", $nomor = "", $kode = "", $statusbatal)
    {
		if  ($statusbatal == TRUE) {
			return $this->db->query("update trnt_penerimaansparepartdetail set qtyretur = qtyretur - " . $value . "  where kodepart = '" . $kode . "' AND nomorpenerimaan = '" . $nomor . "'");
		} else {
			return $this->db->query("update trnt_penerimaansparepartdetail set qtyretur = qtyretur + " . $value . "  where kodepart = '" . $kode . "' AND nomorpenerimaan = '" . $nomor . "'");
		}
	}

	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_returpenerimaansparepart', $data);
	}

	function cancelpiutang($data ="",$nomor)
    {
		$this->db->where('noreferensi', $nomor);
        return $this->db->update('trnt_piutang', $data);
	}

	function checkpembayaran($nomor)
    {
        return $this->db->query("SELECT * FROM trnt_piutang WHERE ( nilaipenerimaan <> 0 ) AND noreferensi = '" . $nomor . "' AND Batal = False")->result();
    }

}
