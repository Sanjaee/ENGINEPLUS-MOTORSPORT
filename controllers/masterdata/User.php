<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/user_model");
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
        $this->load->model('caridata_model');
    }

    public function update()
    {
        // print_r($this->input->post());
        // die();
        $userlogin = $this->session->userdata('myusername');
        $password = $this->input->post('password');
		$mdpass = md5($password);
        $result = $this->user_model->cekPassword($this->input->post('login'),$mdpass);

        if (empty($result)){
            $data = array(
                'password' => $mdpass,
                'nama' => $this->input->post('nama'),
                'grup' => $this->input->post('kode_grup'),
                'alamat' => $this->input->post('alamat'),
                'kode_cabang' => $this->input->post('kode_cabang'),
                'kodesub' => $this->input->post('kodesub'),
                'kodecompany' => $this->input->post('kodecompany'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
            );
        }else
            {
            $data = array(
                    'nama' => $this->input->post('nama'),
                    'grup' => $this->input->post('kode_grup'),
                    'alamat' => $this->input->post('alamat'),
                    'kode_cabang' => $this->input->post('kode_cabang'),
                    'kodesub' => $this->input->post('kodesub'),
                    'kodecompany' => $this->input->post('kodecompany'),
                    'aktif' => $this->input->post('aktif'),
                    'tglsimpan' => date("Y-m-d H:i:s"),
                // 'pemakai' => $this->session->userdata('myusername')
                'pemakai' => $userlogin
            );
        };
            $result = $this->user_model->update($data,$this->input->post('login'));
            if($result == true){
                $resultjson = array(
                    'message' => "Data berhasil diubah");
            }
            else{
                $resultjson = array(
                    'message' => "Data gagal diubah");
            }
            echo json_encode($resultjson);
            // $this->session->set_flashdata('success', 'Berhasil diubah');
    }
    public function find()
    {
            $data = $this->user_model->get($this->input->post('login'));
            echo json_encode($data);
    }

    public function getGrup()
    {
            $data = $this->user_model->getGrup($this->input->post('kode'));
            echo json_encode($data);
    }
    public function getCabang()
    {
            $data = $this->user_model->getCabang($this->input->post('kode'));
            echo json_encode($data);
    }
    public function getSubcabang()
    {
            $data = $this->user_model->getSubcabang($this->input->post('kode'),$this->input->post('kodecabang'), $this->input->post('kodecompany'));
            echo json_encode($data);
    }
    public function getCompany()
    {
            $data = $this->user_model->getCompany($this->input->post('kode'));
            echo json_encode($data);
    }
    public function save()
    {
        $password = $this->input->post('password');
        $mdpass = md5($password);
        $userlogin = $this->session->userdata('myusername');
        $get["user"] = $this->user_model->get($this->input->post('login')); 
		if (!$get["user"]){
            $data = array(
                'login' => $this->input->post('login'),
                'password' => $mdpass,
                'nama' => $this->input->post('nama'),
                'grup' => $this->input->post('kode_grup'),
                'alamat' => $this->input->post('alamat'),
                'kode_cabang' => $this->input->post('kode_cabang'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'kodesub' => $this->input->post('kodesub'),
                'kodecompany' => $this->input->post('kodecompany'),
                'pemakai' => $userlogin
            );
            $result =  $this->user_model->save($data);
            if($result == true){
                $resultjson = array(
                    'message' => "Data berhasil disimpan");
            }
        }
        else{
            $resultjson = array(
                'message' => "Username sudah terdaftar");
        }
        echo json_encode($resultjson);
    }
    function caridataafind(){  

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value'));  
 
        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $sub_array = array(); 
            $i= 1;
            $count = count($this->input->post('field'));
            foreach($this->input->post('field') as $key => $value){
                if ($i <= $count){
                    if ($i == 1){
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcabang" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchok" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
                        $sub_array[] = $row->$value;
                        
                    }
                    else{
                        if ($i == $count){
                            $sub_array[] = $row->$value;
                        }
                        else
                        {
                            $sub_array[] = $row->$value;
                        }
                    }   
                }
            $i++;
        } 
        $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"                    =>     intval($_POST["draw"]),  
            "recordsTotal"          =>      $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),  
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value')),  
            "data"                    =>     $data  
        );  
        echo json_encode($output);  
    } 

    function caridatagrup(){  

        $fetch_data = $this->caridata2_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value'));  
        // print_r($_POST["order"]);
        // print_r($this->input->post('value'));
        // die();
        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $sub_array = array(); 
            $i= 1;
            $count = count($this->input->post('field'));
            foreach($this->input->post('field') as $key => $value){
                if ($i <= $count){
                    if ($i == 1){
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchok" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchgroup" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
                        $sub_array[] = $row->$value;
                        
                    }
                    else{
                        if ($i == $count){
                            $sub_array[] = $row->$value;
                        }
                        else
                        {
                            $sub_array[] = $row->$value;
                        }
                    }   
                }
            $i++;
        } 
        $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"                    =>     intval($_POST["draw"]),  
            "recordsTotal"          =>      $this->caridata2_model->get_all_data($this->input->post('nmtb')),  
            "recordsFiltered"     =>     $this->caridata2_model->get_filtered_data($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where')),  
            "data"                    =>     $data  
        );  
        echo json_encode($output);  
    } 

    function caridatacabang(){  

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value'));  
        // print_r($_POST["order"]);
        // print_r($this->input->post('value'));
        // die();
        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $sub_array = array(); 
            $i= 1;
            $count = count($this->input->post('field'));
            foreach($this->input->post('field') as $key => $value){
                if ($i <= $count){
                    if ($i == 1){
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcabang" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchcabang" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
                        $sub_array[] = $row->$value;
                        
                    }
                    else{
                        if ($i == $count){
                            $sub_array[] = $row->$value;
                        }
                        else
                        {
                            $sub_array[] = $row->$value;
                        }
                    }   
                }
            $i++;
        } 
        $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"                    =>     intval($_POST["draw"]),  
            "recordsTotal"          =>      $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),  
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value')),  
            "data"                    =>     $data  
        );  
        echo json_encode($output);  
    }


    function caridatasubcabang(){  

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value'));  

        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $i= 1;
            $count = count($this->input->post('field'));
            foreach($this->input->post('field') as $key => $value){
                if ($i <= $count){
                    if ($i == 1){
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcustomer" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchsubcabang" data-id="'.$msearch.'"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
                        $sub_array[] = $row->$value;
                        
                    }
                    else{
                        if ($i == $count){
                            $sub_array[] = $row->$value;
                        }
                        else
                        {
                            $sub_array[] = $row->$value;
                        }
                    }   
                }
            $i++;
        } 
        $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"                    =>     intval($_POST["draw"]),  
            "recordsTotal"          =>      $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),  
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value')),  
            "data"                    =>     $data  
        );  
        echo json_encode($output);  
    }


    public function ubah_pass()
    {
        $userlogin = $this->session->userdata('myusername');
        $passlama = $this->input->post('passlama');
        $passbaru = $this->input->post('passbaru');
        $mdpasslama = md5($passlama);
        $mdpass = md5($passbaru);
        
        $get["user"] = $this->user_model->cekPassword($userlogin, $mdpasslama);

        if ($get["user"]){
            $data = array(
                'password' => $mdpass,
                'pemakai' => $userlogin,
                'tglsimpan' => date("Y-m-d H:i:s")
            );
            $result = $this->user_model->update($data, $userlogin);
            if($result == true){
                $resultjson = array(
                    'message' => "Data berhasil diubah");
            }
            else{
                $resultjson = array(
                    'message' => "Data gagal diubah");
            }
        } else {
            $resultjson = array(
            'message' => "Password lama anda salah silahkan cek kembali password lama anda");
        };

        echo json_encode($resultjson);
    }
}
