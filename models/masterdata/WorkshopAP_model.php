<?php
class WorkshopAP_model extends CI_Model
{
    function ambiltanggalkonfigurasi()
    {
        return $this->db->get("stpm_konfigurasi")->result();
    }

    function tampilworkshopAP($jenisfaktur = "", $pencairan, $kodecabang = "", $kodecompany = "", $kodesubcabang = "", $kodegrupcabang = "", $tglmulai = "", $tglakhir = "")
    {
        if ($jenisfaktur == 0) {
            return $this->db->query("select nopolisi, tanggal, nomor, namasupplier,nomor_wo, sum(cogs) as cogs, sum(harga) as harga, statuswo, statusinv,statusbayar,tgllunas,
            sum(margin) as margin, sisaap, noinvoice from report_opl where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(namasupplier) like lower('%" . $pencairan . "%') and statusbayar = 'Lunas'  and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'
            group by tanggal, nomor, namasupplier,nomor_wo, statuswo, statusinv,statusbayar,tgllunas, sisaap, noinvoice,nopolisi")->result();
        } else if ($jenisfaktur == 1) {
            return $this->db->query("select nopolisi, tanggal, nomor, namasupplier,nomor_wo, sum(cogs) as cogs, sum(harga) as harga, statuswo, statusinv,statusbayar,tgllunas,
            sum(margin) as margin, sisaap, noinvoice from report_opl where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(namasupplier) like lower('%" . $pencairan . "%') and statusbayar = 'Belum Lunas'  and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'  group by tanggal, nomor, namasupplier,nomor_wo, statuswo, statusinv,statusbayar,tgllunas, sisaap, noinvoice,nopolisi")->result();
        }else if ($jenisfaktur == 2) {
            return $this->db->query("select * from report_podanpenerimaan where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(namasupplier) like lower('%" . $pencairan . "%') and statusbayar = 'Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'")->result();
        }else if ($jenisfaktur == 3) {
            return $this->db->query("select * from report_podanpenerimaan where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(namasupplier) like lower('%" . $pencairan . "%') and statusbayar = 'Belum Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and nopenerimaan is not null ")->result();
        }else if ($jenisfaktur == 4) {
            return $this->db->query("select * from report_podanpenerimaan where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(namasupplier) like lower('%" . $pencairan . "%') and statusbayar = 'Belum Lunas' and nopenerimaan is null ")->result();
        }
    }
}
