<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Otorisasi_discount extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('masterdata/otorisasi_discount_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
		$this->load->library('form_validation');
        $this->load->library('session');
    }

    public function GetDataOD()
	{
		$result =  $this->otorisasi_discount_model->GetOD($this->input->post('module'),$this->input->post('grup'));
		echo json_encode($result);
    }

    function Carigrup(){  

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
                        $sub_array[] = '<button class="btn btn-success searchgrup" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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

    public function CarigrupDetail()
	{
		$result =  $this->otorisasi_menu_model->Carigrupdetail($this->input->post('kode'));
		echo json_encode($result);
    }
    
    function CariDataOtorisasiD()
    {
        $fetch_data = $this->caridata2_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $msearch = $row->$value;
                        $sub_array[] = '<button class="btn btn-success searchod" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                        } else {
                            $sub_array[] = $row->$value;
                        }
					}
					// $sub_array[] = $row->$value;
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
    
    public function CariODetail()
	{
		$result =  $this->otorisasi_menu_model->CariODetail($this->input->post('kode'));
		echo json_encode($result);
    }

    function Save(){

        $userlogin = $this->session->userdata('myusername');
        $get["otorisasi"] = $this->otorisasi_discount_model->get($this->input->post('kode'),$this->input->post('module'));
		if (!$get["otorisasi"]){
            $data = array(
                'grup' => $this->input->post('kode'),
                'module' => $this->input->post('module'),
                'nama' => $this->input->post('nama'),
                'maxdisc' => $this->input->post('maxdisc'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $result =  $this->otorisasi_discount_model->SaveData($data);
            if($result == true){
                $resultjson = array(
                    'message' => "Data berhasil disimpan");
            }
        }
        else{
            $resultjson = array(
                'message' => "Kode sudah terdaftar");
        }
        echo json_encode($resultjson);
    }

    public function Update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'nama' => $this->input->post('nama'),
            'maxdisc' => $this->input->post('maxdisc'),
            'aktif' => $this->input->post('aktif'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
        );
            $result = $this->otorisasi_discount_model->update($data,$this->input->post('module'),$this->input->post('kode'));
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

}
?>