<?php defined('BASEPATH') or exit('No direct script access allowed');

class Saldoawalkasbank_model extends CI_Model
{
    function gettglsaldoawal()
    {
        return $this->db->get("stpm_konfigurasi")->result();
    }

    function dataaccount($nomor = "")
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get("glbm_account")->result();
    }
    function saldoawalkasbank()
    {
        return $this->db->query("SELECT tanggal,coa,description as nama ,saldoawal 
                                FROM trnt_saldoawalkasbank sakb 
                                CROSS JOIN stpm_konfigurasi kon 
                                WHERE to_char(sakb.tanggal,'YYYYMMDD')  >= to_char(kon.tglkasbank,'YYYYMMDD')
                                ORDER BY tglsimpan desc")->result();
    }

    function deletesaldo($coa = "")
    {
        $this->db->where('coa', $coa);
        return $this->db->delete("trnt_saldoawalkasbank");
    }

    function savedata($data = "")
    {
        return $this->db->insert("trnt_saldoawalkasbank", $data);
    }
}
