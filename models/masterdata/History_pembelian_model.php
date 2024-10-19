<?php
class History_pembelian_model extends CI_Model
{
    function ambiltanggalkonfigurasi()
    {
        return $this->db->get("stpm_konfigurasi")->result();
    }

    function tampilhistoryap($jenisfaktur = "", $kriteria = "", $kodecabang = "", $kodecompany = "", $kodesubcabang = "", $kodegrupcabang = "")
    {
        if ($jenisfaktur == 0) {
            return $this->db->query("select * from vw_historyap_opl_summary where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and kodegrupcabang = '" . $kodegrupcabang . "' " . $kriteria . "")->result();
        } else if ($jenisfaktur == 1) {
            return $this->db->query("select * from vw_historyap_sp_summary where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and kodegrupcabang = '" . $kodegrupcabang . "' " . $kriteria . "")->result();
        }
    }

    function getdetailhistoryap($jenisfaktur = "", $nomororder = "", $nomorfaktur = "")
    {
        if ($jenisfaktur == 0) {
            return $this->db->query("select * from vw_historyap_opl_summary where nomororder = '" . $nomororder . "' and nomorfaktur = '" . $nomorfaktur . "'")->result();
        } else if ($jenisfaktur == 1) {
            return $this->db->query("select * from vw_historyap_sp_summary where nomororder = '" . $nomororder . "' and nomorfaktur = '" . $nomorfaktur . "'")->result();
        }
    }

    function GetDetailHistoryDetail($nomorfaktur, $jenisfaktur, $empty)
    {
        if ($jenisfaktur == 0) { // --- ORDER PEKERJAAN LUAR ---
            return $this->db->query("SELECT 
            opl.kode_pekerjaan as kodereferensi, opl.nama_pekerjaan as namareferensi, opl.hargabeli as harga, '1' as qty,
            '0' as persen, '0' as discount, opl.hargabeli as subtotal
            FROM trnt_orderpekerjaanluardetail opl 
            WHERE opl.nomor_opl = '" . $nomorfaktur . "'")->result();
        } else if ($jenisfaktur == 1) { // --- PEMBELIAN SPAREPARTS ---
            return $this->db->query("SELECT 
            psd.kodepart as kodereferensi, p.nama as namareferensi, psd.harga as harga, psd.qty, psd.persendiscperitem as persen,
            psd.discountperitem as discount, psd.total as subtotal
            FROM trnt_penerimaansparepartdetail psd
            left join glbm_parts p on p.kode = psd.kodepart
            WHERE psd.nomorpenerimaan = '" . $nomorfaktur . "'")->result();
        }
    }

    function gethistorypenerimaankasir($nomorfaktur)
    {
        return $this->db->query("SELECT p.nomor, p.tanggal, pd.nilaipembayaran, pd.kodeaccount, a.nama as namaaccount, p.keterangan
        from trnt_pembayaran p 
        left join trnt_pembayarandetail pd on pd.nomorpembayaran = p.nomor
        left join glbm_account a on a.nomor = pd.kodeaccount
        where pd.noreferensi = '" . $nomorfaktur . "'")->result();
    }

    
    function gethistorypenerimaankasirum($nomororder)
    {
        return $this->db->query("SELECT p.nomor, p.tanggal, pd.nilaipembayaran, pd.kodeaccount, a.nama as namaaccount, p.keterangan
        from trnt_pembayaran p 
        left join trnt_pembayarandetail pd on pd.nomorpembayaran = p.nomor
        left join glbm_account a on a.nomor = pd.kodeaccount
        where pd.noreferensi = '" . $nomororder . "'")->result();
    }

    function gethistorypembatalanpenerimaankasir($nomorfaktur)
    {
        return $this->db->query("SELECT p.nomor, p.tanggal, pd.nilaipembayaran, pd.kodeaccount, a.nama as namaaccount, p.keterangan,
        p.tglbatal, p.userbatal
        from trnt_pembayaran p 
        left join trnt_pembayarandetail pd on pd.nomorpembayaran = p.nomor
        left join glbm_account a on a.nomor = pd.kodeaccount
        where p.batal = true  AND pd.noreferensi = '" . $nomorfaktur . "'")->result();
    }

    function gethistorywo($nomororder, $nomorfaktur, $jenisfaktur)
    {
        if ($jenisfaktur == 0) { // --- GENERAL REPAIR ---
            return $this->db->query("SELECT f.nomor as nofaktur, f.tanggal, f.nomor_spk, c.nama, f.grandtotal, f.tglbatal, f.userbatal, f.keteranganbatal , f.nopolisi, kc.norangka
            from trnt_faktur f 
            left join trnt_wo w on w.nomor = f.nomor_spk
            left join glbm_customer c on c.nomor = f.nomor_customer
            left join trnt_kendaraancustomer kc on kc.norangka = w.norangka
            where f.batal = true and w.nomor = '" . $nomororder . "'")->result();
        } else if ($jenisfaktur == 1) { // --- PEMBELIAN SPAREPARTS ---
            return $this->db->query("SELECT ps.nomor as nofaktur, ps.tanggal, ps.nomororder as nomor_spk, s.nama, ps.total as grandtotal, ps.tglbatal, ps.userbatal, ps.keteranganbatal ,
            '' as nopolisi , '' as norangka 
            from trnt_orderingsparepart os 
            left join trnt_penerimaansparepart ps on ps.nomororder = os.nomor
            left join glbm_supplier s on s.nomor = os.kodesupplier
            WHERE ps.batal = true and ps.nomor = '" . $nomorfaktur . "'")->result();
        }
    }

    
    function gethistorypermohonankasir($nomorfaktur)
    {
        return $this->db->query("SELECT p.nomor, p.tanggal, pd.nilaipermohonan, pd.kodeaccount, a.nama as namaaccount, p.keterangan,
        p.pemakai
        from trnt_cadanganpembayaran p 
        left join trnt_cadanganpembayarandetail pd on pd.nomorcadangan = p.nomor
        left join glbm_account a on a.nomor = pd.kodeaccount
        where p.batal = false  AND pd.noreferensi = '" . $nomorfaktur . "'")->result();
    }

    
    function gethistorypermohonankasirum($nomororder)
    {
        return $this->db->query("SELECT p.nomor, p.tanggal, pd.nilaipermohonan, pd.kodeaccount, a.nama as namaaccount, p.keterangan,
        p.pemakai
        from trnt_cadanganpembayaran p 
        left join trnt_cadanganpembayarandetail pd on pd.nomorcadangan = p.nomor
        left join glbm_account a on a.nomor = pd.kodeaccount
        where p.batal = false  AND pd.noreferensi = '" . $nomororder . "'")->result();
    }
}
