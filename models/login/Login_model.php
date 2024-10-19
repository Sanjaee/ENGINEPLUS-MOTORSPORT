<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
    private $_table = "stpm_users";

    public $id;
    public $username;
    // public $password;
    // public $passwordbaru;
    

    public function rules()
    {
        return [
            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required']
        ];
    }
    
    public function getlog($username, $password)
    {
        // $this->db->select('*');
        // $this->db->where('login', $username);
        // $this->db->where('password',$password);
        // $this->db->where('aktif',true);
        // return $this->db->get($this->_table)->row();
        return $this->db->query("SELECT u.*,c.ppn,c.kodegrup from stpm_users u
        inner join glbm_cabang c on c.kode = u.kode_cabang 
        where login = '" . $username . "' and password = '" . $password . "' and u.aktif = true")->row();
    }

    function checkstock($periode = ""){
		return $this->db->query("select * from trnt_stockparts where periode = '" . $periode . "'")->result();
    }
    
    public function stockbulanlalu($periodelama = "", $periode = "")
    {
        return $this->db->query("INSERT INTO trnt_stockparts SELECT '" . $periode . "', kodepart, kode_cabang, qtyawal + qtymasuk - qtykeluar, 0,0,qtykirim,qtyterima,cogs,(qtyawal + qtymasuk - qtykeluar) * cogs, kodecompany,kodesubcabang  FROM trnt_stockparts where periode = '" . $periodelama . "'");
    }

    
}