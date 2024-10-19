<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reportkasbank_model extends CI_Model
{
    function dataaccount($nomor = "")
    {
        $this->db->where('nomor', $nomor);
        return $this->db->get("glbm_account")->result();
    }

    function tampillaporankasbank($nomor = "", $tglawal = "", $tglakhir = "", $kodecabang = "", $kodecompany = "")
    {
        // print_r($kodecabang);
        // die();
        // return $this->db->query("SELECT * FROM (
        //     SELECT 1 as sort, tanggal,''as nomorbon,jenis,keterangan,coa,namaccount,SUM(debit) as debit,SUM(kredit) as kredit 
        //     FROM (
        //         SELECT to_char(date '" . $tglawal . "', 'DD/MM/YYYY') as tanggal,'Saldo Awal' as jenis, 
        //         concat('Saldo Awal Tanggal ',to_char(date '" . $tglawal . "', 'DD/MM/YYYY')) as keterangan, 
        //         a.coa as coa,ac.nama as namaccount, 
        //         COALESCE(nominal,0) as debit, 
        //         0 as kredit 
        //         -- CASE WHEN nominal > 0 then nominal  ELSE 0  END as debit, 
        //         -- CASE WHEN nominal < 0 then nominal * -1 ELSE 0 END as kredit                 

        //         FROM func_saldoawaltransaksi(to_char(date '" . $tglawal . "', 'YYYYMMDD')) a 
        //         LEFT JOIN glbm_account ac on ac.nomor = a.coa 
        //         UNION ALL 

        //         SELECT to_char(date '" . $tglawal . "', 'DD/MM/YYYY') as tanggal, 'Saldo Awal' as jenis, 
        //         concat('Saldo Awal Tanggal ',to_char(date '" . $tglawal . "', 'DD/MM/YYYY')) as keterangan, 
        //         tb.coa,tb.description as namaccount,
        //         CASE WHEN tb.saldoawal > 0 then tb.saldoawal ELSE 0  END as debit, 
        //         CASE WHEN tb.saldoawal < 0 then tb.saldoawal * -1  ELSE 0 END as kredit 
        //         FROM trnt_saldoawalkasbank tb 
        //         CROSS JOIN stpm_konfigurasi kon 
        //         WHERE to_char(tb.tanggal,'YYYYMMDD') = to_char(kon.tglkasbank,'YYYYMMDD')
        //         )saldoawal 
        //     WHERE coa = '" . $nomor . "' 
        //     GROUP BY tanggal,jenis,keterangan,coa,namaccount 
        //     UNION ALL         
        //     SELECT * FROM ( 
        //         SELECT 2 as sort, tglbon as tanggal,nomorbon,jenistransaksi as jenis,keterangan,kode as coa,namaaccount,debit,kredit 
        //         FROM view_saldoawaltransaksi 
        //         WHERE tanggalbon >= to_char(date '" . $tglawal . "', 'YYYYMMDD') AND tanggalbon <= to_char(date '" . $tglakhir . "', 'YYYYMMDD')  AND kode = '" . $nomor . "' 
        //         order by tglbon,sortid,nomorbon asc 
        //     )a 
        // )b")->result();

        return $this->db->query(
            "SELECT * FROM (
                SELECT 1 as sort, to_char(date '" . $tglawal . "', 'DD/MM/YYYY') as tanggal,''as nomorbon, 'Saldo Awal' as jenis, 
                concat('Saldo Awal Tanggal ',to_char(date '" . $tglawal . "', 'DD/MM/YYYY')) as keterangan, 
                coa,namaccount,
                CASE WHEN nominal > 0 then nominal ELSE 0  END as debit, 
                CASE WHEN nominal < 0 then nominal * -1  ELSE 0 END as kredit , kodecompany, kode_cabang, '' as nopermohonan
                    FROM (
                        SELECT coa,namaccount, SUM(nominal) as nominal, kodecompany, kode_cabang   
                        FROM (
                            SELECT  a.coa as coa,ac.nama as namaccount,  COALESCE(nominal,0) as nominal , a.kode_company as kodecompany, a.kode_cabang                  
                            FROM func_saldoawaltransaksi(to_char(date '" . $tglawal . "', 'YYYYMMDD')) a 
                            LEFT JOIN glbm_account ac on ac.nomor = a.coa 
                            
                            UNION ALL 
                            
                            SELECT  tb.coa,tb.description as namaccount,COALESCE(tb.saldoawal,0) as nominal, tb.kodecompany, tb.kode_cabang                        
                            FROM trnt_saldoawalkasbank tb 
                            LEFT JOIN glbm_cabang c on c.kode = tb.kode_cabang and c.kodecompany = tb.kodecompany
                            WHERE to_char(tb.tanggal,'YYYYMMDD') = to_char(c.tglkasbank,'YYYYMMDD')

                        )saldoawal
                        GROUP BY coa,namaccount , kodecompany, kode_cabang
                )saldo 
                WHERE coa = '" . $nomor . "' and kodecompany = '" . $kodecompany . "' and kode_cabang = '" . $kodecabang . "'         
                UNION ALL         
                SELECT * FROM ( 
                    SELECT 2 as sort, tglbon as tanggal,nomorbon,jenistransaksi as jenis,keterangan,kode as coa,namaaccount,debit,kredit ,kodecompany, kode_cabang, nopermohonan
                    FROM view_saldoawaltransaksi 
                    WHERE tanggalbon >= to_char(date '" . $tglawal . "', 'YYYYMMDD') AND tanggalbon <= to_char(date '" . $tglakhir . "', 'YYYYMMDD')  
                    AND kode = '" . $nomor . "' AND kodecompany = '" . $kodecompany . "' and kode_cabang = '" . $kodecabang . "'    
                    order by tglbon,sortid,nomorbon asc 
                    )a 
                )b")->result();
    }

    function saldoakhirlaporankasbank($nomor = "", $tglawal = "", $tglakhir = "", $kodecabang = "", $kodecompany = "")
    {
        return $this->db->query(
            "SELECT sum(debit) as debit, sum(kredit) as kredit, kodecompany, kode_cabang FROM (
                SELECT 1 as sort, to_char(date '" . $tglawal . "', 'DD/MM/YYYY') as tanggal,''as nomorbon, 'Saldo Awal' as jenis, 
                concat('Saldo Awal Tanggal ',to_char(date '" . $tglawal . "', 'DD/MM/YYYY')) as keterangan, 
                coa,namaccount,
                CASE WHEN nominal > 0 then nominal ELSE 0  END as debit, 
                CASE WHEN nominal < 0 then nominal * -1  ELSE 0 END as kredit , kodecompany, kode_cabang
                    FROM (
                        SELECT coa,namaccount, SUM(nominal) as nominal, kodecompany, kode_cabang   
                        FROM (
                            SELECT  a.coa as coa,ac.nama as namaccount,  COALESCE(nominal,0) as nominal , a.kode_company as kodecompany, a.kode_cabang                  
                            FROM func_saldoawaltransaksi(to_char(date '" . $tglawal . "', 'YYYYMMDD')) a 
                            LEFT JOIN glbm_account ac on ac.nomor = a.coa 
                            
                            UNION ALL 
                            
                            SELECT  tb.coa,tb.description as namaccount,COALESCE(tb.saldoawal,0) as nominal, tb.kodecompany, tb.kode_cabang                        
                            FROM trnt_saldoawalkasbank tb 
                            LEFT JOIN glbm_cabang c on c.kode = tb.kode_cabang and c.kodecompany = tb.kodecompany
                            WHERE to_char(tb.tanggal,'YYYYMMDD') = to_char(c.tglkasbank,'YYYYMMDD')

                        )saldoawal
                        GROUP BY coa,namaccount , kodecompany, kode_cabang
                )saldo 
                WHERE coa = '" . $nomor . "' and kodecompany = '" . $kodecompany . "' and kode_cabang = '" . $kodecabang . "'         
                UNION ALL         
                SELECT * FROM ( 
                    SELECT 2 as sort, tglbon as tanggal,nomorbon,jenistransaksi as jenis,keterangan,kode as coa,namaaccount,debit,kredit ,kodecompany, kode_cabang
                    FROM view_saldoawaltransaksi 
                    WHERE tanggalbon >= to_char(date '" . $tglawal . "', 'YYYYMMDD') AND tanggalbon <= to_char(date '" . $tglakhir . "', 'YYYYMMDD')  
                    AND kode = '" . $nomor . "' AND kodecompany = '" . $kodecompany . "' and kode_cabang = '" . $kodecabang . "'    
                    order by tglbon,sortid,nomorbon asc 
                    )a 
                )b group by kodecompany, kode_cabang")->result();
    }

}
