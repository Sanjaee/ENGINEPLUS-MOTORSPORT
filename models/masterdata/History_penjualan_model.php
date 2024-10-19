<?php
class History_penjualan_model extends CI_Model
{
    function ambiltanggalkonfigurasi()
    {
        return $this->db->get("stpm_konfigurasi")->result();
    }

    function tampilhistoryar($jenisfaktur = "", $kriteria = "", $kodecabang = "", $kodecompany = "", $kodesubcabang = "", $kodegrupcabang = "")
    {
        if ($jenisfaktur == 0) {
            return $this->db->query("select * from vw_historyar_gr_summary where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and kodegrupcabang = '" . $kodegrupcabang . "' " . $kriteria . "")->result();
        } else if ($jenisfaktur == 1) {
            return $this->db->query("select * from vw_historyar_sp_summary where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and kodegrupcabang = '" . $kodegrupcabang . "' " . $kriteria . "")->result();
        }
    }

    function getdetailhistoryar($jenisfaktur = "", $nomororder = "", $nomorfaktur = "")
    {
        if ($jenisfaktur == 0) {
            return $this->db->query("select * from vw_historyar_gr_summary where nomororder = '" . $nomororder . "' and nomorfaktur = '" . $nomorfaktur . "'")->result();
        } else if ($jenisfaktur == 1) {
            return $this->db->query("select * from vw_historyar_sp_summary where nomororder = '" . $nomororder . "' and nomorfaktur = '" . $nomorfaktur . "'")->result();
        }
    }

    function getdetailhistoryjasa($nofaktur, $jenisfaktur, $empty)
    {
        if ($jenisfaktur == 0) { // --- GENERAL REPAIR ---
            return $this->db->query("SELECT 
            F.kodereferensi, F.namareferensi, F.qty, F.harga, F.persendiscperitem, F.discperitem,  F.subtotal 
            FROM trnt_fakturdetail F 
            WHERE F.nomorfaktur = '" . $nofaktur . "' AND F.jenis = 2")->result();
        } else if ($jenisfaktur == 1) { // --- Part counter ---
            return $this->db->query("")->result();
        }
    }

    function getdetailhistorysparepart($nofaktur, $jenisfaktur)
    {
        if ($jenisfaktur == 0) { // --- GENERAL REPAIR ---
            return $this->db->query("SELECT 
            F.kodereferensi, F.namareferensi, F.qty, F.harga, F.persendiscperitem, F.discperitem,  F.subtotal 
            FROM trnt_fakturdetail F 
            WHERE F.nomorfaktur = '" . $nofaktur . "' AND F.jenis = 1")->result();
        } else if ($jenisfaktur == 1) { // --- PART COUNTER ---
            return $this->db->query("SELECT 
            f.kode_parts as kodereferensi, p.nama as namareferensi, f.qty, f.harga, f.persendiscperitem, f.discountperitem as discperitem, f.subtotal from trnt_partcounterfakturdetail f 
            left join trnt_partcounterfaktur fp on fp.nomor = f.nomor_faktur
            left join glbm_parts p on p.kode = f.kode_parts and p.kodecabang = fp.kode_cabang
            WHERE f.nomor_faktur = '" . $nofaktur . "'")->result();
        }
    }

    function getdetailpembebanansparepart($nowo, $jenisfaktur)
    {
        if ($jenisfaktur == 0) { // --- GENERAL REPAIR ---
            return $this->db->query("SELECT 
            pp.nomor, pp.tanggal, ppd.kodepart as nomor_parts, p.nama as nama_parts, ppd.qty, ppd.hargasatuan as hargajual,
            ppd.subtotal, pp.batal, pp.pemakai
            FROM trnt_pembebananparts pp
            LEFT JOIN trnt_pembebananpartsdetail ppd on ppd.nomorpembebanan = pp.nomor
            LEFT JOIN glbm_parts p on p.kode = ppd.kodepart and p.kodecabang = pp.kode_cabang
            WHERE pp.nomorwo = '" . $nowo . "'")->result();
        } else if ($jenisfaktur == 1) { // --- PART COUNTER ---
            return $this->db->query("SELECT fp.nomor, fp.tanggal , f.kode_parts as nomor_parts, p.nama as nama_parts, f.qty, f.harga as hargajual, f.subtotal, fp.batal, fp.userbatal as pemakai from trnt_partcounterorderdetail f 
            left join trnt_partcounterorder fp on fp.nomor = f.nomor_order
            left join glbm_parts p on p.kode = f.kode_parts and p.kodecabang = fp.kode_cabang
            WHERE fp.nomor = '" . $nowo . "'")->result();
        }
    }
    function getdetailhistoryopl($nofaktur, $jenisfaktur)
    {
        if ($jenisfaktur == 0) { // --- GENERAL REPAIR ---
            return $this->db->query("SELECT 
            F.kodereferensi, F.namareferensi, F.qty, F.harga, F.persendiscperitem, F.discperitem,  F.subtotal 
            FROM trnt_fakturdetail F 
            WHERE F.nomorfaktur = '" . $nofaktur . "' AND F.jenis = 3")->result();
        } else if ($jenisfaktur == 1) { // --- PART COUNTER ---
            return $this->db->query("")->result();
        }
    }

    function gethistoryopl($nowo, $jenisfaktur)
    {
        if ($jenisfaktur == 0) { // --- GENERAL REPAIR ---
            return $this->db->query("
            SELECT 
            opl.nomor, opl.tanggal , opld.kode_pekerjaan, lopl.nama as nama_opl, opld.hargajual, opl.batal, opl.pemakai
            FROM trnt_orderpekerjaanluar opl
            LEFT JOIN trnt_orderpekerjaanluardetail opld on opld.nomor_opl = opl.nomor
            LEFT JOIN glbm_jasaopl lopl on lopl.kode = opld.kode_pekerjaan
            WHERE opl.nomor_wo = '" . $nowo . "'")->result();
        } else if ($jenisfaktur == 1) { // --- PART COUNTER ---
            return $this->db->query("")->result();
        }
    }

    function gethistorypenerimaankasir($nofaktur, $nomororder)
    {
        return $this->db->query("SELECT p.nomor, pd.noreferensi, p.tanggal, pd.nilaipenerimaan, pd.nilaialokasi, pd.kodeaccount, ka.nama as namacoa, pd.accountalokasi, COALESCE(ka2.nama,'') as namaalokasi,
        case when p.jenispenerimaan = '1' then 'Tunai' when p.jenispenerimaan = '2' then 'Transfer' when p.jenispenerimaan = '3' then 'Kartu Debit' when p.jenispenerimaan = '4' then 'Kartu Kredit' when p.jenispenerimaan = '5' then 'Marketplace' end as jenisterima,
        CASE p.jenistransaksi				
                WHEN '01' THEN 'UANG MUKA SERVICE'
                WHEN '02' THEN 'UANG MUKA PART COUNTER'
                WHEN '51' THEN 'PELUNASAN SERVICE'
                WHEN '52' THEN 'PELUNASAN PART COUNTER'
                WHEN '53' THEN 'RETUR PARTS'
                WHEN '54' THEN 'MEMO KELEBIHAN PEMBAYARAN UANG MUKA PART'
        End as jenistransaksi, p.keterangan
        from trnt_penerimaan p 
        left join trnt_penerimaandetail pd on pd.nomorpenerimaan = p.nomor
        left join glbm_accountlainlain ka on ka.nomor = pd.kodeaccount
        left join glbm_accountlainlain ka2 on ka2.nomor = pd.accountalokasi
        where (pd.noreferensi = '" . $nomororder . "' or pd.noreferensi = '" . $nofaktur . "')")->result();
    }

    function gethistorypembatalanpenerimaankasir($nofaktur, $nomororder)
    {
        return $this->db->query("SELECT p.nomor, pd.noreferensi, p.tanggal, pd.nilaipenerimaan, pd.nilaialokasi, pd.kodeaccount, ka.nama as namacoa, pd.accountalokasi, COALESCE(ka2.nama,'') as namaalokasi,
        case when p.jenispenerimaan = '1' then 'Tunai' when p.jenispenerimaan = '2' then 'Transfer' when p.jenispenerimaan = '3' then 'Kartu Debit' when p.jenispenerimaan = '4' then 'Kartu Kredit' when p.jenispenerimaan = '5' then 'Marketplace' end as jenisterima,
        CASE p.jenistransaksi				
                WHEN '01' THEN 'UANG MUKA SERVICE'
                WHEN '02' THEN 'UANG MUKA PART COUNTER'
                WHEN '51' THEN 'PELUNASAN SERVICE'
                WHEN '52' THEN 'PELUNASAN PART COUNTER'
                WHEN '53' THEN 'RETUR PARTS'
                WHEN '54' THEN 'MEMO KELEBIHAN PEMBAYARAN UANG MUKA PART'
        End as jenistransaksi, p.keterangan,
        case when p.batal = true then 'Batal' else 'Tidak Batal' end as statusbatal,
        p.tglbatal, p.userbatal
        from trnt_penerimaan p 
        left join trnt_penerimaandetail pd on pd.nomorpenerimaan = p.nomor
        left join glbm_accountlainlain ka on ka.nomor = pd.kodeaccount
        left join glbm_accountlainlain ka2 on ka2.nomor = pd.accountalokasi
        where p.batal = true and (pd.noreferensi = '" . $nomororder . "' or pd.noreferensi = '" . $nofaktur . "')")->result();
    }

    function gethistorywo($nowo, $jenisfaktur)
    {
        if ($jenisfaktur == 0) { // --- GENERAL REPAIR ---
            return $this->db->query("SELECT f.nomor as nofaktur, f.tanggal, f.nomor_spk, c.nama, f.grandtotal, f.tglbatal, f.userbatal, f.keteranganbatal , f.nopolisi from trnt_faktur f 
            left join trnt_wo w on w.nomor = f.nomor_spk
            left join glbm_customer c on c.nomor = f.nomor_customer
            left join trnt_kendaraancustomer kc on kc.norangka = w.norangka
            where f.batal = true and w.nomor = '" . $nowo . "'")->result();
        } else if ($jenisfaktur == 1) { // --- PART COUNTER ---
            return $this->db->query("SELECT f.nomor as nofaktur, f.tanggal, f.nomor_order as nomor_spk, COALESCE(c.nama,f.nama_customer) as nama, f.total as grandtotal, f.tglbatal, f.userbatal, f.keteranganbatal , f.nopolisi 
            from trnt_partcounterfaktur f 
            left join trnt_partcounterorder w on w.nomor = f.nomor_order
            left join glbm_customer c on c.nomor = f.nomor_customer
            WHERE f.batal = true and w.nomor = '" . $nowo . "'")->result();
        }
    }
}
