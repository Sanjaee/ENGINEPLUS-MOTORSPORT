<?php


class Jasatipe_model extends CI_Model{ 

  function CariJasaDetail($kode = "", $kodeproduct = "")
  {
    return $this->db->query("SELECT TT.kode, j.nama, TT.frt, TT.jam, TT.harga FROM glbm_jasatipe TT 
    LEFT JOIN glbm_jasa J on J.kode = TT.kode 
    where TT.aktif = true and TT.kode = '" . $kode . "'and  kodeproduct = '" . $kodeproduct . "'")->result();
  }

  function CariJasaHead($kode = "")
  {
    $this->db->where('kode',$kode);
    return $this->db->get("glbm_jasa")->result();
  }
  
  function Carimodeldetail($kode = "")
  {
    $this->db->where('kode',$kode);
    return $this->db->get("glbm_product")->result();
  }
  
  function Getdetail($kode = "")
  {
    return $this->db->query("SELECT TT.kode, j.nama, TT.kodeproduct, P.nama as namamodel, TT.frt, TT.jam, TT.harga FROM glbm_jasatipe TT 
    LEFT JOIN glbm_jasa J on J.kode = TT.kode 
    LEFT JOIN glbm_product P on P.kode = TT.kodeproduct
    where TT.aktif = true and kodeproduct = '" . $kode . "'")->result();
  }

  function SaveData($data = "")
  {
    // return $this->db->insert('glbm_jasatipe', $data);
    return $this->db->query("insert into glbm_jasatipe values $data");
  }

  function DeleteJasa($kode ="")
  {
		$this->db->where('kodeproduct', $kode);
    return $this->db->delete('glbm_jasatipe');
	}

}

?>