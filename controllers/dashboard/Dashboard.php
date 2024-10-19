<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('dashboard/dashboard_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
        $this->load->library('form_validation');
        $this->load->library('session');
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
                    // if ($i == 1) {
                    //     $msearch = $row->$value;
                    //     $sub_array[] = '<button class="btn btn-primary searchsn" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
                    //     $sub_array[] = $row->$value;
                    // } else {
                    //     if ($i == $count) {
                    //         $sub_array[] = $row->$value;
                    //     } else {
                    //         $sub_array[] = $row->$value;
                    //     }
                    // }
                    $sub_array[] = $row->$value;
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

    function CariDataAP()
    {
        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 5) {
                        $sub_array[] = $this->rupiah($row->$value);
                    } else {
                        $sub_array[] = $row->$value;
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
    function rupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
    function CariDataAR()
    {
        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 4) {
                        $sub_array[] = $this->rupiah($row->$value);
                    } else {
                        $sub_array[] = $row->$value;
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

    function GetDataSumFaktur()
    {
        $result =  $this->dashboard_model->GetSumFaktur($this->input->post('tanggal'));
        echo json_encode($result);
    }

    function GetDataSumPiutang()
    {
        $result =  $this->dashboard_model->GetSumPiutang($this->input->post('tanggal'));
        echo json_encode($result);
    }

    function GetDataSumHutang()
    {
        $result =  $this->dashboard_model->GetSumHutang($this->input->post('tanggal'));
        echo json_encode($result);
    }

    function GetDataSumPenerimaan()
    {
        $result =  $this->dashboard_model->GetSumPenerimaan($this->input->post('tanggal'));
        echo json_encode($result);
    }

    function GetDataSumPengeluaran()
    {
        $result =  $this->dashboard_model->GetSumPengeluaran($this->input->post('tanggal'));
        echo json_encode($result);
    }

    function GetDataSumPencairan()
    {
        $result =  $this->dashboard_model->GetSumPencairan($this->input->post('tanggal'));
        echo json_encode($result);
    }

    function loadDataSPKChart()
    {
        $result =  $this->dashboard_model->loadSPKChart($this->input->post('tanggal'));
        echo json_encode($result);
    }

    function loadDataFakturChart()
    {
        $result =  $this->dashboard_model->loadFakturChart($this->input->post('tanggal'));
        echo json_encode($result);
    }
}
