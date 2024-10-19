<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subcabang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/subcabang_model");
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('caridataaktif_model');
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'aktif' => $this->input->post('aktif'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $result = $this->subcabang_model->update($data, $this->input->post('kodesub'), $this->input->post('kodecabang'));
        if ($result == true) {
            $resultjson = array(
                'message' => "Data berhasil diubah"
            );
        } else {
            $resultjson = array(
                'message' => "Data gagal diubah"
            );
        }
        echo json_encode($resultjson);
        // $this->session->set_flashdata('success', 'Berhasil diubah');
    }
    public function find()
    {
        $data = $this->subcabang_model->get($this->input->post('kode_cabang'), $this->input->post('kode'));
        echo json_encode($data);
    }
    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $get["cabang"] = $this->subcabang_model->get($this->input->post('kodecabang'), $this->input->post('kodesub'));
        if (!$get["cabang"]) {
            $data = array(
                'kode_cabang' => $this->input->post('kodecabang'),
                'kodesub' => $this->input->post('kodesub'),
                'namasub' => $this->input->post('namasub'),
                'alamat' => $this->input->post('alamat'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $result =  $this->subcabang_model->save($data);
            if ($result == true) {
                $resultjson = array(
                    'message' => "Data berhasil disimpan"
                );
            }
        } else {
            $resultjson = array(
                'message' => "Kode sudah terdaftar"
            );
        }
        echo json_encode($resultjson);
    }

    function finddata(){  

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
                        $sub_array[] = '<button class="btn btn-success searchok" data-id="'.$msearch.'"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
}
