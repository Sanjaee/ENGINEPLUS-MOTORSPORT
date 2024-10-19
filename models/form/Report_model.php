<?php

class Report_model extends CI_Model
{
    function GetUrl($jenis = "")
    {
        $this->db->where('index', $jenis);
        return $this->db->get("stpm_report")->result();
    }

    function cekprintpdf($namareport, $grup)
    {
        $this->db->where('nama_report', $namareport);
        $this->db->where('grup', $grup);
        return $this->db->get("stpm_report")->result();
    }


    function cekstatustanggal($namareport, $grup)
    {
        $this->db->where('nama_report', $namareport);
        $this->db->where('grup', $grup);
        return $this->db->get("stpm_report")->result();
    }

	function GetReportPeriodeTgl($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname, $kodegrup, $kodesubcabang)
    {
        if (($kodecabang == "ALL" || $kodecabang == '') && $kodesubcabang == "ALL" && $kodegrup == "ALL") { //TAM
            return $this->db->query("select * from $viewname where  kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  order by tanggal")->result();
        } else if (($kodecabang == $kodegrup || $kodecabang == '') && $kodesubcabang == "ALL" && $kodegrup != "ALL") { //HO CABANG
            return $this->db->query("select * from $viewname where kode_cabang in (select kode from glbm_cabang where kodegrup = '" . $kodegrup . "') and  kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  order by tanggal")->result();
        } else if (($kodecabang != "ALL" || $kodecabang == '') && $kodesubcabang == "ALL") { //CABANG
            return $this->db->query("select * from $viewname where kode_cabang  = '" . $kodecabang . "' and  kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  order by tanggal")->result();
        } else { //SUBCABANG ATAU THS
            return $this->db->query("select * from $viewname where kode_cabang  = '" . $kodecabang . "' and  kodesubcabang = '" . $kodesubcabang . "' and kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  order by tanggal")->result();
        }
        //return $this->db->query("select * from $viewname where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  order by tanggal")->result();
    }

    function GetReportPenerimaan($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT RP.nopenerimaan, RP.status, RP.jenispenerimaan, RP.noreferensi, RP.debit, RP.kredit,
        RP.namaaccount, RP.tglpenerimaan,
        SUM(RP.debit - RP.kredit) as totalpenerimaan, RP.kode_cabang, RP.kodesubcabang, RP.kodecompany, RP.memo, RP.keterangan
        FROM $viewname RP
        WHERE to_char(tglpenerimaan,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tglpenerimaan,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  and RP.kode_cabang = '" . $kodecabang . "' and RP.kodecompany = '" . $kodecompany . "'
        group by RP.nopenerimaan, RP.status, RP.jenispenerimaan, RP.noreferensi, RP.namaaccount, RP.tglpenerimaan,RP.debit, 
        RP.kredit, RP.kode_cabang, RP.kodesubcabang, RP.kodecompany, RP.memo, RP.keterangan
        order by rp.tglpenerimaan
        ")->result();
    }

    function GetTotalPenerimaan($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(RP.debit - RP.kredit) as totalpenerimaan
        FROM $viewname RP
        WHERE to_char(tglpenerimaan,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tglpenerimaan,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and RP.kode_cabang = '" . $kodecabang . "' and RP.kodecompany = '" . $kodecompany . "' 
        group by RP.kode_cabang,  RP.kodecompany")->result();
    }

    function GetReportPengeluaran($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT RP.nopembayaran, RP.status, RP.jenispengeluaran, RP.nopermohonan, RP.noreferensi, RP.namareferensi, RP.debit, RP.kredit,
        RP.noaccount, RP.namaaccount, RP.tglpengeluaran,SUM(RP.debit-RP.kredit) as totalpengeluaran, RP.kode_cabang, RP.kodesubcabang, RP.kodecompany
        , RP.memo, RP.keterangan
        FROM $viewname RP
        WHERE to_char(RP.tglpengeluaran,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(RP.tglpengeluaran,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and RP.kode_cabang = '" . $kodecabang . "' and RP.kodecompany = '" . $kodecompany . "' 
        group by RP.nopembayaran, RP.status, RP.jenispengeluaran, RP.nopermohonan, RP.noreferensi, RP.namareferensi, RP.debit, RP.kredit,
        RP.noaccount, RP.namaaccount, RP.tglpengeluaran, RP.kode_cabang, RP.kodesubcabang, RP.kodecompany,  RP.memo, RP.keterangan
        order by RP.tglpengeluaran")->result();
    }

    function GetTotalPengeluaran($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(RP.debit - RP.kredit) as totalpengeluaran
        FROM $viewname RP
        WHERE to_char(RP.tglpengeluaran,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(RP.tglpengeluaran,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and RP.kode_cabang = '" . $kodecabang . "' and RP.kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetReportSpk($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetTotalSpk($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(WO.nilaispk) as totalnilaispk
        FROM $viewname WO
        WHERE to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  and WO.kode_cabang = '" . $kodecabang . "' and WO.kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetReportFaktur($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetTotalFaktur($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(FD.nilaifaktur) as totalfaktur
        FROM $viewname FD
        WHERE to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  and FD.kode_cabang = '" . $kodecabang . "' and FD.kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetReportFakturCounter($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'   and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetTotalFakturCounter($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(FD.total) as totalfaktur
        FROM $viewname FD
        WHERE to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and FD.kode_cabang = '" . $kodecabang . "' and FD.kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetReportFakturPenerimaan($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetTotalFakturPenerimaan($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(tunai) as totaltunai,SUM(debit) as totaldebit,SUM(kredit) as totalkredit,SUM(bank) as totalbank, 
        SUM(marketplace) as totalmarketplace
        FROM $viewname
        WHERE to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetHistorySparepart($tglmulai, $tglakhir, $kodepart, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where replace(kodepart,'/','') = '" . $kodepart . "' AND kode_cabang = '" . $kodecabang . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetTotalHistorySparepart($tglmulai, $tglakhir, $kodepart, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(FD.qty) as totalqty
        FROM $viewname FD
        WHERE replace(FD.kodepart,'/','') = '" . $kodepart . "' AND kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
    }

    function GetReportPembebanan($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
    }

    function GetReportBooking($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND to_char(tanggalbooking,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggalbooking,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
    }

    function GetReportInventoryStockPart($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND periode = '" . date('Ym', strtotime($tglmulai)) . "'  ")->result();
    }

    function GetTotalInventorySTock($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(subtotal) as grandtotal,
        SUM(harga) as totalnilai,
        SUM(qty) as totalqty
        FROM $viewname 
        WHERE kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND periode = '" . date('Ym', strtotime($tglmulai)) . "'")->result();
    }

	function GetCabang($kodegrup, $kodecabang)
    {
        if (($kodecabang == "ALL" || $kodecabang == '') && $kodegrup == "ALL") { //TAM
            return $this->db->query("SELECT * FROM glbm_cabang")->result();
        } else if (($kodecabang == $kodegrup || $kodecabang == '') && $kodegrup != "ALL") { //HO CABANG
            return $this->db->query("SELECT * FROM glbm_cabang where kodegrup = '" . $kodegrup . "' ")->result();
        } else if (($kodecabang != "ALL" || $kodecabang == '')) { //CABANG
            return $this->db->query("SELECT * FROM glbm_cabang where kode  = '" . $kodecabang . "' ")->result();
        } else { //SUBCABANG ATAU THS
            return $this->db->query("SELECT * FROM glbm_cabang where kode  = '" . $kodecabang . "' ")->result();
        }
    }

	function GetCabangGet($kodegrup, $kodecabang)
    {
        return $this->db->query("SELECT * FROM glbm_cabang where kode  = '" . $kodecabang . "' ")->result();
    }

    function GetMasterJasa()
    {
        return $this->db->query("SELECT *,case kategori 
        when 1 then 'PAKET SERVICE'	
        when 2 then 'INTERNAL ENGINE & ENGINE SUPPORT'
        when 3 then 'ENGINE BLUEPRINTING'
        when 4 then 'INTAKE & EXHAUST SYSTEM'
        when 5 then 'TURBO SYSTEM'
        when 6 then 'COOLING SYSTEM'
        when 7 then 'FUEL & EMISSION  SYSTEM'
        when 8 then 'ELECTRICAL'
        when 9 then 'AC SYSTEM'
        when 10 then 'STEERING & WHEEL SYSTEM'
        when 11 then 'TRANSAXLE SYSTEM'
        when 12 then 'SUSPENSION SYSTEM'
        when 13 then 'BRAKE SYSTEM'
        when 14 then 'UNDERCARRIAGE'
        when 15 then 'LUBRICATION SYSTEM'
        when 16 then 'INTERIOR & EXTERIOR BODY'
        when 17 then 'FABRICATION'
        when 18 then 'VENDOR LUAR'
        when 19 then 'DYNO'	
        when 20 then 'OTHERS'
        when 21 then '3D DESIGN'
        when 22 then '3D SCAN'
        when 23 then 'CMM'
        else '' end as kategorix  FROM glbm_jasa")->result();
    }

    function GetMasterJasaDetail()
    {
        return $this->db->query("select jd.kode_jasahead, j.nama, jd.kode_jasa , jd.nama_jasa from glbm_jasadetail	jd
        left join glbm_jasa j on j.kode = jd.kode_jasahead")->result();
    }

    function GetReportBAG($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where kode_cabang = '" . $kodecabang . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetReportOrderCounter($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'   and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetReportWObelumFaktur($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
    }

    // ---------------- Data Models Form Export ------------------
    function GetSPKDetail($tglmulai, $tglakhir, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from export_wofaktur where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
    }

    function GetARdetail($kodecabang, $kodecompany)
    {
        return $this->db->query("select * from export_outstandingar  where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
    }

    function GetAPdetail($kodecabang, $kodecompany)
    {
        return $this->db->query("select * from export_outstandingap  where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
    }

    function GetReportMasterPart($kodecabang, $kodecompany, $periode)
    {
        return $this->db->query("select ps.kode as kodepart,ps.nama, ps.hargabeli, ps.hargajual,ps.lokasi,ps.satuan,
        CASE kategori 
            WHEN 1 THEN 'INTERNAL ENGINE'
            WHEN 2 THEN 'EXTERNAL ENGINE'
            WHEN 3 THEN 'INTAKE & EXHAUST SYSTEM'
            WHEN 4 THEN 'COOLING SYSTEM'
            WHEN 5 THEN 'FUEL SYSTEM'
            WHEN 6 THEN 'ELECTRICAL'
            WHEN 7 THEN 'AIR CONDITIONER SYSTEM'
            WHEN 8 THEN 'STEERING & WHEEL'
            WHEN 9 THEN 'TRANSMISI'
            WHEN 10 THEN 'BRAKE SYSTEM'
            WHEN 11 THEN 'UNDERCARRIAGE'
            WHEN 12 THEN 'OIL & CHEMICAL'
            WHEN 13 THEN 'BODY PART'
            WHEN 14 THEN 'HOSE'
            WHEN 15 THEN 'CLAMP'
            WHEN 16 THEN 'FITTING'
            WHEN 17 THEN 'OTHER'
            WHEN 18 THEN 'SUSPENSION SYSTEM'
            WHEN 19 THEN '3D PRINTED'
            WHEN 20 THEN 'MERCHANDISE'
            WHEN 21 THEN 'CNC'
            WHEN 22 THEN 'CARBON'
            ELSE 'Other'
	    END AS kategoripartworkshop,
	    
        CASE ps.kategorips
            when 1 then 'DIXCEL'
            when 2 then 'DLL'
            when 3 then 'DW'
            when 4 then 'E+'
            when 5 then 'EDEL'
            when 6 then 'FUELTECH'
            when 7 then 'HARDRACE'
            when 8 then 'HYBRID RACING'
            when 9 then 'OEM'
            when 10 then 'POWER ENTERPRIZE'
            when 11 then 'PRL'
            when 12 then 'TURBO GUARD'
            when 13 then 'TURBOSMART'
            when 14 then 'GUDANG PLUIT'
            when 16 then 'T-SHIRT'
            WHEN 17 THEN 'CNC'
            WHEN 18 THEN 'CARBON'
            ELSE 'Other' 
        END AS kategorips,
        COALESCE(p.qtyawal+p.qtymasuk - p.qtykeluar,0) as stock,
        case when ps.aktif = true then 'aktif' else 'non aktif' end as active
        from glbm_parts ps            
        left join trnt_stockparts p on p.kodepart = ps.kode and p.kode_cabang = ps.kodecabang  and p.kodecompany = ps.kodecompany  AND p.periode = '" . $periode . "'
        where ps.kodecabang = '" . $kodecabang . "' AND ps.kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetReportMasterOpl($kodecabang, $kodecompany)
    {
        return $this->db->query("select * from glbm_jasaopl")->result();
    }

    function GetReportMasterJasaTipe($kodecabang, $kodecompany)
    {
        return $this->db->query("select j.kodeproduct, p.nama as namamodel, jp.kode as kodejasa, jp.nama as namajasa,
        j.jam, j.frt, j.harga from glbm_jasatipe j 
        left join glbm_jasa jp on jp.kode = j.kode
        left join glbm_product p on p.kode = j.kodeproduct")->result();
    }

    function GetReportRekapitulasiStock($tglmulai, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from acc_vw_laporanpenjualandanpembelianpart where kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND bln= '" . date('m', strtotime($tglmulai)) . "' AND thn = '" . date('Y', strtotime($tglmulai)) . "' ")->result();
    }

    // function GetTotalRekapitulasiStock($tglmulai, $kodecabang, $kodecompany)
    // {
    //     return $this->db->query("SELECT 
    //     SUM(qtyawal) as qtyawal,SUM(total_awal) as total_awal,
    //     SUM(qty_pembelian) as qty_pembelian,SUM(total_pembelian) as total_pembelian,
    //     SUM(qtypenjualan) as qtypenjualan,SUM(total_penjualan) as total_penjualan,
    //     SUM(qty_returpenjualan) as qty_returpenjualan,SUM(total_returpenjualan) as total_returpenjualan,
    //     SUM(qty_returpembelian) as qty_returpembelian,SUM(total_returpembelian) as total_returpembelian,
    //     SUM(qty_opname) as qty_opname,SUM(total_opname) as total_opname,
    //     SUM(qty_akhir) as qty_akhir,SUM(total_akhir) as total_akhir, SUM(pricevariance - price_variancesales) as pricevariance
    //     FROM acc_vw_laporanpenjualandanpembelianpart 
    //     WHERE kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND bln= '" . date('m', strtotime($tglmulai)) . "' AND thn = '" . date('Y', strtotime($tglmulai)) . "'")->result();
    // }

    function GetTotalRekapitulasiStock($tglmulai, $kodecabang, $kodecompany)
    {
        return $this->db->query("SELECT 
        SUM(qtyawal) as qtyawal,SUM(total_awal) as total_awal,
        SUM(qty_pembelian) as qty_pembelian,SUM(total_pembelian) as total_pembelian,
        SUM(qtypenjualan) as qtypenjualan,SUM(total_penjualan) as total_penjualan,
        SUM(qty_returpenjualan) as qty_returpenjualan,SUM(total_returpenjualan) as total_returpenjualan,
        SUM(qty_returpembelian) as qty_returpembelian,SUM(total_returpembelian) as total_returpembelian,
        SUM(qty_opname) as qty_opname,SUM(total_opname) as total_opname,
        SUM(qty_akhir) as qty_akhir,SUM(total_akhir) as total_akhir
        FROM acc_vw_laporanpenjualandanpembelianpart 
        WHERE kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND bln= '" . date('m', strtotime($tglmulai)) . "' AND thn = '" . date('Y', strtotime($tglmulai)) . "'")->result();
    }

    function GetReportMutasiPiutang($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT case when jenispiutang = '51' then 'Faktur Service' when jenispiutang in ('52','35') then 'Faktur Part Counter'
        when jenispiutang = '53' then 'Retur Part' else '' end as jenispiutang ,periode, nomorfaktur, nomor_customer, nama_customer,tgltransaksi,
        SUM(saldoawal) as saldoawal, SUM(jual) as jual, SUM(rjual) as rjual, SUM(bayar) as bayar,
        SUM(batalbayar) as batalbayar,SUM(alokasi) as alokasi,SUM(batalalokasi) as batalalokasi,SUM(hapusar) as hapusar,
        SUM(batalhapusar) as batalhapusar,SUM(debit) as debit,SUM(kredit) as kredit, sum(saldoawal+debit-kredit) as total
        from $viewname 
        where kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' 
        AND periode = '" . date('Ym', strtotime($tglmulai)) . "'  
        group by periode, nomorfaktur, nomor_customer, nama_customer,tgltransaksi,case when jenispiutang = '51' then 'Faktur Service' when jenispiutang in ('52','35') then 'Faktur Part Counter'
        when jenispiutang = '53' then 'Retur Part' else '' end")->result();
    }

    function GetReportMutasiPiutangTotal($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(saldoawal) as saldoawal, SUM(jual) as jual,SUM(rjual) as rjual, SUM(bayar) as bayar,
        SUM(batalbayar) as batalbayar,SUM(alokasi) as alokasi,SUM(batalalokasi) as batalalokasi,SUM(hapusar) as hapusar,
        SUM(batalhapusar) as batalhapusar,SUM(debit) as debit,SUM(kredit) as kredit, sum(saldoawal+debit-kredit) as total
        FROM $viewname 
        WHERE kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND periode = '" . date('Ym', strtotime($tglmulai)) . "'")->result();
    }

    function GetReportMutasiHutang($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT case when jenishutang = '31' then 'Hutang OPL' when jenishutang in ('32','33') then 'Hutang Sparepart'
        else '' end as jenishutang ,periode, nomorfaktur, nomorsupplier, nama,tgltransaksi,
        SUM(saldoawal) as saldoawal, SUM(beli) as beli, SUM(rbeli) as rbeli, SUM(bayar) as bayar,
        SUM(batalbayar) as batalbayar,SUM(alokasi) as alokasi,SUM(batalalokasi) as batalalokasi,SUM(hapusap) as hapusap,
        SUM(batalhapusap) as batalhapusap,SUM(debit) as debit,SUM(kredit) as kredit, sum(saldoawal+debit-kredit) as total
        from $viewname 
        where kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' 
        AND periode = '" . date('Ym', strtotime($tglmulai)) . "'  
        group by periode, nomorfaktur, nomorsupplier, nama,tgltransaksi,case when jenishutang = '31' then 'Hutang OPL' when jenishutang in ('32','33') then 'Hutang Sparepart'
        else '' end")->result();
    }

    function GetReportMutasiHutangTotal($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(saldoawal) as saldoawal, SUM(beli) as beli, SUM(rbeli) as rbeli, SUM(bayar) as bayar,
        SUM(batalbayar) as batalbayar,SUM(alokasi) as alokasi,SUM(batalalokasi) as batalalokasi,SUM(hapusap) as hapusap,
        SUM(batalhapusap) as batalhapusap,SUM(debit) as debit,SUM(kredit) as kredit, sum(saldoawal+debit-kredit) as total
        FROM $viewname 
        WHERE kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND periode = '" . date('Ym', strtotime($tglmulai)) . "'")->result();
    }

    function GetReportMutasiUM($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT case when jenispiutang = '01' then 'Uang Muka Service' when jenispiutang in ('02') then 'Uang Muka Part Counter'
        else '' end as jenispiutang ,periode, nomororder, nomor_customer, nama_customer,tgltransaksi,
        SUM(saldoawal) as saldoawal, SUM(terimadp) as terimadp, SUM(batalterimadp) as batalterimadp, SUM(alokasi) as alokasi,SUM(batalalokasi) as batalalokasi,
        SUM(debit) as debit,SUM(kredit) as kredit, sum(saldoawal+debit-kredit) as total
        from $viewname 
        where kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' 
        AND periode = '" . date('Ym', strtotime($tglmulai)) . "'  
        group by periode, nomororder, nomor_customer, nama_customer,tgltransaksi,case when jenispiutang = '01' then 'Uang Muka Service' when jenispiutang in ('02') then 'Uang Muka Part Counter'
        else '' end")->result();
    }

    function GetReportMutasiUMTotal($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(saldoawal) as saldoawal, SUM(terimadp) as terimadp, SUM(batalterimadp) as batalterimadp, SUM(alokasi) as alokasi,SUM(batalalokasi) as batalalokasi,
        SUM(debit) as debit,SUM(kredit) as kredit, sum(saldoawal+debit-kredit) as total
        FROM $viewname 
        WHERE kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND periode = '" . date('Ym', strtotime($tglmulai)) . "'")->result();
    }

    function GetReportMutasiUMPembelian($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT case when jenishutang = '32' then 'Uang Muka OPL' when jenishutang in ('33') then 'Uang Muka Sparepart'
        else '' end as jenishutang ,periode, nomororder, nomor_supplier, nama_supplier,tgltransaksi,
        SUM(saldoawal) as saldoawal, SUM(bayardp) as bayardp, SUM(batalbayardp) as batalbayardp, SUM(alokasi) as alokasi,SUM(batalalokasi) as batalalokasi,
        SUM(debit) as debit,SUM(kredit) as kredit, sum(saldoawal+debit-kredit) as total
        from $viewname 
        where kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' 
        AND periode = '" . date('Ym', strtotime($tglmulai)) . "'  
        group by periode, nomororder, nomor_supplier, nama_supplier,tgltransaksi,case when jenishutang = '32' then 'Uang Muka OPL' when jenishutang in ('33') then 'Uang Muka Sparepart'
        else '' end")->result();
    }

    function GetReportMutasiUMTotalPembelian($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(saldoawal) as saldoawal, SUM(bayardp) as bayardp, SUM(batalbayardp) as batalbayardp, SUM(alokasi) as alokasi,SUM(batalalokasi) as batalalokasi,
        SUM(debit) as debit,SUM(kredit) as kredit, sum(saldoawal+debit-kredit) as total
        FROM $viewname 
        WHERE kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND periode = '" . date('Ym', strtotime($tglmulai)) . "'")->result();
    }

    function GetReportWObelumFakturTotal($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(cogs), SUM(harga), SUM(qty), SUM(subtotal) as grandtotal
        FROM $viewname 
        WHERE kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND periode = '" . date('Ym', strtotime($tglmulai)) . "'")->result();
    }

    function GetReportWoBatal($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  to_char(tglbatal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tglbatal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetTotalWoBatal($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(WO.nilaispk) as totalnilaispk
        FROM $viewname WO
        WHERE to_char(tglbatal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tglbatal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  and WO.kode_cabang = '" . $kodecabang . "' and WO.kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetReportWO($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    function GetTotalWO($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("SELECT 
        SUM(WO.nilaispk) as totalnilaispk
        FROM $viewname WO
        WHERE to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  and WO.kode_cabang = '" . $kodecabang . "' and WO.kodecompany = '" . $kodecompany . "' ")->result();
    }
    
    function GetReportAR($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    
    function GetReportUM($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

    
    function GetReportBelumInvoice($tglmulai, $kodecabang, $kodecompany, $viewname)
    {
        return $this->db->query("select * from $viewname where  kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
    }

	public function findjenisreport($jenis)
	{
		return $this->db->get_where('glbm_jenisreport', ['jenis' => $jenis])->row_array();
	}

	public function findreport($jenis, $grup)
	{
		$this->db->select('*');
		$this->db->where('jenis', $jenis);
		$this->db->where('grup', $grup);
		$this->db->where('aktif', true);
		return $this->db->get('stpm_report')->result_array();
	}

	public function getIdReport($jenis)
	{
		return $this->db->query("select * from glbm_jenisreport where jenis = '" .$jenis. "'")->row();
	}
    
    function GetDataCustomer($kodecabang, $kodecompany)
    {
        return $this->db->query("select glbm_customer.nomor,
        glbm_customer.title,
        upper(nama) as nama,
        upper(alamat) as alamat,
        glbm_customer.kode,
        glbm_customer.kelurahan,
        glbm_customer.kecamatan,
        glbm_customer.kota,
        glbm_customer.provinsi,
        glbm_customer.kodepos,
        glbm_customer.nohp,
        glbm_customer.notlp,
        glbm_customer.email,
        glbm_customer.pkp,
        upper(npwp) as npwp,
        upper(namanpwp) as namanpwp,
        upper(alamatnpwp) as alamatnpwp,
        glbm_customer.kreditlimit,
        glbm_customer.top,
        glbm_customer.aktif,
        glbm_customer.tglsimpan,
        glbm_customer.pemakai,
        glbm_customer.kategoricustomer,
        glbm_customer.kode_cabang,
        glbm_customer.kodecompany,
        glbm_customer.jeniscustomer from glbm_customer  where kode_cabang = '" .$kodecabang. "' ")->result();
    }
    
    function GetDataSupplier($kodecabang, $kodecompany)
    {
        return $this->db->query("select * from glbm_supplier ")->result();
    }
}

