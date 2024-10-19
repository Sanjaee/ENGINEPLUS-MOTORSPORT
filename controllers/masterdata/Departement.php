<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Departement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/departement_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'nama' => $this->input->post('nama'),
            'aktif' => $this->input->post('aktif'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
        );
            $result = $this->departement_model->update($data,$this->input->post('kode'));
            if($result == true){
                $resultjson = array(
                    'kode' => $this->input->post('kode'),
                    'message' => "Data berhasil diubah");
            }
            else{
                $resultjson = array(
                    'kode' =>'',
                    'message' => "Data gagal diubah");
            }
            echo json_encode($resultjson);
            // $this->session->set_flashdata('success', 'Berhasil diubah');
    }
    public function find()
    {
            $data = $this->departement_model->get($this->input->post('kode'));
            echo json_encode($data);
    }
    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $get["departement"] = $this->departement_model->get($this->input->post('kode')); 
		if (!$get["departement"]){
            $data = array(
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                // 'pemakai' => $this->session->userdata('myusername')
                'pemakai' => $userlogin
            );
            $result =  $this->departement_model->save($data);
            if($result == true){
                $resultjson = array(
                    'kode' => $this->input->post('kode'),
                    'message' => "Data berhasil disimpan");
            }
        }
        else{
            $resultjson = array(
                'kode' => "",
                'message' => "Kode sudah terdaftar");
        }
        echo json_encode($resultjson);
    }
}
