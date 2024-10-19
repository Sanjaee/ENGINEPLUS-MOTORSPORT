<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/account_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'nama' => $this->input->post('nama'),
            'norekening' => $this->input->post('norekening'),
            'kodeprefix' => $this->input->post('kodeprefix'),
            'aktif' => $this->input->post('aktif'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
        );
            $result = $this->account_model->update($data,$this->input->post('nomor'));
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
            $data = $this->account_model->get($this->input->post('nomor'));
            echo json_encode($data);
    }
    public function save()
    {   
        $userlogin = $this->session->userdata('myusername');
        $get["account"] = $this->account_model->get($this->input->post('nomor')); 
		if (!$get["account"]){
            $data = array(
                'nomor' => $this->input->post('nomor'),
                'nama' => $this->input->post('nama'),
                'norekening' => $this->input->post('norekening'),
                'kodeprefix' => $this->input->post('kodeprefix'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                // 'pemakai' => $this->session->userdata('myusername')
                'pemakai' => $userlogin
            );
            $result =  $this->account_model->save($data);
            if($result == true){
                $resultjson = array(
                    'message' => "Data berhasil disimpan");
            }
        }
        else{
            $resultjson = array(
                'message' => "Nomor sudah terdaftar");
        }
        echo json_encode($resultjson);
    }
}
