<?php


class Inputfakturpajak_model extends CI_Model
{

  function GetMaxNomorFP($nomor = "")
  {
    $this->db->select_max('nomor');
    $this->db->where("left(nomor,11)", $nomor);
    return $this->db->get('trnt_fakturpajakstandard')->row();
  }

  function GetInvoice($nomor = "")
  {
    $this->db->where('nomor', $nomor);
    return $this->db->get("cari_datafaktur")->result();
  }

  function GetFP($nomor = "")
  {
    $this->db->where('nomor', $nomor);
    return $this->db->get("trnt_fakturpajakstandard")->result();
  }

	function GetNomorFakturPajak($nomor = "")
	{
		$this->db->where('nomor', $nomor);
		return $this->db->get("trnt_registrasinomorfakturpajak");
	}

  function GetDetail($nomor)
  {
    return $this->db->query("SELECT fp.*, c.nama, c.npwp from trnt_fakturpajakstandard fp 
    LEFT JOIN glbm_customer c on c.nomor = fp.kode_customer
    where fp.nomor = '" . $nomor . "'")->result(); 
  }

  function UpdateNoFPInvoice($data = "", $nomor = "")
  {
    $this->db->where('nomor', $nomor);
    return $this->db->update('trnt_faktur', $data);
  }
  function SaveFakturPajak($data = "")
  {
    return $this->db->insert('trnt_fakturpajakstandard', $data);
  }

  function Cancel($data = "", $nomor = "")
  {
    $this->db->where('nomor', $nomor);
    return $this->db->update('trnt_fakturpajakstandard', $data);
  }

	function getLastNomorFakturPajak()
	{
		$query = "SELECT MIN(nomor_fakturpajak) AS nomor_fakturpajak 
          FROM trnt_registrasinomorfakturpajak 
          WHERE status_fakturpajak = false";

		$result = $this->db->query($query)->row();

		return $result;
	}
}
