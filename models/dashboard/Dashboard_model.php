<?php

class Dashboard_model extends CI_Model
{
    function GetDataSPK($date)
    {

        $x = $date;
        do {
            $company = $this->session->userdata('mycompany');
            $cabang = $this->session->userdata('mycabang');
            $param =  date('Y-m-d', strtotime('-' . $x . ' days', strtotime(date('Y-m-d'))));
            $query = $this->db->query("SELECT A.tanggal::date, SUM(nomor) as nomor FROM( 
                SELECT WO.tanggal as tanggal, 
                COUNT(WO.nomor) AS nomor                
                FROM trnt_wo WO 
                WHERE WO.tanggal::date = '" . $param . "' and WO.kode_cabang = '" . $cabang . "'
                group by WO.tanggal::date, nomor 
                )A 
                GROUP BY A.tanggal::date")->result();

            if (empty($query)) {
                $hasil = array(
                    "tanggal" => $param,
                    "nomor" => 0
                );
            } else {
                foreach ($query as $key => $value) {
                    # code...
                }
                $hasil = array(
                    "tanggal" => $value->tanggal,
                    "nomor" => $value->nomor
                );
            }
            $hasilaja[] = $hasil;
            $x--;
        } while ($x >= 0);

        return $hasilaja;
    }

    function loadSPKChart($tanggal)
    {

        $x = $tanggal;
        do {
            $company = $this->session->userdata('mycompany');
            $cabang = $this->session->userdata('mycabang');
            $param =  date('Y-m-d', strtotime('-' . $x . ' days', strtotime(date('Y-m-d'))));
            $query = $this->db->query("SELECT A.tanggal::date, SUM(nomor) as nomor FROM( 
                SELECT WO.tanggal as tanggal, 
                COUNT(WO.nomor) AS nomor                
                FROM trnt_wo WO 
                WHERE WO.tanggal::date = '" . $param . "' and WO.kode_cabang = '" . $cabang . "'
                group by WO.tanggal::date, nomor 
                )A 
                GROUP BY A.tanggal::date")->result();

            if (empty($query)) {
                $hasil = array(
                    "tanggal" => $param,
                    "nomor" => 0
                );
            } else {
                foreach ($query as $key => $value) {
                    # code...
                }
                $hasil = array(
                    "tanggal" => $value->tanggal,
                    "nomor" => $value->nomor
                );
            }
            $hasilaja[] = $hasil;
            $x--;
        } while ($x >= 0);

        return $hasilaja;
    }

    function loadFakturChart($tanggal)
    {

        $x = $tanggal;
        do {
            $param =  date('Y-m-d', strtotime('-' . $x . ' days', strtotime(date('Y-m-d'))));
            $company = $this->session->userdata('mycompany');
            $cabang = $this->session->userdata('mycabang');
            $query = $this->db->query("SELECT A.tanggal::date, SUM(nomor) as nomor FROM( 
                SELECT F.tanggal as tanggal, 
                COUNT(F.nomor) AS nomor                
                FROM trnt_faktur F 
                WHERE F.tanggal::date = '" . $param . "' and F.kode_cabang = '" . $cabang . "'
                group by F.tanggal::date, nomor 
                )A 
                GROUP BY A.tanggal::date")->result();

            if (empty($query)) {
                $hasil = array(
                    "tanggal" => $param,
                    "nomor" => 0
                );
            } else {
                foreach ($query as $key => $value) {
                    # code...
                }
                $hasil = array(
                    "tanggal" => $value->tanggal,
                    "nomor" => $value->nomor
                );
            }
            $hasilaja[] = $hasil;
            $x--;
        } while ($x >= 0);

        return $hasilaja;
    }

    function GetStatus()
    {
        $company = $this->session->userdata('mycompany');
        $cabang = $this->session->userdata('mycabang');
        $query = $this->db->query("SELECT WO.nomor AS nomorspk,
            WO.nopolisi as nosn,
            K.nama AS namakategori,
            T.nama AS namatipe,
            C.nama AS namacustomer,
            CASE
                WHEN WO.jenisservice::text = '0'::text THEN 'Walk IN'::text
                WHEN WO.jenisservice::text = '1'::text THEN 'On Site'::text
                WHEN WO.jenisservice::text = '2'::text THEN 'Pick Up'::text
            ELSE ''::text
            END AS jenisservice,
            CASE
                WHEN WO.status::text = '0'::text THEN 'SPK OPEN'::text
                WHEN WO.status::text = '1'::text THEN 'SPK CLOSE'::text
                WHEN WO.status::text = '2'::text THEN 'FAKTUR'::text
            ELSE ''::text
            END AS statuswo,
            WO.pemakai
        FROM trnt_wo WO
            LEFT JOIN glbm_customer C ON C.nomor::text = WO.nomor_customer::text
            LEFT JOIN glbm_tipe T ON T.kode::text = WO.tipe::text
            LEFT JOIN glbm_product K ON K.kode::text = WO.kategori::text
        WHERE WO.batal = false  and WO.kode_cabang = '" . $cabang . "' ;")->result();
    }

    function GetSumFaktur($tanggal)
    {
        $company = $this->session->userdata('mycompany');
        $cabang = $this->session->userdata('mycabang');
        $bulan = date('m', strtotime($tanggal, strtotime(date('m'))));
        $tahun = date('Y', strtotime($tanggal));
        return $this->db->query("SELECT EXTRACT(MONTH FROM F.tanggal) AS tanggal,
        SUM(F.grandtotal) AS totalfaktur
        FROM trnt_faktur F
            --LEFT JOIN trnt_fakturdetail FD ON FD.nomorfaktur::text = F.nomor::text
        WHERE F.batal = false  and F.kode_cabang = '" . $cabang . "' AND EXTRACT(MONTH FROM F.tanggal) = '" . $bulan . "' AND EXTRACT(YEAR FROM F.tanggal) = '" . $tahun . "' GROUP BY EXTRACT(MONTH FROM F.tanggal)")->result();
    }

    function GetSumPiutang($tanggal)
    {
        $company = $this->session->userdata('mycompany');
        $cabang = $this->session->userdata('mycabang');
        $bulan = date('m', strtotime($tanggal, strtotime(date('m'))));
        $tahun = date('Y', strtotime($tanggal));
        return $this->db->query("SELECT EXTRACT(MONTH FROM P.tgltransaksi) AS tanggal,
        SUM(P.nilaipiutang - (P.nilaipenerimaan + P.nilaiuangmuka)) AS totalpiutang
        FROM trnt_piutang P
            -- LEFT JOIN trnt_fakturdetail FD ON FD.nomorfaktur::text = F.nomor::text
        WHERE P.nilaipiutang <> (P.nilaipenerimaan + P.nilaiuangmuka) and P.kode_cabang = '" . $cabang . "' AND P.batal = False AND EXTRACT(MONTH FROM P.tgltransaksi) = '" . $bulan . "' AND EXTRACT(YEAR FROM P.tgltransaksi) = '" . $tahun . "' GROUP BY EXTRACT(MONTH FROM P.tgltransaksi)")->result();
    }

    function GetSumHutang($tanggal)
    {
        $company = $this->session->userdata('mycompany');
        $cabang = $this->session->userdata('mycabang');
        $bulan = date('m', strtotime($tanggal, strtotime(date('m'))));
        $tahun = date('Y', strtotime($tanggal));
        return $this->db->query("SELECT EXTRACT(MONTH FROM P.tgltransaksi) AS tanggal,
        SUM(P.nilaihutang - (P.nilaipembayaran)) AS totalhutang
        FROM trnt_hutang P
            -- LEFT JOIN trnt_fakturdetail FD ON FD.nomorfaktur::text = F.nomor::text
        WHERE P.nilaihutang <> P.nilaipembayaran and P.kode_cabang = '" . $cabang . "' AND P.batal = False AND EXTRACT(MONTH FROM P.tgltransaksi) = '" . $bulan . "' AND EXTRACT(YEAR FROM P.tgltransaksi) = '" . $tahun . "' GROUP BY EXTRACT(MONTH FROM P.tgltransaksi)")->result();
    }

    function GetSumPenerimaan($tanggal)
    {
        $company = $this->session->userdata('mycompany');
        $cabang = $this->session->userdata('mycabang');
        $bulan = date('m', strtotime($tanggal, strtotime(date('m'))));
        $tahun = date('Y', strtotime($tanggal));
        return $this->db->query("SELECT EXTRACT(MONTH FROM P.tanggal) AS tanggal,
        SUM(PD.nilaipenerimaan) AS totalpenerimaan
        FROM trnt_penerimaan P
            LEFT JOIN trnt_penerimaandetail PD ON PD.nomorpenerimaan::text = P.nomor::text
        WHERE P.batal = False and P.kode_cabang = '" . $cabang . "' AND EXTRACT(MONTH FROM P.tanggal) = '" . $bulan . "' AND EXTRACT(YEAR FROM P.tanggal) = '" . $tahun . "' GROUP BY EXTRACT(MONTH FROM P.tanggal)")->result();
    }

    function GetSumPengeluaran($tanggal)
    {
        $company = $this->session->userdata('mycompany');
        $cabang = $this->session->userdata('mycabang');
        $bulan = date('m', strtotime($tanggal, strtotime(date('m'))));
        $tahun = date('Y', strtotime($tanggal));
        return $this->db->query("SELECT EXTRACT(MONTH FROM P.tanggal) AS tanggal,
        SUM(PD.nilaipembayaran) AS totalpembayaran
        FROM trnt_pembayaran P
            LEFT JOIN trnt_pembayarandetail PD ON PD.nomorpembayaran::text = P.nomor::text
        WHERE P.batal = False and P.kode_cabang = '" . $cabang . "' AND EXTRACT(MONTH FROM P.tanggal) = '" . $bulan . "' AND EXTRACT(YEAR FROM P.tanggal) = '" . $tahun . "' GROUP BY EXTRACT(MONTH FROM P.tanggal)")->result();
    }

    function GetSumPencairan($tanggal)
    {
        $company = $this->session->userdata('mycompany');
        $cabang = $this->session->userdata('mycabang');
        $bulan = date('m', strtotime($tanggal, strtotime(date('m'))));
        $tahun = date('Y', strtotime($tanggal));
        return $this->db->query("SELECT EXTRACT(MONTH FROM P.tanggal) AS tanggal,
        SUM(P.nilaipenerimaan) AS totalpencairan
        FROM trnt_pencairanpiutangkartu P
            -- LEFT JOIN trnt_pembayarandetail PD ON PD.nomorpembayaran::text = P.nomor::text
        WHERE P.batal = False and P.kode_cabang = '" . $cabang . "' AND EXTRACT(MONTH FROM P.tanggal) = '" . $bulan . "' AND EXTRACT(YEAR FROM P.tanggal) = '" . $tahun . "' GROUP BY EXTRACT(MONTH FROM P.tanggal)")->result();
    }
}
