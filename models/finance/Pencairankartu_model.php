<?php

class Pencairankartu_model extends CI_Model
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

    function getMaxNomor($nomor = "")
    {
        $this->db->select_max('nomor');
        $this->db->where("left(nomor,10)", $nomor);
        return $this->db->get('trnt_pencairanpiutangkartu')->row();
    }

    function savedetail($data)
    {
        return $this->db->insert('trnt_pencairanpiutangkartu', $data);
    }

    function savebankcharge($data)
    {
        return $this->db->insert('trnt_pencairanpiutangkartu_bankcharge', $data);
    }

    function getdatafind($nomor)
    {
        return $this->db->query("SELECT DISTINCT p.nomor,P.tanggal,P.nomor_kasiraccount,P.nomor_kasiraccountcair, coalesce(pd.bankcharge,0) as bankcharge, a.nama, P.jenispenerimaan
        FROM trnt_pencairanpiutangkartu p
        LEFT JOIN trnt_pencairanpiutangkartu_bankcharge pd ON  pd.nomor = p.nomor 
        LEFT JOIN glbm_account a ON a.nomor = p.nomor_kasiraccountcair
        WHERE p.nomor = '" . $nomor . "'")->result();
    }

    function getfinddetail($nomor)
    {
        return $this->db->query("select
        P.noreferensi, P.nomor_kasiraccount, P.nomor, P.tanggal, P.nomorpenerimaan, PC.nilaipenerimaan, COALESCE(C.nama,'') as nama, P.kode_cabang,
        case 
            when P.jenis = '3' Then 'Kartu Kredit' 
            when P.jenis = '4' Then 'Kartu Debit'
            when P.jenis = '5' Then 'Market Place'
        Else '' end as jenis
        from trnt_pencairanpiutangkartu PC  
        LEFT JOIN trnt_piutangkartu P on P.nomor = PC.noreferensi
        LEFT JOIN glbm_customer C on C.nomor = P.nomor_customer
        WHERE PC.nomor = '" . $nomor . "'")->result();
    }

    function canceltrx($data, $nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->update('trnt_pencairanpiutangkartu', $data);
    }

    function datalist($kode_cabang,$jenis, $kodesubcabang, $kodecompany)
    {   
        if ($jenis == '-'){
            if ($kode_cabang == 'ALL' && $kodesubcabang == 'ALL' ) {
                $this->db->where('kodecompany', $kodecompany);
                return $this->db->get('cari_piutangkartu')->result();
            }elseif
                ($kode_cabang != 'ALL' && $kodesubcabang == 'ALL') {
                $this->db->where('kode_cabang', $kode_cabang);
                $this->db->where('kodecompany', $kodecompany);
                return $this->db->get('cari_piutangkartu')->result();
            }else{
                $this->db->where('kode_cabang', $kode_cabang);
                $this->db->where('kodecompany', $kodecompany);
                $this->db->where('kodesubcabang', $kodesubcabang);
                return $this->db->get('cari_piutangkartu')->result();
            }
        } else {
            if ($kode_cabang == 'ALL' && $kodesubcabang == 'ALL' ) {
                $this->db->where('kodecompany', $kodecompany);
                $this->db->where('jenis2', $jenis);
                return $this->db->get('cari_piutangkartu')->result();
            }elseif
                ($kode_cabang != 'ALL' && $kodesubcabang == 'ALL') {
                $this->db->where('kode_cabang', $kode_cabang);
                $this->db->where('kodecompany', $kodecompany);
                $this->db->where('jenis2', $jenis);
                return $this->db->get('cari_piutangkartu')->result();
            }else{
                $this->db->where('kode_cabang', $kode_cabang);
                $this->db->where('kodecompany', $kodecompany);
                $this->db->where('kodesubcabang', $kodesubcabang);
                $this->db->where('jenis2', $jenis);
                return $this->db->get('cari_piutangkartu')->result();
            }
        }        
    }

    function updatepiutangkartu($nilai, $nomorinv, $nopiutang)
    {
        
        return $this->db->query("UPDATE trnt_piutangkartu set nilaipenerimaan = " . $nilai . " WHERE nomor = '" . $nopiutang . "' and noreferensi = '" . $nomorinv . "'");
        
    }

    function updatepiutangkartubatal($nilai, $nomorinv, $nopiutang)
    {
        
        return $this->db->query("UPDATE trnt_piutangkartu set nilaipenerimaan = nilaipenerimaan - " . $nilai . " WHERE nomor = '" . $nopiutang . "' and noreferensi = '" . $nomorinv . "'");
        
    }

    
}
