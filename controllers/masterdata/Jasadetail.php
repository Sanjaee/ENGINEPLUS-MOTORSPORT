<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jasadetail extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('masterdata/jasadetail_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
		$this->load->library('form_validation');
        $this->load->library('session');
    }    

    function CariJasaHead(){  

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
                        $sub_array[] = '<button class="btn btn-success searchhead" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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

    function CariJasaDetail()
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
                        $sub_array[] = '<button class="btn btn-success searchjasadetail" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';
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

    public function GetJasaHead()
	{
		$result =  $this->jasadetail_model->GetJasaHead($this->input->post('kode'));
		echo json_encode($result);
    }

    public function GetJasaDetail()
	{
		$result =  $this->jasadetail_model->GetJasaDetail($this->input->post('kode'));
		echo json_encode($result);
    }

    public function Getdetail()
	{
		$result =  $this->jasadetail_model->Getdetail($this->input->post('kode'));
		echo json_encode($result);
    }



    function Save(){
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);
        $userlogin = $this->session->userdata('myusername');
        $jasaheadkode = $this->input->post('jasaheadkode');
        
        $this->jasadetail_model->DeleteJasa($jasaheadkode);

        foreach ($this->input->post('datadetail') as $key => $value) {
                $data = array(
                    'kode_jasahead' => $value['kodehead'],
                    'kode_jasa' => $value['kodejasadetail'],
                    'nama_jasa'=> $value['namajasadetail']
                );
                $this->jasadetail_model->SaveData($data);
        }

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
                'nomor' => $jasaheadkode,
                'message' => "Data berhasil disimpan"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }   
        echo json_encode($resultjson);
    }

}
