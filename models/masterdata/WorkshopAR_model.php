<?php
class WorkshopAR_model extends CI_Model
{
    function ambiltanggalkonfigurasi()
    {
        return $this->db->get("stpm_konfigurasi")->result();
    }

    function tampilworkshopAR($jenisfaktur = "", $pencairan, $kriteria = "", $kodecabang = "", $kodecompany = "", $kodesubcabang = "", $kodegrupcabang = "", $tglmulai, $tglakhir)
    {
        if ($jenisfaktur == 0) {
            return $this->db->query("select * from report_faktur where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(customer) like lower('%" . $pencairan . "%') and statusbayar = 'Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
        } else if ($jenisfaktur == 1) {
            return $this->db->query("select * from report_faktur where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(customer) like lower('%" . $pencairan . "%') and statusbayar = 'Belum Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
        } else if ($jenisfaktur == 2) {
            return $this->db->query("select * from report_fakturpartcountersummary where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(nama_customer) like lower('%" . $pencairan . "%') and statusbayar = 'Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
        } else if ($jenisfaktur == 3) {
            return $this->db->query("select * from report_fakturpartcountersummary where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(nama_customer) like lower('%" . $pencairan . "%') and statusbayar = 'Belum Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
        }
    }

    function tampilworkshopAR_WOOpen($jenisfaktur = "", $pencairan = "", $kodecabang = "", $kodecompany = "", $kodesubcabang = "", $kodegrupcabang = "")
    {
        if ($jenisfaktur == 4) {
            return $this->db->query("select * from report_woharianopen where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(customer) like lower('%" . $pencairan . "%') and sisaum >= 0 order by sisaum desc")->result();
        } else if ($jenisfaktur == 5) {
            return $this->db->query("select * from report_woharianopen where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(customer) like lower('%" . $pencairan . "%') and sisaum < 0 order by sisaum")->result();
        
        }
    }
}
