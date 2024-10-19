<?php

ini_set('max_execution_time', 800);
ini_set('memory_limit', '2048M');
defined('BASEPATH') OR exit('No direct script access allowed');

class Jasatipe extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('masterdata/jasatipe_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
    }

    public function CariJasaDetail()
	{
		$result =  $this->jasatipe_model->CariJasaDetail($this->input->post('kode'),$this->input->post('kodeproduct'));
		echo json_encode($result);
    }

    public function CariJasaHead()
	{
		$result =  $this->jasatipe_model->CariJasaHead($this->input->post('kode'));
		echo json_encode($result);
    }

    public function Carimodeldetail()
	{
		$result =  $this->jasatipe_model->Carimodeldetail($this->input->post('kode'));
		echo json_encode($result);
    }

    public function Getdetail()
	{
        // print_r($this->input->post('kode'));
        // die();
		$result =  $this->jasatipe_model->Getdetail($this->input->post('kode'));
		echo json_encode($result);
    }



    function Carimodel(){  

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
                        $sub_array[] = '<button class="btn btn-success searchmodel" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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
    function Carijasa(){  

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
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchok" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchjasa" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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


    function Save(){
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);
        $userlogin = $this->session->userdata('myusername');
        $kode = $this->input->post('kode');
        
        $this->jasatipe_model->DeleteJasa($kode);
    //     foreach ($this->input->post('detailrequest') as $key => $value) {
    //         print_r ($value["kodejasa"]);
    //         print_r ($value["hargajasa"]);
    //     echo "<br>";
       
    // }
    // die();
        foreach ($this->input->post('detailrequest') as $key => $value) {
                // $data = array(
                //     'kode' => pg_escape_string($value['kodejasa']),
                //     'kodeproduct' => pg_escape_string($value['kodemodel']),
                //     'jam'=> pg_escape_string(str_replace(",", "", $value['jam'])),
                //     'frt'=> pg_escape_string(str_replace(",", "", $value['frt'])),
                //     'harga' => pg_escape_string(str_replace(",", "", $value['hargajasa'])),
                //     'aktif' => true,
                //     'tglsimpan' => date("Y-m-d H:i:s"),
                //     'pemakai' => $userlogin
                // );
                $data[] = '("'.($value['kodejasa']).'","'.($value['kodemodel']).'","'.(str_replace(",", "", $value['jam'])).'","'.(str_replace(",", "", $value['frt'])).'","'.(str_replace(",", "", $value['hargajasa'])).'",true, "'.date("Y-m-d H:i:s").'","'.$userlogin.'")';
                
        }
        $datax = str_replace('"',"'",(implode(',',$data)));
                
        $this->jasatipe_model->SaveData($datax);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan, Nomor sudah pernah digunakan");
            # Something went wrong.
            $this->db->trans_rollback();
        } 
        else {
            $resultjson = array(
                'nomor' => $kode,
                'message' => "Data berhasil disimpan"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }   
        echo json_encode($resultjson);
    }

}
