<?php


class Ordering_partcounter_model extends CI_Model
{
	
	function getdatacustomer($nomor = ""){
		$this->db->where('aktif',true);
		$this->db->where('nomor',$nomor);
		return $this->db->get("glbm_customer")->result();
	}

	function getdatasparepart($kode = "", $kode_cabang = "", $kodecompany = ""){
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
		ELSE 'OTHER'
	  END AS kategoripart, *  from glbm_parts where kode = '" . $kode . "' and kodecabang = '" . $kode_cabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,11)",$nomor);
        return $this->db->get('trnt_partcounterorder')->row();
	}

	function getdatafinddetail($nomor){
		$this->db->where('nomor_order',$nomor);
		return $this->db->get("trnt_partcounterorderdetail")->result();
	}

	function getdatafind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_partcounterorder")->result();
	}

	function GetDataOrderPart($nomor){
		// $this->db->where('nomor_order',$nomor);
		return $this->db->query("select * from trnt_orderingsparepartdetail od 
		left join glbm_parts p on p.kode = od.kodepart where od.nomororder = '" . $nomor . "'")->result();
	}
	
	function saveheader($data = "")
    {
		return $this->db->insert('trnt_partcounterorder', $data);
	}
	
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_partcounterorderdetail', $data);
	}
	
	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_partcounterorder', $data);
	}

	
	function DeleteDetail($nomor = "")
    {
		$this->db->where('nomor_order', $nomor);
        return $this->db->delete('trnt_partcounterorderdetail');
	}

	function updateheader($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_partcounterorder', $data);
	}

	function cekdp($nomor){
		$this->db->where('nomor',$nomor);
		$this->db->where('nilaiuangmuka <> 0');
		return $this->db->get("trnt_partcounterorder")->result();
	}

	function checkstatus($nomor = ""){
		return $this->db->query("select * from trnt_partcounterorder where  nomor = '" . $nomor . "' AND statusfaktur = true")->result();
	}

}

?>