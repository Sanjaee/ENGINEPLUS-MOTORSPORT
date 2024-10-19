<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/konfigurasi_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    
    function konfigurasippn()
    {
        $periode =  date("Ymd", strtotime($this->input->post('tanggal')));
        $result = $this->konfigurasi_model->konfigurasippn($periode);
        echo json_encode($result);
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'kode' => $this->input->post('kode'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'npwp' => $this->input->post('npwp'),
            'ppn' => $this->input->post('ppn')
        );
            $result = $this->konfigurasi_model->update($data,$this->input->post('kode'));
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
            $data = $this->konfigurasi_model->get($this->input->post('kode'));
            echo json_encode($data);
    }
    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $get["kodepos"] = $this->konfigurasi_model->get($this->input->post('kode')); 
		if (!$get["kodepos"]){
            $data = array(
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'npwp' => $this->input->post('npwp'),
                'ppn' => $this->input->post('ppn')
            );
            $result =  $this->konfigurasi_model->save($data);
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