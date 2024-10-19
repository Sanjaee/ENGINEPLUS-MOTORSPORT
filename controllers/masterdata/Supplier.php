<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/supplier_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'nama' => $this->input->post('nama'),
            'nohp' => $this->input->post('nohp'),
            'notlp' => $this->input->post('notlp'),
            'alamat' => $this->input->post('alamat'),
            'pkp' => $this->input->post('pkp'),
            'npwp' => $this->input->post('npwp'),
            'namanpwp' => $this->input->post('namanpwp'),
            'alamatnpwp' => $this->input->post('alamatnpwp'),
            'aktif' => $this->input->post('aktif'),
            'top' => $this->input->post('top'),
            'norekening' => $this->input->post('norekening'),
            'namarekening' => $this->input->post('namarekening'),
            'namabank' => $this->input->post('namabank'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
        );
            $result = $this->supplier_model->update($data,$this->input->post('nomor'));
            if($result == true){
                $resultjson = array(
                    'nomor' => $this->input->post('nomor'),
                    'message' => "Data berhasil dibah");
            }
            else{
                $resultjson = array(
                    'nomor' => $this->input->post('nomor'),
                    'message' => "Data gagal diubah, silahkan cek kembali");
            }
            echo json_encode($resultjson);
            // $this->session->set_flashdata('success', 'Berhasil diubah');
    }

    public function find()
    {
        $data = $this->supplier_model->get($this->input->post('nomor'));
        echo json_encode($data);
    }

    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $cekdata = $this->supplier_model->cekdata($this->input->post('nama'),$this->input->post('npwp'));
        if (!$cekdata){
            $get["supplier"] = $this->supplier_model->getMaxNomor("S");    
            
            if (!$get["supplier"]){
                $nomor = "S000000001";
            }
            else
            {
                $lastNomor = $get['supplier']->nomor;
                $lastNoUrut = substr($lastNomor, 2, 9); 
    
                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor ="S".sprintf('%09s', $nextNoUrut);
            }
            $data = array(
                'nomor' => $nomor,
                'nama' => $this->input->post('nama'),
                'nohp' => $this->input->post('nohp'),
                'notlp' => $this->input->post('notlp'),
                'alamat' => $this->input->post('alamat'),
                'pkp' => $this->input->post('pkp'),
                'npwp' => $this->input->post('npwp'),
                'namanpwp' => $this->input->post('namanpwp'),
                'alamatnpwp' => $this->input->post('alamatnpwp'),
                'aktif' => $this->input->post('aktif'),
                'top' => $this->input->post('top'),
                'norekening' => $this->input->post('norekening'),
                'namarekening' => $this->input->post('namarekening'),
                'namabank' => $this->input->post('namabank'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                // 'pemakai' => $this->session->userdata('myusername')
                'pemakai' => $userlogin
            );
            $result =  $this->supplier_model->save($data);
            if($result == true){
                $resultjson = array(
                    'nomor' => $nomor,
                    'message' => "Data berhasil disimpan");
            }
            else{
                $resultjson = array(
                    'nomor' => "",
                    'message' => "Data gagal disimpan, silahkan cek kembali");
            }
        }
        else{
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan, Supplier sudah terdaftar dinomor " .$cekdata[0]->nomor);
        }
        echo json_encode($resultjson);
    }
}
