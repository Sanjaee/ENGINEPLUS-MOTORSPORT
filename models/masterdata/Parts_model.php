<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Parts_model extends CI_Model
{

    private $_table = "glbm_parts";

    public function get($kode = "", $kode_cabang = "", $kodecompany = "")
    {
        return $this->db->query("select *  from glbm_parts 
		WHERE lower(kode) = lower('" . $kode . "') and kodecabang = '" . $kode_cabang . "' 
        and kodecompany = '" . $kodecompany . "'")->result();
    }

    public function GetDataPart($kodepart = "", $kode_cabang = "", $kodecompany = "")
    {
        $this->db->where('kodepart',$kodepart);
        $this->db->where('kodecabang',$kode_cabang);
        $this->db->where('kodecompany',$kodecompany);
        return $this->db->get("glbm_partdetail")->result();
    }

    public function GetDataStock($kodepart = "", $kode_cabang = "", $kodecompany = "",  $periode = "")
    {
        return $this->db->query("select (qtyawal + qtymasuk) - qtykeluar as stock  from trnt_stockparts 
		WHERE kodepart = '" . $kodepart . "' and kode_cabang = '" . $kode_cabang . "' 
        and kodecompany = '" . $kodecompany . "' and periode = '" . $periode . "'")->result();
    }
    
    function save($data = "")
    {
		return $this->db->insert($this->_table, $data);
    }

    function savedetail($data = "")
    {
		return $this->db->insert("glbm_partdetail", $data);
	}
    
    public function update($data = "", $kode = "", $kode_cabang = "", $kodecompany = "")
    {
        $this->db->where('kode', $kode);
        $this->db->where('kodecabang', $kode_cabang);
        $this->db->where('kodecompany', $kodecompany);
        return $this->db->update($this->_table, $data);
    }

    public function updatedetail($data = "", $kode = "", $kode_cabang = "", $kodecompany = "")
    {
        $this->db->where('kodepart', $kode);
        $this->db->where('kodecabang', $kode_cabang);
        $this->db->where('kodecompany', $kodecompany);
        return $this->db->update("glbm_partdetail", $data);
    }

    function getminstock($kodepart = "", $kodecabang = "")
    {
        return $this->db->query("SELECT concat('Part ini Sudah mencapai Min Stock : ', minstock, ' Sisa Stock : ',qtyakhir) as saran  from find_partandstock where kode = '" . $kodepart . "' and kodecabang = '" . $kodecabang . "'
        and qtyakhir <= minstock limit 1" )->result();
    }
   
}