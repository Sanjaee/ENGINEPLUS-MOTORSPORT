<?php
class Entry_jasa_detail_model extends CI_Model
{
	function checkstatuswo($nomorspk = ""){
		return $this->db->query("select * from trnt_wo where  nomor = '" . $nomorspk . "' AND status > '0'")->result();
	}

    function getDataWO($nomor = ""){
		return $this->db->query("select 
		w.nomor as nomor_wo, w.nopolisi, w.nomor_customer, w.tipe, c.nama as nama_customer, t.nama as nama_tipe
		from trnt_wo w
		left join glbm_customer c on c.nomor = w.nomor_customer
		left join glbm_tipe t on t.kode = w.tipe
		where w.nomor = '" . $nomor . "'")->result();
	}

	function getDataJasa($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_jasa")->result();
	}

	function getDataJasaDetail($kode = ""){
		$this->db->where('kode_jasa',$kode);
		return $this->db->get("glbm_jasadetail")->result();
	}

	function DataJasaDetail($kode = ""){
		$this->db->where('kode_jasahead',$kode);
		return $this->db->get("glbm_jasadetail")->result();
	}

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_entryjasa', $data);
	}

	function SaveDetail($data = "")
    {
		return $this->db->insert('trnt_entryjasadetail', $data);
	}

	function UpdateHeader($data ="",$no_wo = "")
    {
		$this->db->where('no_wo', $no_wo);
        return $this->db->update('trnt_entryjasa', $data);
	}

	function DeleteDetail($no_wo = "")
    {
		$this->db->where('nomor', $no_wo);
        return $this->db->delete('trnt_entryjasadetail');
	}

	function FindDataEntryJasa($no_wo){
		$this->db->where('no_wo',$no_wo);
		return $this->db->get("find_entryjasadetail")->result();
	}

	function FindDataEntryJasaDetail($no_wo){
		$this->db->where('nomor',$no_wo);
		return $this->db->get("trnt_entryjasadetail")->result();
	}
	
	function Cancel($data ="", $no_wo = "")
    {
		$this->db->where('no_wo', $no_wo);
        return $this->db->update('trnt_entryjasa', $data);
	}

}
