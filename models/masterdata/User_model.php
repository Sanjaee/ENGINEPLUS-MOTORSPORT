<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    private $_table = "stpm_users";
    private $_table2 = "glbm_cabang";
    private $_table3 = "stpm_grup";

    public function get($login = "")
    {
        $this->db->where('login',$login);
        return $this->db->get($this->_table)->result();
    }

    public function getCabang($kode = "")
    {
        $this->db->where('kode',$kode);
        return $this->db->get($this->_table2)->result();
    }

    public function getSubcabang($kode = "", $kode_cabang = "", $kodecompany = "")
    {
        $this->db->where('kodesub',$kode);
        $this->db->where('kode_cabang',$kode_cabang);
        $this->db->where('kodecompany',$kodecompany);
        return $this->db->get("glbm_subcabang")->result();
    }

    public function getCompany($kode = "")
    {
        $this->db->where('kode',$kode);
        return $this->db->get("stpm_konfigurasi")->result();
    }
    
    public function getGrup($kode = "")
    {
        $this->db->where('kode',$kode);
        return $this->db->get($this->_table3)->result();
    }

    public function cekPassword($login = "",$password = "")
    {
        $this->db->where('login',$login);
        $this->db->where('password',$password);
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
            $this->db->trans_commit($this->input->post('kode'));
            return $result;
        }
    }

    public function update($data = "", $userlogin = "")
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        $this->db->where('login', $userlogin);
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