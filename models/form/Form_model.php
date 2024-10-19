<?php

class Form_model extends CI_Model
{
	function GetDataPrintSPK($nomor)
	{
		$this->db->where('nomorspk', $nomor);
		return $this->db->get("form_wo")->result();
	}

	function GetDataPrintSub($nomor)
	{
		$this->db->where('nomorwo', $nomor);
		return $this->db->get("form_subwo")->result();
	}
	function GetDataPrintJasa($nomor)
	{
		$this->db->where('nomorwo', $nomor);
		//  $this->db->where('jenis <> 1');
		return $this->db->get("form_wodetail")->result();
	}

	function GetDataPrintSubPart($nomor)
	{
		$this->db->where('nomorwo', $nomor);
		//  $this->db->where('jenis = 1');
		return $this->db->get("form_subwopart")->result();
	}
	function GetDataPrintPart($nomor)
	{
		$this->db->where('nomorwo', $nomor);
		//  $this->db->where('jenis = 1');
		return $this->db->get("form_wopartdetail")->result();
	}


	function GetDataPrintPermohonan($nomor)
	{

		return $this->db->query("SELECT * FROM form_permohonanuang WHERE nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintPermohonanDetail($nomor)
	{

		return $this->db->query("SELECT * FROM form_permohonanuangdetail WHERE nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintPenerimaan($nomor)
	{

		return $this->db->query("select * from form_penerimaankasir WHERE nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintPenerimaanDetail($nomor)
	{

		return $this->db->query("select * from form_penerimaankasirdetail WHERE nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintPencairan($nomor)
	{

		return $this->db->query("select * from form_pencairankartudebitkredit WHERE nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintPencairanDetail($nomor)
	{

		return $this->db->query("SELECT P.nomor, P.tanggal, P.noreferensi, PK.noreferensi as nomordokumen, P.jenispenerimaan,
        CS.nama as namacustomer, P.nomor_kasiraccount, PB.bankcharge, A.nama as namaaccount, A.norekening, P.nilaipenerimaan, P.pemakai
        FROM trnt_pencairanpiutangkartu P
        LEFT JOIN glbm_account A ON A.nomor = P.nomor_kasiraccount
        LEFT JOIN trnt_pencairanpiutangkartu_bankcharge PB on PB.nomor = P.nomor
        LEFT JOIN trnt_piutangkartu PK on PK.nomor = P.noreferensi
        LEFT JOIN glbm_customer CS ON CS.nomor = PK.nomor_customer
        WHERE P.nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintPembebanan($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_pembebananpart")->result();
	}

	function GetDataPrintPembebananDetail($nomor)
	{
		$this->db->where('nomorpembebanan', $nomor);
		return $this->db->get("trnt_pembebananpartsdetail")->result();
	}

	function GetDataPrintFaktur($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_faktur")->result();
	}

	function GetDataPrintSubJasaFaktur($nomor)
	{
		return $this->db->query("select * from form_subfakturjasa where nomorfaktur = '" . $nomor . "' order by kategorijasa asc")->result();
		// $this->db->where('nomorfaktur',$nomor);
		// return $this->db->get("form_subfakturjasa")->result();
	}

	function GetDataPrintSubPartFaktur($nomor)
	{
		return $this->db->query("select * from form_subfakturpart where nomorfaktur = '" . $nomor . "' order by kategori asc")->result();
		// $this->db->where('nomorfaktur',$nomor);
		// return $this->db->get("form_subfakturpart")->result();
	}

	function GetDataPrintFakturDetail($nomor)
	{
		$this->db->where('nomorfaktur', $nomor);
		$this->db->where('jenis <> 1');
		return $this->db->get("form_fakturdetail")->result();
	}

	function GetDataPrintFakturDetailP($nomor)
	{
		$this->db->where('nomorfaktur', $nomor);
		$this->db->where('jenis = 1');
		return $this->db->get("form_fakturdetail")->result();
	}

	function GetDataPrintOPL($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_pekerjaanluar")->result();
	}

	function GetDataPrintOPLDetail($nomor)
	{
		$this->db->where('nomor_opl', $nomor);
		return $this->db->get("trnt_orderpekerjaanluardetail")->result();
		// return $this->db->query("select pd.*, jo.hargajual as hargajualm from trnt_orderpekerjaanluardetail pd 
		// left join glbm_jasaopl jo on jo.kode = pd.kode_pekerjaan where nomor_opl = '" . $nomor . "'")->result();
	}

	function GetDataPrintOrderPart($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_orderpart")->result();
	}

	function GetDataPrintOrderPartDetail($nomor)
	{
		$this->db->where('nomororder', $nomor);
		return $this->db->get("form_orderpartdetail")->result();
	}

	function GetDataPrintPenerimaanPart($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_penerimaanpart")->result();
	}

	function GetDataPrintPenerimaanPartDetail($nomor)
	{
		$this->db->where('nomorpenerimaan', $nomor);
		return $this->db->get("form_penerimaanpartdetail")->result();
	}

	function GetDataPrintPartCounterOrder($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_orderingpartcounter")->result();
	}

	function GetDataPrintPartCounterOrderDetail($nomor)
	{
		$this->db->where('nomor_order', $nomor);
		return $this->db->get("form_orderingpartcounterdetail")->result();
	}

	function GetDataPrintPartCounterFaktur($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_fakturpartcounter")->result();
	}

	function GetDataPrintPartCounterFakturDetail($nomor)
	{
		$this->db->where('nomor_faktur', $nomor);
		return $this->db->get("form_fakturpartcounterdetail")->result();
	}

	function GetDataPrintRequestCabang($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_requestcabang")->result();
	}

	function GetDataPrintRequestCabangDetail($nomor)
	{
		$this->db->where('nomororder', $nomor);
		return $this->db->get("form_requestcabangdetail")->result();
	}

	function GetDataPrintTransferCabang($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_transfercabang")->result();
	}

	function GetDataPrintTransferCabangDetail($nomor)
	{
		$this->db->where('nomortransfer', $nomor);
		return $this->db->get("form_transfercabangdetail")->result();
	}

	function GetDataPrintTransferToHO($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_transfertoho")->result();
	}

	function GetDataPrintTransferToHODetail($nomor)
	{
		$this->db->where('nomortransfer', $nomor);
		return $this->db->get("form_transfertohodetail")->result();
	}

	function GetDataPrintStockOpname($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_stockopname")->result();
	}

	function GetDataPrintStockOpnameDetail($nomor)
	{
		$this->db->where('nomorso', $nomor);
		return $this->db->get("form_stockopnamedetail")->result();
	}

	function GetDataPrintBag($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_bag")->result();
	}

	function GetDataPrintBagDetail($nomor)
	{
		$this->db->where('nomorbag', $nomor);
		return $this->db->get("form_bagdetail")->result();
	}

	function GetDataPrintBooking($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_booking")->result();
	}

	function GetDataPrintBookingDetail($nomor)
	{
		$this->db->where('nomorbooking', $nomor);
		return $this->db->get("trnt_bookingservicedetail")->result();
	}

	function GetDataPrintPenerimaanTransfer($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_penerimaantransfer")->result();
	}

	function GetDataPrintPenerimaanTransferDetail($nomor)
	{
		$this->db->where('nomorterima', $nomor);
		return $this->db->get("form_penerimaantransferdetail")->result();
	}

	function GetDataPrintEst($nomor)
	{
		$this->db->where('nomorest', $nomor);
		return $this->db->get("form_estimasi")->result();
	}
	function GetDataPrintEstD($nomor)
	{
		$this->db->where('nomorestimasi', $nomor);
		$this->db->where('jenis <> 1');
		return $this->db->get("trnt_estimasiwodetail")->result();
	}

	function GetDataPrintEstP($nomor)
	{
		$this->db->where('nomorestimasi', $nomor);
		$this->db->where('jenis = 1');
		return $this->db->get("trnt_estimasiwodetail")->result();
	}

	function GetDataPrintReturPart($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_returpart")->result();
	}

	function GetDataPrintReturPartDetail($nomor)
	{
		$this->db->where('nomorretur', $nomor);
		return $this->db->get("form_returpartdetail")->result();
	}

	function GetDataPrintCloseWO($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_closewo")->result();
	}

	function GetDataPrintCloseWODetail($nomor)
	{
		return $this->db->query("select nospk, jenis, sum(subtotal) as total, kategori from cari_dataspkuntukinvoice 
		where nospk = '" . $nomor . "' and jenis <> 1 group by nospk,kategori, jenis , kategorijasa  order by kategorijasa")->result();
	}

	function GetDataPrintCloseWOPart($nomor)
	{
		return $this->db->query("select nospk, jenis, sum(subtotal) as total, kategori from cari_dataspkuntukinvoice 
		where nospk = '" . $nomor . "' and jenis = 1 group by nospk,kategori, jenis , kategorijasa  order by kategorijasa")->result();
	}

	function GetDataPrintCloseWOTotal($nomor)
	{
		return $this->db->query("
		select a.nospk, sum(a.totalpart) as totalpart, sum(a.totaljasa) as totaljasa from (
		select nospk, case when jenis = 1 then sum(subtotal) else 0 end as totalpart,
		case when jenis <> 1 then sum(subtotal) else 0 end as totaljasa 
		from cari_dataspkuntukinvoice group by nospk, jenis )a 
		where a.nospk = '" . $nomor . "' group by nospk ")->result();
	}

	function GetDataPrintEntryJasa($nomor)
	{
		$this->db->where('no_wo', $nomor);
		return $this->db->get("form_entryjasadetail")->result();
	}

	function GetDataPrintEntryJasaDetail($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("trnt_entryjasadetail")->result();
	}

	function GetDataPrintHistorySO($nopolisi, $norangka)
	{
		return $this->db->query("select * from form_historyso where nopolisi = '" . $nopolisi . "' or norangka = '" . $norangka . "' order by nomorfaktur desc")->result();
	}

	function GetDataPrintPenghapusan($nomor)
	{

		return $this->db->query("SELECT DISTINCT p.nomor, p.tanggal, p.nomoraccount,a.nama, p.keterangan, p.jenistransaksi, c.nama AS perusahaan,
		k.alamat AS alamatperusahaan
        FROM trnt_penghapusanpiutang p
        LEFT JOIN glbm_accountlainlain a ON a.nomor = p.nomoraccount 
		LEFT JOIN stpm_konfigurasi k ON k.kode = p.kodecompany
    	LEFT JOIN glbm_cabang c ON c.kode = p.kode_cabang AND p.kodecompany = c.kodecompany
		WHERE p.nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintPenghapusanDetail($nomor)
	{

		return $this->db->query("select
        PC.noreferensi, PC.nilaipiutang, PC.nilaipenerimaan, COALESCE(C.nama,f.nama_customer) as nama, PC.tgltransaksi, PC.nomor_customer
        from trnt_penghapusanpiutang PC  
        LEFT JOIN glbm_customer C on C.nomor = PC.nomor_customer and PC.jenistransaksi = 51
        LEFT JOIN trnt_partcounterfaktur f on f.nomor = PC.noreferensi and PC.jenistransaksi = 52
        WHERE PC.nomor = '" . $nomor . "'")->result();
	}


	function GetDataPrintEstimasiOrder($nomor)
	{
		return $this->db->query("select p.*, c.nama AS perusahaan, k.alamat AS alamatperusahaan from trnt_estimasiorder p  
		LEFT JOIN stpm_konfigurasi k ON k.kode = p.kodecompany
    	LEFT JOIN glbm_cabang c ON c.kode = p.kode_cabang AND p.kodecompany = c.kodecompany
        WHERE p.nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintEstimasiOrderDetail($nomor)
	{
		return $this->db->query("select * from trnt_estimasiorder PC  
        LEFT JOIN trnt_estimasiorderdetail C on C.noestimasiorder = PC.nomor
        WHERE PC.nomor = '" . $nomor . "'")->result();
	}

	function GetDataPrintSerahTerimaUnit($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_serahterimaunit")->result();
	}

	function GetDataPrintStatusPekerjaan($nomor)
	{
		return $this->db->query("select * from vw_detail_statuspekerjaan
        WHERE nomor = '" . $nomor . "' order by status,kodereferensi,statuspekerjaan")->result();
		// $this->db->where('nomor',$nomor);
		// return $this->db->get("vw_detail_statuspekerjaan")->result();
	}
	function GetDataWorkshopARDetail_GR($nama, $tglmulai, $tglakhir, $jenis, $kodecabang, $kodesubcabang, $kodecompany)
	{
		// $this->db->where('nomor',$nomor);
		if ($jenis == '0') {
			return $this->db->query("select * from report_faktur where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and lower(customer) like lower('%" . $nama . "%')  and statusbayar = 'Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
		} else {
			return $this->db->query("select * from report_faktur where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and lower(customer) like lower('%" . $nama . "%')  and statusbayar = 'Belum Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
		}
	}

	function GetDataWorkshopARDetail_PartCounter($nama, $tglmulai, $tglakhir, $jenis, $kodecabang, $kodecompany)
	{
		// $this->db->where('nomor',$nomor);
		if ($jenis == '2') {
			return $this->db->query("select * from report_fakturpartcountersummary where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(nama_customer) like lower('%" . $nama . "%') and statusbayar = 'Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
		} else {
			return $this->db->query("select * from report_fakturpartcountersummary where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(nama_customer) like lower('%" . $nama . "%') and statusbayar = 'Belum Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
		}
	}

	function GetDataWorkshopARDetail_WOOpen($nama, $kodecabang, $kodecompany)
	{
		// $this->db->where('nomor',$nomor);
		return $this->db->query("select * from report_woharianopen where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(customer) like lower('%" . $nama . "%')")->result();
	}

	function GetDataWorkshopAPDetail_PartCounter($nama, $tglmulai, $tglakhir, $jenis,  $kodecabang, $kodesubcabang, $kodecompany)
	{
		if ($jenis == '2') {
			return $this->db->query("select * from report_podanpenerimaan where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and lower(namasupplier) like lower('%" . $nama . "%') and statusbayar = 'Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'")->result();
		} elseif ($jenis == '3') {
			return $this->db->query("select * from report_podanpenerimaan where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and lower(namasupplier) like lower('%" . $nama . "%') and statusbayar = 'Belum Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "' and nopenerimaan is not null")->result();
		}else{
			return $this->db->query("select * from report_podanpenerimaan where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and kodesubcabang = '" . $kodesubcabang . "' and lower(namasupplier) like lower('%" . $nama . "%') and statusbayar = 'Belum Lunas' and nopenerimaan is null")->result();
		}
	}

	function GetDataWorkshopAPDetail_OPL($nama, $tglmulai, $tglakhir, $jenis, $kodecabang, $kodesubcabang, $kodecompany)
	{
		if ($jenis == '0') {
			return $this->db->query("select * from report_opl where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(namasupplier) like lower('%" . $nama . "%') and statusbayar = 'Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'")->result();
		} else {
			return $this->db->query("select * from report_opl where kode_cabang = '" . $kodecabang . "' and kodecompany = '" . $kodecompany . "' and lower(namasupplier) like lower('%" . $nama . "%') and statusbayar = 'Belum Lunas' and to_char(tanggal,'YYYYMMDD') >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  to_char(tanggal,'YYYYMMDD') <= '" . date('Ymd', strtotime($tglakhir)) . "'")->result();
		}
	}

	
	function GetDataPrintPemakaian($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("form_pemakaianpart")->result();
	}

	function GetDataPrintPemakaianDetail($nomor)
	{
		$this->db->where('nomorpemakaian', $nomor);
		return $this->db->get("trnt_pemakaianpartdetail")->result();
	}
}
