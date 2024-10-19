<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_lain2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/account_lain2_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'nama' => $this->input->post('nama'),
            'jenis' => $this->input->post('jenis'),
            'aktif' => $this->input->post('aktif'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
        );
            $result = $this->account_lain2_model->update($data,$this->input->post('nomor'));
            if($result == true){
                $resultjson = array(
                    'nomor' => $this->input->post('nomor'),
                    'message' => "Data berhasil diubah");
            }
            else{
                $resultjson = array(
                    'nomor' => "",
                    'message' => "Data gagal diubah");
            }
            echo json_encode($resultjson);
            // $this->session->set_flashdata('success', 'Berhasil diubah');
    }
    public function find()
    {
            $data = $this->account_lain2_model->get($this->input->post('nomor'));
            echo json_encode($data);
    }
    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $get["account_lain2"] = $this->account_lain2_model->get($this->input->post('nomor')); 
		if (!$get["account_lain2"]){
            $data = array(
                'nomor' => $this->input->post('nomor'),
                'nama' => $this->input->post('nama'),
                'jenis' => $this->input->post('jenis'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                // 'pemakai' => $this->session->userdata('myusername')
                'pemakai' => $userlogin
            );
            $result =  $this->account_lain2_model->save($data);
            if($result == true){
                $resultjson = array(
                    'nomor' => $this->input->post('nomor'),
                    'message' => "Data berhasil disimpan");
            }
        }
        else{
            $resultjson = array(
                'nomor' => "",
                'message' => "Nomor sudah terdaftar");
        }
        echo json_encode($resultjson);
    }
}
