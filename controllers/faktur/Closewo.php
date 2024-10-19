<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Closewo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('faktur/closewo_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function GetDataSPK()
    {
        $result =  $this->closewo_model->GetSPK($this->input->post('nomorspk'));
        echo json_encode($result);
    }
    public function GetDataTipe()
    {
        $result =  $this->closewo_model->GetTipe($this->input->post('kode_tipe'));
        echo json_encode($result);
    }
    public function GetDataProduct()
    {
        $result =  $this->closewo_model->GetProduct($this->input->post('kode'));
        echo json_encode($result);
    }
    public function GetDataCustomer()
    {
        $result =  $this->closewo_model->GetCustomer($this->input->post('nocustomer'));
        echo json_encode($result);
    }
    public function GetDataParts()
    {
        $result =  $this->closewo_model->GetParts($this->input->post('kode'));
        echo json_encode($result);
    }
    public function GetDataTask()
    {
        $result =  $this->closewo_model->GetTask($this->input->post('kode'));
        echo json_encode($result);
    }
    public function GetDataPembebananParts()
    {
        $result =  $this->closewo_model->GetPembebananParts($this->input->post('nomorspk'));
        echo json_encode($result);
    }
    public function GetDataOPL()
    {
        $result =  $this->closewo_model->GetDataOPL($this->input->post('nomorspk'));
        echo json_encode($result);
    }
    public function GetDataPembebananPartsDetail()
    {
        $result =  $this->closewo_model->GetPembebananPartsDetail($this->input->post('nomor'));
        echo json_encode($result);
    }
    function GetSPKDetail()
    {
        $data = $this->closewo_model->GetDataSPKDetail($this->input->post('nomor'));
        echo json_encode($data);
    }
    function FindCloseWO()
    {
        $data = $this->closewo_model->FindCloseWO($this->input->post('nomor'));
        echo json_encode($data);
    }
    function FindFakturDetail()
    {
        $data = $this->closewo_model->GetDataFakturDetail($this->input->post('nomor'));
        echo json_encode($data);
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
        $nomorspk = $this->input->post('nomorspk');

        $errorvalidasi = FALSE;

        $cekopl = $this->closewo_model->checkopl($nomorspk);
        if (!empty($cekopl)) {
            $resultjson = array(
                'nomor' => "",
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " OPL Belum di Invoice "
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekdataopl = $this->closewo_model->checkdataopl($nomorspk);
        if (!empty($cekdataopl)) {
            $resultjson = array(
                'nomor' => "",
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Masih Ada Pekerjaan Luar yang Belum Di input di OPL"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekdatawoopl = $this->closewo_model->checkdatawoopl($nomorspk);
        if (!empty($cekdatawoopl)) {
            $resultjson = array(
                'nomor' => "",
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Masih Ada Pekerjaan Luar yang Belum Di input di WO"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };


        $cekstatusjasa = $this->closewo_model->cekstatusjasa($nomorspk);
        if (!empty($cekstatusjasa)) {
            foreach ($cekstatusjasa as $value) {
                if ($value->statuspekerjaan == '0') {
                    $resultjson = array(
                        'nomor' => "",
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Masih ada jasa yang belum dikerjakan"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }

                if ($value->statuspekerjaan == '1') {
                    $resultjson = array(
                        'nomor' => "",
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Masih ada jasa yang baru proses pengerjaan"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }

                if ($value->statuspekerjaan == '3') {
                    $resultjson = array(
                        'nomor' => "",
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $nomorspk . " ada jasa yang dibatalkan"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            }
        }

        if ($errorvalidasi == FALSE) {
            $ambilnomor = "QC" . substr(date("Y"), 2, 2) . date("m");
            $get["QC"] = $this->closewo_model->GetMaxNomor($ambilnomor);
            if (!$get["QC"]->nomor) {
                $nomor = $ambilnomor . "00001";
            } else {
                $lastNomor = $get['QC']->nomor;
                $lastNoUrut = substr($lastNomor, 6, 11);

                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
            }

            $data = array(
                'nomor' => $nomor,
                'nomorwo' => $this->input->post('nomorspk'),
                'tanggal' => date("Y-m-d H:i:s"),
                'nopolisi' => $this->input->post('nopolisi'),
                'tipe' => $this->input->post('kode_tipe'),
                'nomor_customer' => $this->input->post('nocustomer'),
                'keterangan' => $this->input->post('keterangan'),
                'kode_cabang' => $this->input->post('kodecabang'),
                'kodesubcabang' => $this->input->post('kodesubcabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->closewo_model->SaveHeader($data);

            $data = array(
                'status' => 1
            );
            $this->closewo_model->UpdateStatus($data, $this->input->post('nomorspk'));


            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'nomor' => "",
                    'error' => true,
                    'message' => "Data gagal disimpan, Nomor sudah pernah digunakan"
                );
                # Something went wrong.
                $this->db->trans_rollback();
            } else {
                $resultjson = array(
                    'nomor' => $nomor,
                    'error' => false,
                    'message' => "Data berhasil disimpan"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }
            echo json_encode($resultjson);
        }
    }

    function Cancel()
    {
        $errorvalidasi = FALSE;
        $nomorspk = $this->input->post('nomorspk');
        $userlogin = $this->session->userdata('myusername');
        $cekwo = $this->closewo_model->checkstatuswo($nomorspk);
        if (!empty($cekwo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Dibuatkan Faktur"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        if ($errorvalidasi == FALSE) {
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->closewo_model->CancelWo($data, $this->input->post('nomor'));

            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );

            $data = array(
                'status' => 0
            );
            $this->closewo_model->UpdateStatus($data, $this->input->post('nomorspk'));

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
            return FALSE;
        }
    }
}
