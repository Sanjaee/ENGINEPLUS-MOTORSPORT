<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Serahterima_unit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('faktur/serahterima_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function GetDataSPK()
    {
        $result =  $this->serahterima_model->GetSPK($this->input->post('nomorspk'));
        echo json_encode($result);
    }

    public function GetDataFaktur()
    {
        $data = $this->serahterima_model->GetFaktur($this->input->post('nomor'));
        echo json_encode($data);
    }

    public function GetDataCustomer()
    {
        $result =  $this->serahterima_model->GetCustomer($this->input->post('nocustomer'));
        echo json_encode($result);
    }

    public function GetDataTipe()
    {
        $result =  $this->serahterima_model->GetTipe($this->input->post('kode_tipe'));
        echo json_encode($result);
    }

    public function GetDataProduct()
    {
        $result =  $this->serahterima_model->GetProduct($this->input->post('kode'));
        echo json_encode($result);
    }

    public function GetDataSerahTerima()
    {
        $result =  $this->serahterima_model->GetSerahTerima($this->input->post('nomor'));
        echo json_encode($result);
    }



    function CariDataSPK()
    {

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));

        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcustomer" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchspk" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                        } else {
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
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"                    =>     $data
        );
        echo json_encode($output);
    }

    function CariDataFaktur()
    {

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchok" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchfaktur" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                        } else {
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
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"                    =>     $data
        );
        echo json_encode($output);
    }
    function CariDataSerahTerima()
    {

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchok" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                        } else {
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
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"                    =>     $data
        );
        echo json_encode($output);
    }

    function Save()
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $userlogin = $this->session->userdata('myusername');

        $ambilnomor = "ST" . substr(date("Y"), 2, 2) . date("m");
        $get["ST"] = $this->serahterima_model->GetMaxNomor($ambilnomor);
        if (!$get["ST"]->nomor) {
            $nomor = $ambilnomor . "00001";
        } else {
            $lastNomor = $get['ST']->nomor;
            $lastNoUrut = substr($lastNomor, 6, 11);

            // nomor urut ditambah 1
            $nextNoUrut = $lastNoUrut + 1;
            $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
        }

        $data = array(
            'nomor' => $nomor,
            'jenisserahterima' => $this->input->post('jenisserahterima'),
            'noreferensi' => $this->input->post('nomorreferensi'),
            'keterangan' => $this->input->post('keterangan'),
            'saran' => $this->input->post('saran'),
            'tanggal' => date("Y-m-d H:i:s"),
            'kode_cabang' => $this->input->post('kodecabang'),
            'kodesubcabang' => $this->input->post('kodesubcabang'),
            'kodecompany' => $this->input->post('kodecompany'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->serahterima_model->SaveHeader($data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan, Nomor sudah pernah digunakan"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'nomor' => $nomor,
                'message' => "Data berhasil disimpan"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
    }

    function Cancel()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'keteranganbatal' => $this->input->post('alasan'),
            'batal' => true,
            'tglbatal' => date("Y-m-d H:i:s"),
            'userbatal' => $userlogin
        );
        $this->serahterima_model->CancelSerahTerima($data, $this->input->post('nomor'));

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor sudah pernah digunakan"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'error' => false,
                'message' => "Data berhasil dibatalkan"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }

        echo json_encode($resultjson);
    }

    public function Update()
	{
        
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $nomor = $this->input->post('nomor');
        $data = array(
            'keterangan' => $this->input->post('keterangan'),
            'saran' => $this->input->post('saran')
        );
        $this->serahterima_model->Update($data,$nomor);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal diupdate"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'error' => false,
                'message' => "Data berhasil diupdate"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }

        echo json_encode($resultjson);
    }
}
