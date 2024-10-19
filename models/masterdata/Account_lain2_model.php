<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_lain2_model extends CI_Model
{

    private $_table = "glbm_accountlainlain";

    public function get($nomor = "")
    {
        $this->db->where('nomor',$nomor);
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

    public function update($data = "", $nomor = "")
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        $this->db->where('nomor', $nomor);
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