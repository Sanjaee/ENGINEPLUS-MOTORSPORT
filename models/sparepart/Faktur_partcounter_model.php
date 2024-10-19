<?php

class faktur_partcounter_model extends CI_Model
{
	function checkdatastock($kode = "", $periode = "", $kodecabang = "",$kodecompany = "", $kodesubcabang = ""){
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

	function CekDisc($grup, $modul, $persen)
	{
		return $this->db->query("select * from stpm_grupdiscount 
		WHERE grup = '" . $grup . "' and module = '" . $modul . "' and maxdisc >= " . $persen . "")->result();
	}
	
    function GetDataOrder($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_partcounterorder")->result();
	}

	function GetDetail($nomor = ""){
		return $this->db->query("select PC.*,P.nama,P.hargajual from trnt_partcounterorderdetail PC
		LEFT JOIN trnt_partcounterorder b on b.nomor = PC.nomor_order
		LEFT JOIN glbm_parts P on P.kode = PC.kode_parts and P.kodecabang = b.kode_cabang and P.kodecompany = b.kodecompany
		where  nomor_order = '" . $nomor . "'")->result();
	}
	
	function GetMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,11)",$nomor);
        return $this->db->get('trnt_partcounterfaktur')->row();
	}
	
	function GetDataFakturDetail($nomor){
		return $this->db->query("select PC.*,pt.nama from trnt_partcounterfakturdetail PC
		left join trnt_partcounterfaktur b on b.nomor = PC.nomor_faktur
		LEFT JOIN glbm_parts pt ON pt.kode = PC.kode_parts and pt.kodecabang = b.kode_cabang and pt.kodecompany = b.kodecompany				
		where  nomor_faktur = '" . $nomor . "'")->result();
	}
	function GetDataFind($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_partcounterfaktur")->result();
	}

	function SaveDetail($data = "")
    {
		return $this->db->insert('trnt_partcounterfakturdetail', $data);
	}

	function SavePiutang($data = "")
    {
		return $this->db->insert('trnt_piutang', $data);
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_partcounterfaktur', $data);
	}

	function UpdateStatusFaktur($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_partcounterorder', $data);
	}

	function CancelFaktur($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_partcounterfaktur', $data);
	}

	function CancelPiutang($data ="",$nomor = "")
    {
		$this->db->where('noreferensi', $nomor);
        return $this->db->update('trnt_piutang', $data);
	}

	function checkbayar($nomor = ""){
		return $this->db->query("select * from trnt_piutang where  noreferensi = '" . $nomor . "' AND nilaipenerimaan <> '0'")->result();
	}

	function updatestock($kode, $qty, $periode, $kodecabang, $kodesubcabang, $kodecompany, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtykeluar = qtykeluar +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtymasuk = qtymasuk +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        }
	}

	function checkstock($kode = "", $periode = "", $qty = "", $kodecabang = "", $kodesubcabang = "", $kodecompany = ""){
		return $this->db->query("select * from trnt_stockparts where  (qtyawal+qtymasuk-qtykeluar) >= " . $qty . " AND kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}

	function GetDataPrint($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("find_faktur_report")->result();
	}

	function GetDataPrintDetail($nomor){
		$this->db->where('nomorfaktur',$nomor);
		return $this->db->get("trnt_fakturdetail")->result();
	}

	function getMaxNomorAlokasi($nomor = "")
    {
        $this->db->select_max('nomor');
        $this->db->where("left(nomor,10)", $nomor);
        return $this->db->get('trnt_alokasiuangmuka')->row();
	}
	
	function savealokasi($data)
    {
        return $this->db->insert('trnt_alokasiuangmuka', $data);
	}
	
	function cancelalokasi($data, $nomor, $noreferensi)
    {
        $this->db->where('nomorpenjualan', $nomor);
        $this->db->where('noreferensi', $noreferensi);
        return $this->db->update('trnt_alokasiuangmuka', $data);
    }

	
}


?>