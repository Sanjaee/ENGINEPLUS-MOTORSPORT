<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approval_permohonanuang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('finance/approval_permohonanuang_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function getData()
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
                        $nomor = $row->nomor;
                        // $msearch = $row->nomor;
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
            $sub_array[] = '<button class="btn btn-primary searchok" data-id="' . $nomor . '" data-dismiss="modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#findpermohonanuang"><i class="fa fa-hand-o-right"></i></button> ';
            // print_r($nomor);
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

    function getDataWO()
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
            $nopolisi = $row->nopolisi;
            $getkodeapprove = $this->approval_permohonanuang_model->getkodeapprove($nopolisi);
            $kodeapprove =  $getkodeapprove[0]->kodeapprove;
            $sub_array[] = '<button class="btn btn-primary searchwo" data-approve = "' . $kodeapprove . '" data-id="' . $nopolisi . '" data-dismiss="modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#finddatawo"><i class="fa fa-hand-o-right"></i></button> ';
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

    // function getDataWO()
    // {
    //     $data = $this->approval_permohonanuang_model->getDataWO();
    //     echo json_encode($data);
    // }

    function getDataHeader()
    {
        $data = $this->approval_permohonanuang_model->getDataHeader($this->input->post('nomor'));
        echo json_encode($data);
    }

    function getDataHeaderWO()
    {
        $data = $this->approval_permohonanuang_model->getDataHeaderWO($this->input->post('nopolisi'));
        echo json_encode($data);
    }

    function caridatadetail()
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
                        $nilaipermohonan = $row->nilaipermohonan;
                        $totalnilaipermohonan = +$nilaipermohonan;
                        '<input type="text" data-class="' . $totalnilaipermohonan . '"></span>';
                        // $sub_array[] = '<button class="btn btn-primary searchcoa" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
            '<button class="btn btn-primary searchcoa" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
        }
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"                    =>     $data
        );
        echo json_encode($output);
    }

    function caridatawo()
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
            '<button class="btn btn-primary searchcoa" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
        }
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"                    =>     $data
        );
        echo json_encode($output);
    }

    public function approvePermohonan()
    {
        $userlogin = $this->session->userdata('myusername');
        $nomor = $this->input->post('nomor');
        $status = $this->input->post('statusheader');

        if ($status == '0') {
            $data = array(
                'approve' => '1',
                'userapprove' => $userlogin,
                'tglapprove' => date('Y-m-d H:i:s'),
            );
        } else if ($status == '1') {
            $data = array(
                'approve' => '2',
                'userreject' => $userlogin,
                'tglreject' => date('Y-m-d H:i:s'),
                'keteranganreject' => $this->input->post('alasan')
            );
        } else {
            return false;
        }
        $result = $this->approval_permohonanuang_model->approvePermohonan($data, $nomor);
        if ($result == true) {
            $resultjson = array(
                'message' => "Data berhasil diubah"
            );
        } else {
            $resultjson = array(
                'message' => "Data gagal diubah"
            );
        }
        echo json_encode($resultjson);
        // $this->session->set_flashdata('success', 'Berhasil diubah');
    }

    public function approveWO()
    {
        $userlogin = $this->session->userdata('myusername');
        $nopolisi = $this->input->post('nopolisi');
        $statusapprove = $this->input->post('statusapprove');

        if ($statusapprove == '0') {
            $data = array(
                'approve' => '1',
                'userapprove' => $userlogin,
                'tglapprove' => date('Y-m-d H:i:s'),
            );
        } else if ($statusapprove == '1') {
            $data = array(
                'approve' => '2',
                'userreject' => $userlogin,
                'tglreject' => date('Y-m-d H:i:s'),
                'keteranganreject' => $this->input->post('alasan')
            );
        } else {
            return false;
        }
        $result = $this->approval_permohonanuang_model->approveWO($data, $nopolisi);
        if ($result == true) {
            $resultjson = array(
                'message' => "Data berhasil diubah"
            );
        } else {
            $resultjson = array(
                'message' => "Data gagal diubah"
            );
        }
        echo json_encode($resultjson);
        // $this->session->set_flashdata('success', 'Berhasil diubah');
    }
}
