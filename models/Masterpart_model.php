<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Masterpart_model extends CI_Model
{

    public function tampildatapart($kodepart = "")
    {
        $this->db->where('kode', $kodepart);
        $result = $this->db->get('test')->result(); 
        
        return $result; 
    }
}