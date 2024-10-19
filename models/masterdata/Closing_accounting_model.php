<?php


class Closing_accounting_model extends CI_Model
{

  private $_table = "trnt_statusclosing";

  public function get($periode = "", $jenis = "", $kode_cabang = "", $grupcabang = "")
  {
    $this->db->where('jenis', $jenis);
    $this->db->where('periode', $periode);
    $this->db->where('kode_cabang', $kode_cabang);
    $this->db->where('kodegrup', $grupcabang);
    $this->db->where('status', 1);
    return $this->db->get($this->_table)->result();
  }

  function GetOD($periode = "", $jenis = "", $grupcabang = "")
  {
    $this->db->where('jenis', $jenis);
    $this->db->where('periode', $periode);
    $this->db->where('kodegrup', $grupcabang);
    return $this->db->get("trnt_statusclosing")->result();
  }

  function stockpartf($bln = "", $thn = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT sa.kode_parts,sa.kode_cabang,sa.kodecompany,sa.kodesubcabang,sa.kodegrup, qty_akhir as saldoawalstock, sa.total_akhir,
    case when qtyawal + sa.qty_pembelian + sa.qty_returpembelian + sa.qty_opnamehithpp + sa.qty_returpenjualan = 0 then 0 else 
    (sa.total_awal + sa.total_pembelian + sa.total_returpembelian + sa.total_opnamehithpp + sa.total_returpenjualan) / (sa.qtyawal + sa.qty_pembelian + sa.qty_returpenjualan + sa.qty_returpembelian + sa.qty_opnamehithpp) end as cogs
    from acc_vw_laporanpenjualandanpembelianpart sa where sa.bln = '" . $bln . "' and sa.thn = '" . $thn . "' and sa.kodegrup= '" . $grupcabang . "' and sa.kode_cabang= '" . $kode_cabang . "'")->result();
    
    // return $this->db->query("SELECT sa.kode_parts,sa.kode_cabang,sa.kodecompany,sa.kodesubcabang,sa.kodegrup, qty_akhir as saldoawalstock, sa.total_akhir,
    // case when qtyawal + sa.qty_pembelian + sa.qty_returpembelian + sa.qty_opnamehithpp + sa.qty_pickinglistin + sa.qty_pickinglistout = 0 then 0 else 
    // (sa.total_awal + sa.total_pembelian + sa.total_returpembelian + sa.total_opnamehithpp + sa.total_pickinglistin + sa.total_pickinglistout) / (sa.qtyawal + sa.qty_pembelian + sa.qty_returpembelian + sa.qty_opnamehithpp  + sa.qty_pickinglistin + sa.qty_pickinglistout ) end as cogs 
    // from acc_vw_laporanpenjualandanpembelianpart sa where sa.bln = '" . $bln . "' and sa.thn = '" . $thn . "' and sa.kodegrup= '" . $grupcabang . "'  and sa.kode_cabang= '" . $kode_cabang . "'")->result();
  }

  function totalsaldop($bln = "", $thn = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT sa.kode_parts,sa.kode_cabang,sa.kodecompany,sa.kodesubcabang,sa.kodegrup, qty_akhir as saldoawalstock, 
    sa.total_akhir , case when qty_akhir = 0 then 0 else total_akhir / qty_akhir end as COGS from acc_vw_laporanpenjualandanpembelianpart sa 
    where sa.bln = '" . $bln . "' and sa.thn = '" . $thn . "' and sa.kodegrup= '" . $grupcabang . "' and sa.kode_cabang= '" . $kode_cabang . "'")->result();
  }

  function SaveStockFaktur($data = "")
  {
    return $this->db->insert('trnt_stockpartsfaktur', $data);
  }

  function SaveStockPart($data = "")
  {
    return $this->db->insert('trnt_stockparts', $data);
  }

  function updatecogs($data = "", $periode = "", $kode_parts = "", $kode_cabang = "", $kodecompany = "", $kodesubcabang = "")
  {
    $this->db->where('periode', $periode);
    $this->db->where('kodepart', $kode_parts);
    $this->db->where('kode_cabang', $kode_cabang);
    $this->db->where('kodecompany', $kodecompany);
    $this->db->where('kodesubcabang', $kodesubcabang);
    return $this->db->update('trnt_stockparts', $data);
  }

  function checkdatasp($data = "", $periode = "", $kode_parts = "", $kode_cabang = "", $kodecompany = "", $kodesubcabang = "")
  {
    $this->db->where('periode', $periode);
    $this->db->where('kodepart', $kode_parts);
    $this->db->where('kode_cabang', $kode_cabang);
    $this->db->where('kodecompany', $kodecompany);
    $this->db->where('kodesubcabang', $kodesubcabang);
    return $this->db->get('trnt_stockparts', $data);
  }

  function updateparts($data = "", $kode_parts = "", $kode_cabang = "", $kodecompany = "")
  {
    $this->db->where('kode', $kode_parts);
    $this->db->where('kodecabang', $kode_cabang);
    $this->db->where('kodecompany', $kodecompany);
    return $this->db->update('glbm_parts', $data);
  }

  function CariODetail($kode = "")
  {
    $this->db->where('kode', $kode);
    return $this->db->get("trnt_statusclosing")->result();
  }

  function SaveData($data = "")
  {
    return $this->db->insert('trnt_statusclosing', $data);
  }

  function checkclosing($periode = "", $jenis = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT MAX(periode) as periode from trnt_statusclosing where periode > '" . $periode . "' and jenis = '" . $jenis . "' and kodegrup = '" . $grupcabang . "' and kode_cabang = '" . $kode_cabang . "'  and status = '1'")->result();
  }

  function getdatacabang($grupcabang = "")
  {
    return $this->db->query("SELECT * from glbm_cabang where kodegrup = '" . $grupcabang . "'")->result();
  }

  function checkclosingx($periode = "", $jenis = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT * from trnt_statusclosing where periode = '" . $periode . "' and jenis = '" . $jenis . "' and kodegrup = '" . $grupcabang . "'  and kode_cabang = '" . $kode_cabang . "'")->result();
  }

  function updateclosing($periode = "", $jenis = "", $grupcabang = "", $kode_cabang = "", $statusbatal = "")
  {
    if ($statusbatal == false) {
      return $this->db->query("update trnt_statusclosing set status = 1 where  periode = '" . $periode . "' and jenis = '" . $jenis . "' and kodegrup = '" . $grupcabang . "' and kode_cabang = '" . $kode_cabang . "'");
    } else {
      return $this->db->query("update trnt_statusclosing set status = 0 where  periode = '" . $periode . "' and jenis = '" . $jenis . "' and kodegrup = '" . $grupcabang . "' and kode_cabang = '" . $kode_cabang . "'");
    }
  }

  function checkclosingup($jenis = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT MAX(periode) as periode from trnt_statusclosing where jenis = '" . $jenis . "' and kode_cabang = '" . $kode_cabang . "' and status = 1")->result();
  }

  function DeleteStockFaktur($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("DELETE from trnt_stockpartsfaktur where periode = '" . $periode . "' and kode_cabang = '" . $kode_cabang . "'");
  }

  function updatecogsunclose($periode = "", $kodegrup = "", $kode_cabang = "")
  {
    // $this->db->where('periode', $periode);
    // $this->db->where('kodecompany', $kodecompany);
    // $result = $this->db->update('trnt_stockparts',$data);
    return $this->db->query("UPDATE trnt_stockparts set cogs= '0', totalsaldoawal = '0' where periode = '" . $periode . "' and kode_cabang = '" . $kode_cabang . "'");
  }

  function deleteclosing($periode = "", $jenis = "", $grupcabang = "")
  {
    return $this->db->query("DELETE from trnt_statusclosing where  periode = '" . $periode . "' and jenis = '" . $jenis . "' and kodegrup = '" . $grupcabang . "'");
  }

  function DeleteSaldoPiutang($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("DELETE from trnt_saldopiutang where periode = '" . $periode . "' and kodegrup = '" . $grupcabang . "' and kodecabang = '" . $kode_cabang . "'");
  }

  function saldopiutang($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT jenispiutang, nomorfaktur, tgltransaksi, nomor_customer, nilaipiutang,kodecabang ,kodecompany ,kodesubcabang ,kodegrup, sum(saldoawal + debit - kredit) as total from acc_vw_laporanmutasipiutang
    where periode = '" . $periode .  "' and kodegrup = '" . $grupcabang .  "' and kodecabang = '" . $kode_cabang . "'
    group by jenispiutang, nomorfaktur, tgltransaksi, nomor_customer, nilaipiutang,kodecompany ,kodesubcabang,kodecabang, kodegrup
    HAVING SUM(saldoawal + debit - kredit)  <> 0")->result();
  }

  function SaveSaldoPiutang($data = "")
  {
    return $this->db->insert('trnt_saldopiutang', $data);
  }

  function DeleteSaldoUM($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("DELETE from trnt_saldouangmuka where periode = '" . $periode . "' and kodegrup = '" . $grupcabang . "' and kodecabang = '" . $kode_cabang . "'");
  }

  function saldoUM($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT jenispiutang, nomororder, tgltransaksi, nomor_customer, kodecabang ,kodecompany ,kodesubcabang ,kodegrup,sum(saldoawal + debit - kredit) as total from acc_vw_laporanmutasiuangmuka
        where periode = '" . $periode .  "' and kodegrup = '" . $grupcabang .  "' and kodecabang = '" . $kode_cabang . "'
        group by jenispiutang, nomororder, tgltransaksi, nomor_customer,kodecabang,kodecompany ,kodesubcabang,kodegrup
        HAVING SUM(saldoawal + debit - kredit)  <> 0")->result();
  }

  function SaveSaldoUM($data = "")
  {
    return $this->db->insert('trnt_saldouangmuka', $data);
  }

  function DeleteSaldoHutang($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("DELETE from trnt_saldohutang where periode = '" . $periode . "' and kodegrup = '" . $grupcabang . "' and kodecabang = '" . $kode_cabang . "'");
  }

  function saldohutang($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT jenishutang, nomorfaktur, tgltransaksi , nomorsupplier,kodecabang ,kodecompany, kodesubcabang,kodegrup,sum(saldoawal + debit - kredit) as total from acc_vw_laporanmutasihutang
        where periode = '" . $periode .  "' and kodegrup = '" . $grupcabang .  "' and kodecabang = '" . $kode_cabang . "'
        group by jenishutang, tgltransaksi, nomorfaktur, nomorsupplier, kodecabang,kodecompany, kodesubcabang,kodegrup
        HAVING SUM(saldoawal + debit - kredit) <> 0")->result();
  }

  function SaveSaldoHutang($data = "")
  {
    return $this->db->insert('trnt_saldohutang', $data);
  }

  function DeleteSaldoUMBeli($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("DELETE from trnt_saldouangmukapembelian where periode = '" . $periode . "' and kodegrup = '" . $grupcabang . "' and kodecabang = '" . $kode_cabang . "'");
  }

  function saldoUMbeli($periode = "", $grupcabang = "", $kode_cabang = "")
  {
    return $this->db->query("SELECT jenishutang, nomororder, tgltransaksi, nomor_supplier, kodecabang ,kodecompany ,kodesubcabang ,kodegrup,sum(saldoawal + debit - kredit) as total 
        from acc_vw_laporanmutasiuangmukapembelian
        where periode = '" . $periode .  "' and kodegrup = '" . $grupcabang .  "' and kodecabang = '" . $kode_cabang . "'
        group by jenishutang, nomororder, tgltransaksi, nomor_supplier,kodecabang,kodecompany ,kodesubcabang,kodegrup
        HAVING SUM(saldoawal + debit - kredit)  <> 0")->result();
  }

  function SaveSaldoUMbeli($data = "")
  {
    return $this->db->insert('trnt_saldouangmukapembelian', $data);
  }

  function checkcogs($periode = "", $kode_parts = "", $kode_cabang = "", $kodecompany = "")
  {
    // $this->db->where('kodepart', $kode_parts);    
    // $this->db->where('kode_cabang', $kode_cabang);
    // $this->db->where('kodecompany', $kodecompany);
    // $this->db->where('periode', $periode);
    // $this->db->where('kodesubcabang', 'ALL');
    // return $this->db->get('trnt_stockparts')->result();

    return $this->db->query("SELECT cogsstd, cogs from trnt_stockpartsfaktur where periode = '" . $periode . "' and kodepart = '" . $kode_parts . "' 
    and kode_cabang = '" . $kode_cabang . "' and kodecompany = '" . $kodecompany . "'  and kodesubcabang = 'ALL'")->row();
  }

  function getdataparts($kode_parts = "", $kode_cabang = "", $kodecompany = "")
  {
    return $this->db->query("SELECT * from glbm_parts where kode = '" . $kode_parts . "' 
    and kodecabang = '" . $kode_cabang . "' and kodecompany = '" . $kodecompany . "'")->row();
  }

  function UpdateStockFaktur($data = "", $periode = "", $kode_parts = "", $kode_cabang = "", $kodecompany = "")
  {
    $this->db->where('periode', $periode);
    $this->db->where('kodepart', $kode_parts);
    $this->db->where('kode_cabang', $kode_cabang);
    $this->db->where('kodecompany', $kodecompany);
    return $this->db->update('trnt_stockpartsfaktur', $data);
  }

  function checkinvoice($periode = "",$kode_cabang = "")
  {
    return $this->db->query("SELECT nomor from trnt_penerimaansparepart where to_char(tanggal,'YYYYMM')  = '" . $periode . "' and batal = false and invoice = false and kode_cabang = '" . $kode_cabang . "'")->result();
  }
}
