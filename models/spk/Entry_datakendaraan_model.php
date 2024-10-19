<?php

class Entry_datakendaraan_model extends CI_Model
{
	function cekWO($nopolisi)
	{
		return $this->db->query("SELECT
									count(w.nopolisi) as nopolisi
								FROM
									trnt_wo w
								WHERE
									w.nopolisi = '".$nopolisi."'
									AND w.status = '0' OR w.status = '1'")->result();
	}

	function cekApprove($nopolisi)
	{
		return $this->db->query("SELECT nopolisi, approve FROM trnt_kendaraancustomer WHERE nopolisi = '".$nopolisi."' AND approve = '0'")->result();
	}

	function updateApprove($nopolisi)
	{
		return $this->db->query("UPDATE trnt_kendaraancustomer set approve = '0' WHERE nopolisi = '".$nopolisi."'");
	}

	function GetSN($nomor = ""){
		$this->db->where('nopolisi',$nomor);
		return $this->db->get("trnt_kendaraancustomer")->result();
	}

	function GetTipe($nomor = ""){
		$this->db->where('kode',$nomor);
		return $this->db->get("glbm_tipe")->result();
	}

	function GetCustomer($nomor = ""){
		$this->db->where('nomor',$nomor);
		return $this->db->get("glbm_customer")->result();
	}

	function GetProduct($nomor = ""){
		$this->db->where('kode',$nomor);
		return $this->db->get("glbm_product")->result();
	}

	function getKelurahan($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_kodepos")->result();
	}

	function getwarna($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_warna")->result();
	}

	function GetMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,1)",$nomor);
        return $this->db->get('glbm_customer')->row();
	}


	function CekNopol($nopolisi){
		$this->db->where('nopolisi',$nopolisi);
		return $this->db->get("trnt_kendaraancustomer")->result();
	}

	function GetDataFindDetail($nopolisi, $norangka, $kodecompany, $kodecabang, $kodegrup){
		return $this->db->query("select W.*,G.nama, case when W.jenisservice = 0 then 'SBI' when W.jenisservice = 1 then 'SBE' 
		when W.jenisservice = 2 then 'GR' else 'EM' end as jenis, CASE
		WHEN W.status = '0' THEN 'WO OPEN'
		WHEN W.status = '1' THEN 'WO CLOSE'
		WHEN W.status = '2' THEN 'FAKTUR'
		WHEN W.status = '3' THEN 'FAKTUR'
		ELSE '' end as statuswo from trnt_wo W 
		Left Join glbm_customer G on G.nomor = W.nomor_customer 
		where (W.nopolisi = '" . $nopolisi . "' or W.norangka =  '" . $norangka . "')
		and (w.kode_cabang = '" . $kodecabang . "') and W.batal = false")->result();
	}

	function SaveCustomer($data = "")
    {
		return $this->db->insert('glbm_customer', $data);
	}

	function getSaranKendaraan($nopolisi = "")
    {
        return $this->db->query("SELECT keterangan,nomorwo, nopolisi from trnt_closewo where batal = false and nopolisi = '" . $nopolisi . "' 
		order by tanggal desc limit 1")->result();
    }

	function SaveHeader($data = "")
    {
		return $this->db->insert('trnt_kendaraancustomer', $data);
	}

	function UpdateHeader($data ="",$nopolisi = "")
    {
		$this->db->where('nopolisi', $nopolisi);
        return $this->db->update('trnt_kendaraancustomer', $data);
	}

	function UpdateCustomer($data ="",$nocustomer = "")
    {
		$this->db->where('nomor', $nocustomer);
        return $this->db->update('glbm_customer', $data);
	}

	function GantiNopol($data ="",$nopollama = "")
    {
		$this->db->where('nopolisi', $nopollama);
        return $this->db->update('trnt_kendaraancustomer', $data);
	}

	function UpdateNoPolWO($data ="",$nopollama = "")
    {
		$this->db->where('nopolisi', $nopollama);
        return $this->db->update('trnt_wo', $data);
	}

	function UpdateNoPolBook($data ="",$nopollama = "")
    {
		$this->db->where('nopolisi', $nopollama);
        return $this->db->update('trnt_bookingservice', $data);
	}

	function UpdateNoPolClose($data ="",$nopollama = "")
    {
		$this->db->where('nopolisi', $nopollama);
        return $this->db->update('trnt_closewo', $data);
	}

	function UpdateNoPolFaktur($data ="",$nopollama = "")
    {
		$this->db->where('nopolisi', $nopollama);
        return $this->db->update('trnt_faktur', $data);
	}

	function InsertHistory($nopolbaru ="",$nopollama = "")
	{
		return $this->db->query("INSERT INTO trnt_historykendaraancustomer 
		select '" . $nopolbaru . "',nopolisi,norangka,nomesin,tahunpembuatan,transmisi,kodetipe,namatipe,
		kodewarna,namawarna,nomor_customer,odmeterakhir,pemakai,CURRENT_DATE,namapic,
		nohppic,email,kode_cabang from trnt_kendaraancustomer where  nopolisi = '" . $nopollama . "'");
	}
}

?>