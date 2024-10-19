<?php

class Order_pekerjaanluar_model extends CI_Model
{

    function GetSPK($nomor = ""){
		$this->db->where('nomorspk',$nomor);
		return $this->db->get("find_wo")->result();
	}
	
    function checkclosinggl($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from stpm_statusclosing WHERE periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND closing = true")->result();   
    }
	
    function checkclosingacc($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from trnt_statusclosing WHERE jenis = '2' and status = '1' and periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' ")->result();   
    }
	
	function checkstatuswo($nomorspk = ""){
		return $this->db->query("select * from trnt_wo where  nomor = '" . $nomorspk . "' AND status > '0'")->result();
	}

	function getdataopl($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_jasaopl")->result();
	}

    function getdatasupp($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("glbm_supplier")->result();
	}

	function GetMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_orderpekerjaanluar')->row();
	}
	
	function FindOPL($nomor){
		return $this->db->query("select OPL.*,W.kode_teknisi, W.nama_teknisi, 
		C.nama as namacustomer, C.nomor as nomorcustomer,S.nomor as nomorsupplier,
		S.nama as namasupplier, S.alamat as alamatsupplier
		from trnt_orderpekerjaanluar OPL
		LEFT JOIN trnt_wo W on W.nomor = OPL.nomor_wo
		LEFT JOIN glbm_customer C on C.nomor = W.nomor_customer
		LEFT JOIN glbm_supplier S on S.nomor = OPL.nomor_supplier
		where  OPL.nomor = '" . $nomor . "'")->result();
	}

	function FindOPLDetail($nomor){
		$this->db->where('nomor_opl',$nomor);
		return $this->db->get("trnt_orderpekerjaanluardetail")->result();
	}

	function SaveDetail($data = "")
    {
		return $this->db->insert('trnt_orderpekerjaanluardetail', $data);
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_orderpekerjaanluar', $data);
	}

	function invoice($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_orderpekerjaanluar', $data);
	}

	function hutang($data = "")
    {
		return $this->db->insert('trnt_hutang', $data);
	}
	
	function CancelPembebanan($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_orderpekerjaanluar', $data);
	}

	
	function updatehutang($data ="",$nomor = "")
    {
		$this->db->where('noreferensi', $nomor);
        return $this->db->update('trnt_hutang', $data);
	}


	function GetDataPrint($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("find_pembebananpart")->result();
	}

	function GetDataPrintDetail($nomor){
		$this->db->where('nomorpembebanan',$nomor);
		return $this->db->get("trnt_pembebananpartsdetail")->result();
	}

	function checkpembayaran($nomor)
    {
        return $this->db->query("SELECT * FROM trnt_hutang WHERE ( nilaipembayaran <> 0 or nilaicadanganpembayaran <> 0 ) AND noreferensi = '" . $nomor . "' AND Batal = False")->result();
    }

	
	function UpdateDetail($data ="",$nomor = "", $kode = "")
    {
		$this->db->where('nomor_opl', $nomor);
		$this->db->where('kode_pekerjaan', $kode);
        return $this->db->update('trnt_orderpekerjaanluardetail', $data);
	}

	function checkwoopl($nomor, $noopl)
    {
        return $this->db->query("SELECT nomor, opld.kode_pekerjaan from trnt_orderpekerjaanluar opl 
		left join trnt_orderpekerjaanluardetail opld on opld.nomor_opl = opl.nomor 
		WHERE opl.batal = false AND opld.kode_pekerjaan = '" . $noopl . "' AND opl.nomor_wo = '" . $nomor . "' ")->result();
    }

}


?>