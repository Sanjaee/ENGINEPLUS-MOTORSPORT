<?php

class Entry_spk_model extends CI_Model
{
	function cekWO($nopolisi)
	{
		return $this->db->query("SELECT
									count(w.nopolisi) as nopolisi,
									kc.approve
								FROM
									trnt_wo w
									LEFT JOIN trnt_kendaraancustomer kc ON kc.nopolisi = w.nopolisi
								WHERE
									w.nopolisi = '" . $nopolisi . "'
									AND w.status = '0'
								GROUP BY
									kc.approve")->result();
	}

	function cekNopolisi($nopolisi)
	{
		return $this->db->query("SELECT  count(nopolisi) as nopolisi FROM trnt_wo WHERE nopolisi = '" . $nopolisi . "' AND status = '0'")->result();
	}

	function GetSN($nomor = "")
	{
		$this->db->where('nosn', $nomor);
		return $this->db->get("trnt_databarang")->result();
	}

	function getdatamobil($nopol)
	{
		return $this->db->query("select DK.nopolisi,DK.norangka, DK.kodetipe, DK.namatipe, DK.nomor_customer, C.nama,
		DK.namapic, DK.nohppic, DK.odmeterakhir, T.kodekategori as model
		from trnt_kendaraancustomer DK 
		left join glbm_customer C on C.nomor = DK.nomor_customer 
		left join glbm_tipe T on T.kode = DK.kodetipe
		where  nopolisi = '" . $nopol . "'")->result();
	}

	function GetTipe($nomor = "")
	{
		$this->db->where('kode', $nomor);
		return $this->db->get("glbm_tipe")->result();
	}

	function GetCustomer($nomor = "")
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("glbm_customer")->result();
	}

	function GetProduct($nomor = "")
	{
		$this->db->where('kode', $nomor);
		return $this->db->get("glbm_product")->result();
	}

	function GetTeknisi($nomor = "")
	{
		$this->db->where('kode', $nomor);
		return $this->db->get("glbm_teknisi")->result();
	}

	function GetForeman($nomor = "")
	{
		$this->db->where('kode', $nomor);
		return $this->db->get("glbm_foreman")->result();
	}

	function GetParts($nomor = "", $kode_cabang = "", $kodecompany = "")
	{
		// $this->db->where('kode',$nomor);
		// return $this->db->get("glbm_parts")->result();
		return $this->db->query("select CASE kategori
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
		ELSE 'OTHER'
	  END AS kategoripart, *  from glbm_parts where kode = '" . $nomor . "' and kodecabang = '" . $kode_cabang . "' and kodecompany = '" . $kodecompany . "' ")->result();
	}

	function GetTask($nomor = "", $model = "")
	{
		$this->db->where('kode', $nomor);
		$this->db->where('kodeproduct', $model);
		return $this->db->get("cari_jasa")->result();
	}

	function GetOPL($nomor = "")
	{
		$this->db->where('kode', $nomor);
		return $this->db->get("glbm_jasaopl")->result();
	}

	function GetMaxNomor($nomor = "")
	{
		$this->db->select_max('nomor');
		$this->db->where("left(nomor,11)", $nomor);
		return $this->db->get('trnt_wo')->row();
	}

	function GetDataFindDetail($nomor)
	{
		$this->db->where('nomorwo', $nomor);
		// $this->db->where_in('statuspekerjaan', array('0','1'));
		return $this->db->get("trnt_wodetail")->result();
	}

	function GetDataFind($nomor)
	{
		// $this->db->where('nomor',$nomor);
		// return $this->db->get("trnt_wo")->result();
		return $this->db->query("select * from trnt_wo w left join glbm_tipe t on t.kode = w.tipe where  nomor = '" . $nomor . "'")->result();
	}

	function SaveDetail($data = "")
	{
		return $this->db->insert('trnt_wodetail', $data);
	}


	function DeleteDetail($nomor = "", $kode = "")
	{
		$this->db->where('nomorwo', $nomor);
		//$this->db->where('kodereferensi', $kode);
		return $this->db->delete('trnt_wodetail');
	}

	function SaveHeader($data = "")
	{
		return $this->db->insert('trnt_wo', $data);
	}

	function UpdateHeader($data = "", $nomor = "")
	{
		$this->db->where('nomor', $nomor);
		return $this->db->update('trnt_wo', $data);
	}

	function CancelTransaksi($data = "", $nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->update('trnt_wo', $data);
	}

	function CekDp($nomorspk)
	{
		return $this->db->query("select * from trnt_wo where  nomor = '" . $nomorspk . "' and nilaiuangmuka <> 0")->result();
	}
	function GetDataPrint($nomor)
	{
		$this->db->where('nomorspk', $nomor);
		return $this->db->get("form_wo")->result();
	}
	function GetDataPrintJasa($nomor)
	{
		$this->db->where('nomorwo', $nomor);
		// $this->db->where('jenis <> 1');
		return $this->db->get("trnt_wodetail")->result();
	}


	function checkmemopembatalan($nomorspk = "")
	{
		return $this->db->query("select * from trnt_memopembatalanspk where  nospk = '" . $nomorspk . "' AND batal = false")->result();
	}

	function checkstatuswo($nomorspk = "")
	{
		return $this->db->query("select * from trnt_wo where  nomor = '" . $nomorspk . "' AND status > '0'")->result();
	}

	function CekPembebanan($nomorspk = "")
	{
		return $this->db->query("select * from trnt_pembebananparts where  nomorwo = '" . $nomorspk . "' AND Batal = False")->result();
	}

	function checkopl($nomorspk = "")
	{
		return $this->db->query("select * from trnt_orderpekerjaanluar where  nomor_wo = '" . $nomorspk . "' AND batal = False")->result();
	}

	function GetDataBooking($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("trnt_bookingservice")->result();
	}

	function BookDetail($nomor)
	{
		$this->db->where('nomorbooking', $nomor);
		return $this->db->get("trnt_bookingservicedetail")->result();
	}

	function UpdateBooking($nomor = "", $statusbatal)
	{
		if ($statusbatal == TRUE) {
			return $this->db->query("UPDATE trnt_bookingservice set status = 0 where  nomor = '" . $nomor . "' AND batal = False");
		} else {
			return $this->db->query("UPDATE trnt_bookingservice set status = 1 where  nomor = '" . $nomor . "' AND batal = False");
		}
	}

	function Getregularcheck($kode = "")
	{
		$this->db->where('kode', $kode);
		return $this->db->get("glbm_regularchecklist")->result();
	}

	function GetDataRegularDetail($kode = "", $kodemodel = "")
	{
		$this->db->where('kode_regularcheck', $kode);
		$this->db->where('kode_model', $kodemodel);
		return $this->db->get("cari_dataregularcheck")->result();
	}

	function GetDataEstimasi($nomor)
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("trnt_estimasiwo")->result();
	}

	function EstimasiDetail($nomor)
	{
		$this->db->where('nomorestimasi', $nomor);
		return $this->db->get("trnt_estimasiwodetail")->result();
	}

	function UpdateEstimasi($nomor = "", $statusbatal)
	{
		if ($statusbatal == TRUE) {
			return $this->db->query("UPDATE trnt_estimasiwo set status = 0 where  nomor = '" . $nomor . "' AND batal = False");
		} else {
			return $this->db->query("UPDATE trnt_estimasiwo set status = 1 where  nomor = '" . $nomor . "' AND batal = False");
		}
	}
}
