<?php


class Penerimaan_sparepart_model extends CI_Model
{

	function checkstock($kode = "", $periode = "", $qty = "", $kodecabang = "", $kodecompany = "", $kodesubcabang = ""){
		return $this->db->query("select * from trnt_stockparts where  (qtyawal+qtymasuk-qtykeluar) >= " . $qty . " AND kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}
	
    function checkclosinggl($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from stpm_statusclosing WHERE periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND closing = true")->result();   
    }

	function checkclosinghpp($periode, $kodecabang, $kodecompany)
    {
        return $this->db->query("select * from trnt_statusclosing WHERE jenis = '1' and status = '1' and periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' ")->result();   
    }
	
	function checkdatastock($kode = "", $periode = "", $kodecabang = "",$kodecompany = "", $kodesubcabang = ""){
		$this->db->where('kodepart',$kode);
		$this->db->where('periode',$periode);
		$this->db->where('kode_cabang',$kodecabang);	
		$this->db->where('kodesubcabang',$kodesubcabang);
		$this->db->where('kodecompany',$kodecompany);
		return $this->db->get("trnt_stockparts")->result();
	}

	function insertstock($data = "")
    {
		return $this->db->insert('trnt_stockparts', $data);
	}

	function updatestock($kode, $qty, $periode, $kodecabang, $kodecompany, $kodesubcabang, $statusbatal)
    {
        if ($statusbatal == TRUE) {
            return $this->db->query("UPDATE trnt_stockparts set qtykeluar = qtykeluar +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        } else {
            return $this->db->query("UPDATE trnt_stockparts set qtymasuk = qtymasuk +" . $qty . " WHERE kodepart = '" . $kode . "' AND periode = '" . $periode . "' AND kode_cabang = '" . $kodecabang . "' AND kodesubcabang = '" . $kodesubcabang . "' AND kodecompany = '" . $kodecompany . "'");
        }
	}

	function getdatasupplier($nomor = ""){
		$this->db->where('aktif',true);
		$this->db->where('nomor',$nomor);
		return $this->db->get("vw_supplierpart")->result();
	}

	function getdatasparepart($kode = ""){
		$this->db->where('kode',$kode);
		return $this->db->get("glbm_parts")->result();
	}

	function getordering($nomororder = ""){
		$this->db->where('nomor',$nomororder);
		return $this->db->get("trnt_orderingsparepart")->result();
	}

	function getMaxNomor($nomor = "")
    {
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,6)",$nomor);
        return $this->db->get('trnt_penerimaansparepart')->row();
	}

	function getdatafinddetail($nomor){
		// $this->db->where('nomororder',$nomor);
		// return $this->db->get("trnt_orderingsparepartdetail")->result();
		return $this->db->query("select * from trnt_orderingsparepartdetail where  qty <> qtygr AND nomororder = '" . $nomor . "'")->result();
	}

	function getdatafind($nomor){
		// $this->db->where('nomor',$nomor);
		// return $this->db->get("trnt_orderingsparepart")->result();
		return $this->db->query("select *, nilaiuangmuka - nilaialokasi as sisaum from trnt_orderingsparepart where nomor = '" . $nomor . "'")->result();
	}

	function findpenerimaan($nomor){
		$this->db->where('nomor',$nomor);
		return $this->db->get("trnt_penerimaansparepart")->result();
	}

	function findpenerimaandetail($nomor){
		$this->db->where('nomorpenerimaan',$nomor);
		return $this->db->get("trnt_penerimaansparepartdetail")->result();
	}
	
	function cekbayar($nomor){
		$this->db->where('noreferensi',$nomor);
		// $this->db->where('nilaipenerimaan <> 0 or approve = true');
		$this->db->where('nilaipembayaran <> 0');
		return $this->db->get("trnt_hutang")->result();
	}

	function saveheader($data = "")
    {
		return $this->db->insert('trnt_penerimaansparepart', $data);
	}

	function hutang($data = "")
    {
		return $this->db->insert('trnt_hutang', $data);
	}
		
	function savedetail($data = "")
    {
		return $this->db->insert('trnt_penerimaansparepartdetail', $data);
	}

	function invoice($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_penerimaansparepart', $data);
	}

	function updateordering($value = "", $nomor = "", $kode = "", $statusbatal)
    {
		if  ($statusbatal == TRUE) {
			return $this->db->query("update trnt_orderingsparepartdetail set qtygr = qtygr - " . $value . "  where kodepart = '" . $kode . "' AND nomororder = '" . $nomor . "'");
		} else {
			return $this->db->query("update trnt_orderingsparepartdetail set qtygr = qtygr + " . $value . "  where kodepart = '" . $kode . "' AND nomororder = '" . $nomor . "'");
		}
	}

	function checkorder($nomororder = "")
    {
		return $this->db->query("SELECT sum(qty) as qty , sum(qtygr) as qtygr from trnt_orderingsparepartdetail where nomororder = '" . $nomororder . "'")->result();
	}

	function updateorder($nomororder = "", $statusbatal)
    {
		if  ($statusbatal == TRUE) {
			return $this->db->query("UPDATE trnt_orderingsparepart Set close = FALSE where nomor = '" . $nomororder . "'");
		} else {
			return $this->db->query("UPDATE trnt_orderingsparepart Set close = TRUE where nomor = '" . $nomororder . "'");
		}
	}

	function updateorderum($nomororder = "",$nilaialokasi = "", $statusbatal)
    {
		if  ($statusbatal == TRUE) {
			return $this->db->query("UPDATE trnt_orderingsparepart Set nilaialokasi = nilaialokasi - '" . $nilaialokasi ."' where nomor = '" . $nomororder . "'");
		} else {
			return $this->db->query("UPDATE trnt_orderingsparepart Set nilaialokasi = nilaialokasi + '" . $nilaialokasi ."' where nomor = '" . $nomororder . "'");
		}
	}

	function updateharga($data ="",$nomor = "", $kode = "")
    {
		$this->db->where('nomorpenerimaan', $nomor);
		$this->db->where('kodepart', $kode);
        return $this->db->update('trnt_penerimaansparepartdetail', $data);
	}

	function canceltransaksi($data ="",$nomor)
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_penerimaansparepart', $data);
	}

	function cancelhutang($data ="",$nomor)
    {
		$this->db->where('noreferensi', $nomor);
		// $this->db->where('title', $title);
        return $this->db->update('trnt_hutang', $data);
	}

	function checkpembayaran($nomor)
    {
        return $this->db->query("SELECT * FROM trnt_hutang WHERE ( nilaipembayaran <> 0 or nilaicadanganpembayaran <> 0 ) AND noreferensi = '" . $nomor . "' AND Batal = False")->result();
	}
	
	function cancelalokasi($data, $nomor, $noreferensi)
    {
        $this->db->where('nomorpembelian', $nomor);
        $this->db->where('noreferensi', $noreferensi);
        return $this->db->update('trnt_alokasiuangmukapembelian', $data);
	}
	
	function getMaxNomorAlokasi($nomor = "")
    {
        $this->db->select_max('nomor');
        $this->db->where("left(nomor,10)", $nomor);
        return $this->db->get('trnt_alokasiuangmukapembelian')->row();
	}
	
	function savealokasi($data)
    {
        return $this->db->insert('trnt_alokasiuangmukapembelian', $data);
	}

	function updatepart($data ="", $kode = "", $kodecabang = "", $kodecompany = "")
    {
		$this->db->where('kode', $kode);
		$this->db->where('kodecabang', $kodecabang);
		$this->db->where('kodecompany', $kodecompany);
        return $this->db->update('glbm_parts', $data);
	}
	
	function updatetransaksi($data ="",$nomor = "")
    {
		$this->db->where('nomor', $nomor);
        return $this->db->update('trnt_orderingsparepart', $data);
	}

	function checkmaster($kode = "", $hargasatuan = "", $kodecabang = "", $kodecompany = ""){
		return $this->db->query("select * from glbm_parts where  hargabeli <> " . $hargasatuan . " AND kode = '" . $kode . "' AND kodecabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "'")->result();
	}

}

?>