<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Regularcheck extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/regularcheck_model");
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
            $result = $this->regularcheck_model->update($data,$this->input->post('kode'));
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
            $data = $this->regularcheck_model->get($this->input->post('kode'));
            echo json_encode($data);
    }
    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $errorvalidasi = FALSE;
        $kode = $this->input->post('kode');
        $cek = $this->regularcheck_model->get($kode); 
        if (!empty($cek)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, kode sudah digunakan");
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
        }
		if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $data = array(
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->regularcheck_model->save($data);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'kode' => "",
                    'message' => "Data gagal disimpan, kode sudah pernah digunakan");
                # Something went wrong.
                $this->db->trans_rollback();
            } 
            else {
                $resultjson = array(
                    'kode' => $kode,
                    'message' => "Data berhasil disimpan"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }   
            echo json_encode($resultjson);
            return FALSE;
        }
    }
}
