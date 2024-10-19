<?php

class Approval_permohonanuang_model extends CI_Model
{
    function getDataHeader($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get("trnt_cadanganpembayaran")->result();
    }

    function getDataHeaderWO($nopolisi)
    {
        $this->db->where('nopolisi', $nopolisi);
        return $this->db->get("trnt_wo")->result();
    }

    function getkodeapprove($nopolisi)
    {
        $this->db->where('nopolisi', $nopolisi);
        return $this->db->get("vw_ij_srvpart_getdatakendaraan")->result();
    }

    function approvePermohonan($data, $nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->update("trnt_cadanganpembayaran", $data);
    }

    function approveWO($data, $nopolisi)
    {
        $this->db->where('nopolisi', $nopolisi);
        return $this->db->update("trnt_kendaraancustomer", $data);
    }
}
