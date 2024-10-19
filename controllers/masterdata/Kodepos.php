<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kodepos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/kodepos_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kota' => $this->input->post('kota'),
            'provinsi' => $this->input->post('provinsi'),
            'kodepos' => $this->input->post('kodepos'),
            'aktif' => $this->input->post('aktif'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
        );
            $result = $this->kodepos_model->update($data,$this->input->post('kode'));
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
            $data = $this->kodepos_model->get($this->input->post('kode'));
            echo json_encode($data);
    }
    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $get["kodepos"] = $this->kodepos_model->get($this->input->post('kode')); 
		if (!$get["kodepos"]){
            $data = array(
                'kode' => $this->input->post('kode'),
                'kelurahan' => $this->input->post('kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kota' => $this->input->post('kota'),
                'provinsi' => $this->input->post('provinsi'),
                'kodepos' => $this->input->post('kodepos'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                // 'pemakai' => $this->session->userdata('myusername')
                'pemakai' => $userlogin
            );
            $result =  $this->kodepos_model->save($data);
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
