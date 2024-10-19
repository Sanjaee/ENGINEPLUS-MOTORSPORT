<?php

class Pengeluarankasir_model extends CI_Model
{
    function jenispermohonanpengeluaran($kode)
    {
        $this->db->where('kode', $kode);
        $this->db->where('jenis', 1);
        return $this->db->get('stpm_otorisasikasir')->result();
    }

    function checkApproval($nopermohonan, $kodecabang, $kodecompany)
    {
        return $this->db->query("SELECT approve FROM trnt_cadanganpembayaran WHERE nomor = '".$nopermohonan."' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' ")->result();
    }
    
    function checkclosinggl($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from stpm_statusclosing WHERE periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND closing = true")->result();   
    }
	
    function checkclosingacc($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from trnt_statusclosing WHERE jenis = '2' and status = '1' and periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' ")->result();   
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

    // function cekhutang($nomor, $jenis)
    // {
    //     return $this->db->query("SELECT * FROM trnt_hutang WHERE nilaipembayaran <> 0 AND jenistransaksi = '" . $jenis . "' AND noreferensi = '" . $nomor . "'")->result();
    // }

    function getMaxNomor($nomor = "")
    {
        $this->db->select_max('nomor');
        $this->db->where("left(nomor,10)", $nomor);
        return $this->db->get('trnt_pembayaran')->row();
    }


    function getdatabatalpart($nomor = "")
    {
        $this->db->where("nomor", $nomor);
        $this->db->where("batal", true);
        return $this->db->get('trnt_penerimaansparepart')->result();
    }

    function getdatabatalopl($nomor = "")
    {
        $this->db->where("nomor", $nomor);
        $this->db->where("batal", true);
        return $this->db->get('trnt_orderpekerjaanluar')->result();
    }

    function saveheader($data)
    {
        return $this->db->insert('trnt_pembayaran', $data);
    }

    function savedetail($data)
    {
        return $this->db->insert('trnt_pembayarandetail', $data);
    }

    function updatestatuspermohonan($nomor, $status)
    {

        if ($status == TRUE) {
            return $this->db->query("UPDATE trnt_cadanganpembayaran set pengeluaran = true WHERE nomor = '" . $nomor . "'");
        } else {
            return $this->db->query("UPDATE trnt_cadanganpembayaran set pengeluaran = false WHERE  nomor = '" . $nomor . "'");
        }
    }

    function updateumorder($data, $noreferensi, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_orderingsparepart set nilaiuangmuka = nilaiuangmuka -" . $data . " WHERE nomor = '" . $noreferensi . "'");
        } else {
            return $this->db->query("UPDATE trnt_orderingsparepart set nilaiuangmuka = nilaiuangmuka +" . $data . " WHERE nomor = '" . $noreferensi . "'");
        }
    }

    function getdatapenerimaanpart($nomor = "")
    {
        $this->db->where("nomororder", $nomor);
        $this->db->where("batal", false);
        return $this->db->get('trnt_penerimaansparepart')->result();
    }

    function updatepembayaranhutang($data, $noreferensi, $jenis, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_hutang set nilaipembayaran = nilaipembayaran -" . $data . " WHERE jenistransaksi = '" . $jenis . "' AND noreferensi = '" . $noreferensi . "'");
        } else {
            return $this->db->query("UPDATE trnt_hutang set nilaipembayaran = nilaipembayaran +" . $data . " WHERE jenistransaksi = '" . $jenis . "' AND noreferensi = '" . $noreferensi . "'");
        }
    }

    function getdatafind($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get("trnt_pembayaran")->result();
    }

    function datadetaillist($nomor)
    {
        return $this->db->query("SELECT pd.noreferensi,pd.kodesupplier,pd.namasupplier,pd.nilaipembayaran,pd.kodeaccount,pd.kodeaccount,
        a.nama as namaaccount,pd.nilaialokasi,pd.accountalokasi,pd.memo,p.kode_cabang
        FROM trnt_pembayaran p
        LEFT JOIN trnt_pembayarandetail pd ON  pd.nomorpembayaran = p.nomor
        LEFT JOIN glbm_account a ON a.nomor = pd.kodeaccount
        WHERE p.nomor = '" . $nomor . "'")->result();
    }
    function datadetaillistpermohonan($nomor)
    {
        return $this->db->query("SELECT pd.noreferensi,pd.kodesupplier,pd.namasupplier,pd.nilaipermohonan,pd.kodeaccount,pd.kodeaccount,
        a.nama as namaaccount,pd.nilaialokasi,pd.accountalokasi,pd.memo,p.kode_cabang
        FROM trnt_cadanganpembayaran p
        LEFT JOIN trnt_cadanganpembayarandetail pd ON  pd.nomorcadangan = p.nomor
        LEFT JOIN glbm_account a ON a.nomor = pd.kodeaccount
        WHERE p.nomor = '" . $nomor . "'")->result();
    }

    function headerpermohonan($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('trnt_cadanganpembayaran')->result();
    }


    function canceltrx($data, $nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->update('trnt_pembayaran', $data);
    }

    function accountpenerima($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('glbm_account')->result();
    }
}
