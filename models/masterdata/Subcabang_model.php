<?php defined('BASEPATH') or exit('No direct script access allowed');

class Subcabang_model extends CI_Model
{

    private $_table = "glbm_subcabang";

    public function get($kodecabang = "", $kodesub = "")
    {
        $this->db->where('kode_cabang', $kodecabang);
        $this->db->where('kodesub', $kodesub);
        return $this->db->get($this->_table)->result();
    }


    public function save($data = "")
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        $result = $this->db->insert($this->_table, $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return $result;
        }
    }

    public function update($data = "", $kodesub = "", $kodecabang = "")
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        $this->db->where('kode_cabang', $kodecabang);
        $this->db->where('kodesub', $kodesub);
        $result = $this->db->update($this->_table, $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return $result;
        }
    }
}
