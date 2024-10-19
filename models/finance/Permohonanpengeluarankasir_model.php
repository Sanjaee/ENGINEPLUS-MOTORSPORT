<?php

class Permohonanpengeluarankasir_model extends CI_Model
{
    function jenispermohonanpengeluaran($kode)
    {
        $this->db->where('kode', $kode);
        $this->db->where('jenis', 1);
        return $this->db->get('stpm_otorisasikasir')->result();
    }

    function departemen($kode)
    {
        $this->db->where('kode', $kode);
        return $this->db->get('glbm_departement')->result();
    }

    function datacoa($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('glbm_accountlainlain')->result();
    }

    function caridatacadanganpembayaran($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('caridatapermohonanpengeluarankasir')->result();
    }

    function tampildatapermohonanpengeluarankasir($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('tampildatapermohonanpengeluarankasir')->result();
    }

    function accountpembayaran($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('glbm_account')->result();
    }

    function getpengeluaran($nomor)
    {
        $this->db->where('nomorpermohonan', $nomor);
        $this->db->where('batal',false);
        return $this->db->get('trnt_pembayaran')->result();
    }

    function cekhutang($nomor, $jenis)
    {
        return $this->db->query("SELECT * FROM trnt_hutang WHERE nilaipembayaran <> 0 AND jenistransaksi = '" . $jenis . "' AND noreferensi = '" . $nomor . "'")->result();
    }

    function getMaxNomor($nomor = "")
    {
        $this->db->select_max('nomor');
        $this->db->where("left(nomor,10)", $nomor);
        return $this->db->get('trnt_cadanganpembayaran')->row();
    }

    function getdatabatalpart($nomor = "")
    {
        $this->db->where("nomor", $nomor);
        $this->db->where("batal", true);
        return $this->db->get('trnt_penerimaansparepart')->result();
    }

    function getdatapenerimaanpart($nomor = "")
    {
        $this->db->where("nomororder", $nomor);
        $this->db->where("batal", false);
        return $this->db->get('trnt_penerimaansparepart')->result();
    }

    function cekpengeluaran($nomor = "")
    {

        
        return $this->db->query("select * from trnt_pembayaran 
        where nomorpermohonan = '" . $nomor . "' and batal = false")->result();
    
        // $this->db->where("nomor", $nomor);
        // $this->db->where("batal", false);
        // $this->db->where("pengeluaran", false);
        // return $this->db->get('trnt_cadanganpengeluaran')->result();
    }

    function getdatabatalopl($nomor = "")
    {
        $this->db->where("nomor", $nomor);
        $this->db->where("batal", true);
        return $this->db->get('trnt_orderpekerjaanluar')->result();
    }

    function saveheader($data)
    {
        return $this->db->insert('trnt_cadanganpembayaran', $data);
    }

    function savedetail($data)
    {
        return $this->db->insert('trnt_cadanganpembayarandetail', $data);
    }

    function updatepembayaranhutang($data, $noreferensi, $jenis, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_hutang set nilaicadanganpembayaran = nilaicadanganpembayaran -" . $data . " WHERE jenistransaksi = '" . $jenis . "' AND noreferensi = '" . $noreferensi . "'");
        } else {
            return $this->db->query("UPDATE trnt_hutang set nilaicadanganpembayaran = nilaicadanganpembayaran +" . $data . " WHERE jenistransaksi = '" . $jenis . "' AND noreferensi = '" . $noreferensi . "'");
        }
    }

    function getdatafind($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get("trnt_cadanganpembayaran")->result();
    }

    function datadetaillist($nomor)
    {
        return $this->db->query("SELECT pd.noreferensi,pd.kodesupplier,pd.namasupplier,pd.nilaipermohonan,pd.kodeaccount,pd.kodeaccount,
        a.nama as namaaccount,pd.nilaialokasi,pd.accountalokasi,pd.memo,p.kode_cabang
        FROM trnt_cadanganpembayaran p
        LEFT JOIN trnt_cadanganpembayarandetail pd ON  pd.nomorcadangan = p.nomor
        LEFT JOIN glbm_account a ON a.nomor = pd.kodeaccount
        WHERE p.nomor = '" . $nomor . "'")->result();
    }

    function canceltrx($data, $nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->update('trnt_cadanganpembayaran', $data);
    }

    function accountpenerima($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('glbm_account')->result();
    }

    function GetDataPrint($nomor){
		
        return $this->db->query("SELECT * FROM form_permohonanuang WHERE nomor = '" . $nomor . "'")->result();
    }
    
    function GetDataPrintDetail($nomor){
		
        return $this->db->query("SELECT * FROM form_permohonanuangdetail WHERE nomor = '" . $nomor . "'")->result();
	}

    function updatepiutang($data, $noreferensi, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_piutang set nilaiuangmuka = nilaiuangmuka +" . $data . " WHERE noreferensi = '" . $noreferensi . "'");
        } else {
            return $this->db->query("UPDATE trnt_piutang set nilaiuangmuka = nilaiuangmuka -" . $data . " WHERE noreferensi = '" . $noreferensi . "'");
        }
    }
}
