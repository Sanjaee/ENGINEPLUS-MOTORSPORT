<?php


class Bag_sparepart_model extends CI_Model
{
	
	function getdatasparepart($kode = "", $kode_cabang = "", $kodecompany = ""){
		return $this->db->query("select CASE kategori
		when 1 then 'AIR CONDITIONER SYSTEM'
		when 2 then 'BODY PART'
		when 3 then 'BRAKE SYSTEM'
		when 4 then 'CLAMP'
		when 5 then 'COOLING SYSTEM'
		when 6 then 'ELECTRICAL'
		when 7 then 'EXTERNAL ENGINE'
		when 8 then 'FUEL SYSTEM'
		when 9 then 'HOSE'
		when 10 then 'INTAKE & EXHAUST SYSTEM'
		when 11 then 'INTERNAL ENGINE'
		when 12 then 'OIL & CHEMICAL'
		when 13 then 'UNDERCARRIAGE'
		when 14 then 'STEERING & WHEEL'
		when 15 then 'TRANSMISI'
		when 16 then 'OTHER'
		ELSE 'OTHER'
	  END AS kategoripart, *  from glbm_parts where kode = '" . $kode . "' and kodecabang = '" . $kode_cabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
	}


	function caristockpart($kode = "", $kode_cabang = "", $kodesubcabang = "",$kodecompany = "", $periode = ""){
		return $this->db->query("select (qtyawal+qtymasuk-qtykeluar) as sisa from trnt_stockparts where  kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kode_cabang . "'  AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_BAGSparepart')->row();
	}

	function getdatafinddetail($nomor){
		// $this->db->where('nomorbag',$nomor);
		// return $this->db->get("trnt_BAGSparepartdetail")->result();
		return $this->db->query(" SELECT * from form_bagdetail where nomorbag ='" . $nomor . "' ")->result();
	}

	function getdatafind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_BAGSparepart")->result();
	}
	
	function saveheader($data = "")
    {
		return $this->db->insert('trnt_BAGSparepart', $data);
	}
	
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_BAGSparepartdetail', $data);
	}
	

	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_BAGSparepart', $data);
	}

	function checkdatastock($kode = "", $periode = "", $kodecabang = "", $kodesubcabang = "",$kodecompany = ""){
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

	function checkstock($kode = "", $periode = "", $qty = "", $kodecabang = "" , $kodesubcabang = "",$kodecompany = ""){
		return $this->db->query("select * from trnt_stockparts where  (qtyawal+qtymasuk-qtykeluar) >= " . $qty . " AND kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}

}

?>