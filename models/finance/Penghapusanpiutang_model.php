<?php

class Penghapusanpiutang_model extends CI_Model
{
    function namaaccount($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('glbm_accountlainlain')->result();
    }    
	
    function checkclosingacc($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from trnt_statusclosing WHERE jenis = '2' and status = '1' and periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' ")->result();   
    }

    function datafaktur($nomor)
    {
        $this->db->where('noreferensi', $nomor);
        return $this->db->get('cari_penghapusanpiutang')->result();
    }

    function getMaxNomor($nomor = "")
    {
        $this->db->select_max('nomor');
        $this->db->where("left(nomor,10)", $nomor);
        return $this->db->get('trnt_penghapusanpiutang')->row();
    }

    function savedetail($data)
    {
        return $this->db->insert('trnt_penghapusanpiutang', $data);
    }


    function getdatafind($nomor)
    {
        return $this->db->query("SELECT DISTINCT p.nomor, p.tanggal, p.nomoraccount,a.nama, p.keterangan, p.jenistransaksi, p.approve
        FROM trnt_penghapusanpiutang p
        LEFT JOIN glbm_account a ON a.nomor = p.nomoraccount
        WHERE p.nomor = '" . $nomor . "'")->result();
    }

    function getfinddetail($nomor)
    {
        return $this->db->query("select
        PC.noreferensi, PC.nilaipiutang, PC.nilaipenerimaan, COALESCE(C.nama,f.nama_customer) as nama, PC.tgltransaksi, PC.nomor_customer
        from trnt_penghapusanpiutang PC  
        LEFT JOIN glbm_customer C on C.nomor = PC.nomor_customer and PC.jenistransaksi = 51
        LEFT JOIN trnt_partcounterfaktur f on f.nomor = PC.noreferensi and PC.jenistransaksi = 52
        WHERE PC.nomor = '" . $nomor . "'")->result();
    }

    function canceltrx($data, $nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->update('trnt_penghapusanpiutang', $data);
    }

    function updatepiutang($nilai, $nomorinv)
    {

        return $this->db->query("UPDATE trnt_piutang set nilaipenerimaan = nilaipenerimaan + " . $nilai . " WHERE noreferensi = '" . $nomorinv . "'");
    }

    function updatepiutangbatal($nilai, $nomorinv)
    {

        return $this->db->query("UPDATE trnt_piutang set nilaipenerimaan = nilaipenerimaan - " . $nilai . " WHERE noreferensi = '" . $nomorinv . "'");
    }
}
