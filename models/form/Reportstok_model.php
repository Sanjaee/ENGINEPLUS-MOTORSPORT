<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reportstok_model extends CI_Model
{

    function getdatafind($part, $kodecompany)
    {

        $periode = date("Ym");
        return $this->db->query("select * from report_stoksparepart where  kodecompany = '" . $kodecompany . "' AND kodepart = '" . $part . "'AND periode = '" . $periode . "' order by kode_cabang, kodepart ")->result();
    }
    function GetParts($nomor = "", $kodecompany = ""){
		// $this->db->where('kode',$nomor);
		// return $this->db->get("glbm_parts")->result();
		return $this->db->query("select CASE kategori
		when 1 then 'AIR CONDITIONER SYSTEM'
		when 2 then 'BODY PART'
		when 3 then 'BRAKE SYSTEM'
		when 4 then 'CLAMP'
		when 5 then 'COOLING SYSTEM'
		when 6 then 'ELECTRICAL'
		when 7 then 'EXTERNAL ENGINE'
		when 8 then 'FUEL SYSTEM'
		when 9 then 'HOSE'
		when 10 then 'INTAKE & EXHAUST SYSTEM'
		when 11 then 'INTERNAL ENGINE'
		when 12 then 'OIL & CHEMICAL'
		when 13 then 'UNDERCARRIAGE'
		when 14 then 'STEERING & WHEEL'
		when 15 then 'TRANSMISI'
		when 16 then 'OTHER'
		ELSE 'OTHER'
	  END AS kategoripart, *  from glbm_parts where kode = '" . $nomor . "' and kodecompany = '" . $kodecompany . "' ")->result();
	}
}

// date("Y-m-d h:i:sa", $d)
// return $this->db->query("SELECT * FROM absen
// WHERE tanggal >= '" . $tglawal . "'
// AND tanggal >= '" . $tglakhir . "'
// AND kodecabang = '" . $cabang . "'")->result();