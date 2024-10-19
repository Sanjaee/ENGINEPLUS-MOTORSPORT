<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/bahan_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'nama' => $this->input->post('nama'),
            'hargabeli' => str_replace(",","",$this->input->post('hargabeli')),
            'hargajual' => str_replace(",","",$this->input->post('hargajual')),
            'aktif' => $this->input->post('aktif'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
        );
            $result = $this->bahan_model->update($data,$this->input->post('kode'));
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
            $data = $this->bahan_model->get($this->input->post('kode'));
            echo json_encode($data);
    }
    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $get["bahan"] = $this->bahan_model->get($this->input->post('kode')); 
		if (!$get["bahan"]){
            $data = array(
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'hargabeli' => str_replace(",","",$this->input->post('hargabeli')),
                'hargajual' => str_replace(",","",$this->input->post('hargajual')),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                // 'pemakai' => $this->session->userdata('myusername')
                'pemakai' => $userlogin
            );
            $result =  $this->bahan_model->save($data);
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
}
