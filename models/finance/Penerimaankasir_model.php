<?php

class Penerimaankasir_model extends CI_Model
{
    function jenispenerimaan($kode)
    {
        $this->db->where('kode', $kode);
        $this->db->where('jenis', 0);
        return $this->db->get('stpm_otorisasikasir')->result();
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

    function caridatapenerimaan($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('caridatapenerimaankasir')->result();
    }
    function accountpenerima($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get('glbm_account')->result();
    }


    function getMaxNomor($nomor = "")
    {
        $this->db->select_max('nomor');
        $this->db->where("left(nomor,10)", $nomor);
        return $this->db->get('trnt_penerimaan')->row();
    }

    function getMaxNomorDK($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,10)",$nomor);
        return $this->db->get('trnt_piutangkartu')->row();
	}

    function getstatuswo($nomor)
    {
        return $this->db->query("select * from trnt_wo WHERE status > 0 AND nomor = '" . $nomor . "' AND BATAL = false")->result();   
    }

    function getstatuspc($nomor)
    {
        return $this->db->query("select * from trnt_partcounterorder WHERE statusfaktur = true AND nomor = '" . $nomor . "' AND BATAL = false")->result();   
    }

    function getdatafaktur($nomor)
    {
        return $this->db->query("select * from trnt_faktur WHERE nomor = '" . $nomor . "' AND BATAL = true")->result();   
    }

    function getpencairanpiutang($nomorinv, $nomor)
    {
        return $this->db->query("select * from trnt_piutangkartu WHERE noreferensi = '" . $nomorinv . "' and nomorpenerimaan = '" . $nomor . "' and nilaipenerimaan <> 0")->result();   
    }

    function saveheader($data)
    {
        return $this->db->insert('trnt_penerimaan', $data);
    }

    function savedetail($data)
    {
        return $this->db->insert('trnt_penerimaandetail', $data);
    }

    function savepiutangkartu($data)
    {
        return $this->db->insert('trnt_piutangkartu', $data);
    }

    function updatepenerimaanpiutang($data, $noreferensi, $jenis, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_piutang set nilaipenerimaan = nilaipenerimaan -" . $data . " WHERE jenistransaksi = '" . $jenis . "' AND noreferensi = '" . $noreferensi . "'");
        } else {
            return $this->db->query("UPDATE trnt_piutang set nilaipenerimaan = nilaipenerimaan +" . $data . " WHERE jenistransaksi = '" . $jenis . "' AND noreferensi = '" . $noreferensi . "'");
        }
    }

    function updatedpwo($nomor, $data, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_wo set nilaiuangmuka = nilaiuangmuka -" . $data . " WHERE nomor = '" . $nomor . "'");
        } else {
            return $this->db->query("UPDATE trnt_wo set nilaiuangmuka = nilaiuangmuka +" . $data . " WHERE nomor = '" . $nomor . "'");
        }
    }

    function updatepenerimaanorder($nilaiuang, $nomor, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_orderingsparepart set nilaiuangmuka = nilaiuangmuka +" . $nilaiuang . " WHERE nomor = '" . $nomor . "'");
        } else {
            return $this->db->query("UPDATE trnt_orderingsparepart set nilaiuangmuka = nilaiuangmuka -" . $nilaiuang . " WHERE nomor = '" . $nomor . "'");
        }
    }

    function updatedppc($nomor, $data, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_partcounterorder set nilaiuangmuka = nilaiuangmuka -" . $data . " WHERE nomor = '" . $nomor . "'");
        } else {
            return $this->db->query("UPDATE trnt_partcounterorder set nilaiuangmuka = nilaiuangmuka +" . $data . " WHERE nomor = '" . $nomor . "'");
        }
    }

    function getdatafind($nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get("trnt_penerimaan")->result();
    }

    function datadetaillist($nomor)
    {
        return $this->db->query("SELECT pd.noreferensi,pd.kodecustomer,pd.namacustomer,pd.nilaipenerimaan,pd.kodeaccount,
        a.nama as namaaccount,pd.nilaialokasi,pd.accountalokasi,pd.memo,p.kode_cabang
        FROM trnt_penerimaan p
        LEFT JOIN trnt_penerimaandetail pd ON  pd.nomorpenerimaan = p.nomor
        LEFT JOIN glbm_account a ON a.nomor = pd.kodeaccount
        WHERE p.nomor = '" . $nomor . "'")->result();
    }

    function canceltrx($data, $nomor)
    {
        $this->db->where('nomor', $nomor);
        return $this->db->update('trnt_penerimaan', $data);
    }

    function cancelpiutang($data, $nomor)
    {
        $this->db->where('nomorpenerimaan', $nomor);
        return $this->db->update('trnt_piutangkartu', $data);
    }

    function GetDataPrint($nomor){
		
        return $this->db->query("select * from form_penerimaankasir WHERE nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintDetail($nomor){
        
        return $this->db->query("select * from form_penerimaankasirdetail WHERE nomor = '" . $nomor . "'")->result();
    }
    
}
