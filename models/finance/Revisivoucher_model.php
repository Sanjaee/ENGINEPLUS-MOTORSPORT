<?php

class Revisivoucher_model extends CI_Model
{
    function namaaccount($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('glbm_account')->result();
    }
    
    function checkclosinggl($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from stpm_statusclosing WHERE periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND closing = true")->result();   
    }

    function checkclosingacc($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from trnt_statusclosing WHERE jenis = '2' and status = '1' and periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' ")->result();   
    }

    function namaaccountlain($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('glbm_accountlainlain')->result();
    }

    function departemen($kode)
    {
        $this->db->where('kode', $kode);
        return $this->db->get('glbm_departement')->result();
    }    

    function datalist($kodecompany,$jenis, $tglawal, $tglakhir, $kode_cabang)
    {   
        return $this->db->query("SELECT * FROM acc_vw_revisivoucherheader where kode_cabang = '" . $kode_cabang . "' and kodecompany = '" . $kodecompany . "' and jenis = '" . $jenis . "' and  to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglawal)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" .date('Ymd', strtotime($tglakhir)) . "'")->result();
    }

    function datadetail($nomor)
    {   
        return $this->db->query("SELECT * FROM acc_vw_revisivoucherdetail where noinvoice = '" . $nomor . "'")->result();
    }

    function verifybtuheader($data = "", $novoucher = "")
    {
        $this->db->where('nomor', $novoucher);
        return $this->db->update('trnt_penerimaan', $data);
    }

    function verifybtudetail($data = "", $novoucher = "", $norefx = "")
    {
        $this->db->where('nomorpenerimaan', $novoucher);
        $this->db->where('noreferensi', $norefx);
        return $this->db->update('trnt_penerimaandetail', $data);
    }

    function verifybkuheader($data = "", $novoucher = "")
    {
        $this->db->where('nomor', $novoucher);
        return $this->db->update('trnt_pembayaran', $data);
    }

    function verifybkudetail($data = "", $novoucher = "", $norefx = "")
    {
        $this->db->where('nomorpembayaran', $novoucher);
        $this->db->where('noreferensi', $norefx);
        return $this->db->update('trnt_pembayarandetail', $data);
    }

    function verifypcheader($data = "", $novoucher = "")
    {
        $this->db->where('nomor', $novoucher);
        return $this->db->update('trnt_pencairanpiutangkartu', $data);
    }

    function verifypcdetail($data = "", $novoucher = "", $norefx = "")
    {
        $this->db->where('nomor', $novoucher);
        $this->db->where('noreferensi', $norefx);
        return $this->db->update('trnt_pencairanpiutangkartu', $data);
    }

    
}
