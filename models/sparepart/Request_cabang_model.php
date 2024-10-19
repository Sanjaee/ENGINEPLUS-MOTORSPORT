<?php


class Request_cabang_model extends CI_Model
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

	function getdatacabang($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_cabang")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_ordertransferparts')->row();
	}

	function getdatafinddetail($nomor){
		$this->db->where('nomororder',$nomor);
		return $this->db->get("trnt_ordertransferpartsdetail")->result();
	}

	function getdatafind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_ordertransferparts")->result();
	}
	
	function saveheader($data = "")
    {
		return $this->db->insert('trnt_ordertransferparts', $data);
	}
	
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_ordertransferpartsdetail', $data);
	}
	

	function approve($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_ordertransferparts', $data);
	}

	function checktransfer($nomororder = "")
    {
		return $this->db->query("select * from trnt_transferparts where nomororder = '" . $nomororder . "' and batal = false")->result();
	}

	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_ordertransferparts', $data);
	}

}

?>