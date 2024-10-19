<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan_model extends CI_Model
{

    private $_table = "glbm_bahan";

    public function get($kode = "")
    {
        $this->db->where('kode',$kode);
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
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return $result;
        }
    }

    public function update($data = "", $kode = "")
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        $this->db->where('kode', $kode);
        $result = $this->db->update($this->_table, $data);

        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return $result;
        }
    }

   
}