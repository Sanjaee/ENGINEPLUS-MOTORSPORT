<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Revisivoucher extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('finance/revisivoucher_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function namaaccount()
    {
        $result =  $this->revisivoucher_model->namaaccount($this->input->post('nomor'));
        echo json_encode($result);
    }
    
    function namaaccountlain()
    {
        $result =  $this->revisivoucher_model->namaaccountlain($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function departemen()
    {
        $result =  $this->revisivoucher_model->departemen($this->input->post('kode'));
        echo json_encode($result);
    }

    function datalist()
    {
        $result =  $this->revisivoucher_model->datalist($this->input->post('kodecompany'),$this->input->post('jenis'), $this->input->post('tglawal'),$this->input->post('tglakhir'),$this->input->post('kode_cabang'));
        echo json_encode($result);
    }

    function datadetail()
    {
        $result =  $this->revisivoucher_model->datadetail($this->input->post('nomor'));
        echo json_encode($result);
    }

    function save()
    {
        $errorvalidasi = FALSE;
        $tgltransaksi = $this->input->post('tgltransaksi');
        $novoucher = $this->input->post('novoucher');
        $kodetrx = $this->input->post('kodetrx');
        $namatrx = $this->input->post('namatrx');
        $keterangan = $this->input->post('keterangan');
        $kodedepartemen = $this->session->userdata('kodedepartemen');
        if ($kodedepartemen =='') {
            $kodedepartemen = '';
        }else{
            $kodedepartemen = $this->session->userdata('kodedepartemen');
        }
        $namadepartemen = $this->input->post('namadepartemen');
        $jenis = $this->input->post('jenis');
        $datadetail = $this->input->post('datadetail');
        $userlogin = $this->session->userdata('myusername');
        $kodecabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');

        $tgltrx = date('Ym', strtotime($this->input->post('tgltransaksi')));

        $cekgl = $this->revisivoucher_model->checkclosinggl($tgltrx, $kodecabang, $kodecompany);
        if (!empty($cekgl)) {
            $resultjson = array(
                'error' => true,
                'nomor' => "",
                'message' => "Data gagal disimpan, Periode " . $tgltrx . " Sudah Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        $cekclo = $this->revisivoucher_model->checkclosingacc($tgltrx, $kodecabang, $kodecompany);
        if (!empty($cekclo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, Periode ini " . $tgltrx . " Sudah Proses Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        //$userlogin = 'FBS';
        // print_r($kodedepartemen);
        // die();
        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            
            if ($jenis == '1'){
                $data = array(
                    'keterangan' => $keterangan,
                    'tanggal' => $tgltransaksi,
                    'kode_departemen' => $kodedepartemen,
                    'tglverifikasi' => date("Y-m-d H:i:s"),
                    'verifikasi' => TRUE,
                    'userverifikasi' => $userlogin
                );
                $this->revisivoucher_model->verifybtuheader($data,$novoucher);

                $i = 1;
                foreach ($datadetail as $key => $value) {
                    $data = array(
                        'noreferensi' => $value['noinvoice'],
                        'kodecustomer' => $value['kode'],
                        'namacustomer' => $value['nama'],
                        'kodeaccount' => $value['noaccount'],
                        'memo' => $value['memo']
                    );
                    $this->revisivoucher_model->verifybtudetail($data,$novoucher,$value['norefx']);
                }
            }else if ($jenis == '2'){
                $data = array(
                    'keterangan' => $keterangan,
                    'tanggal' => $tgltransaksi,
                    'kode_departemen' => $kodedepartemen,
                    'tglverifikasi' => date("Y-m-d H:i:s"),
                    'verifikasi' => TRUE,
                    'userverifikasi' => $userlogin
                );
                $this->revisivoucher_model->verifybkuheader($data,$novoucher);

                $i = 1;
                foreach ($datadetail as $key => $value) {
                    $data = array(
                        'noreferensi' => $value['noinvoice'],
                        'kodesupplier' => $value['kode'],
                        'namasupplier' => $value['nama'],
                        'kodeaccount' => $value['noaccount'],
                        'memo' => $value['memo']
                    );
                    $this->revisivoucher_model->verifybkudetail($data,$novoucher,$value['norefx']);
                }
            }else if ($jenis == '3' || $jenis == '4' || $jenis == '5'){
                $data = array(
                    'tanggal' => $tgltransaksi,
                    'tglverifikasi' => date("Y-m-d H:i:s"),
                    'verifikasi' => TRUE,
                    'userverifikasi' => $userlogin
                );
                $this->revisivoucher_model->verifypcheader($data,$novoucher);

                $i = 1;
                foreach ($datadetail as $key => $value) {
                    $data = array(
                        'nomor_kasiraccountcair' => $value['noaccount']
                    );
                    $this->revisivoucher_model->verifypcdetail($data,$novoucher,$value['norefx']);
                }
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'error' => true,
                    'nomor' => "",
                    'message' => "Data gagal disimpan, Nomor sudah pernah digunakan"
                );
                # Something went wrong.
                $this->db->trans_rollback();
            } else {
                $resultjson = array(
                    'error' => false,
                    'nomor' => $novoucher,
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
    
    function caricoa()
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
                        $sub_array[] = '<button class="btn btn-primary searchcoa" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function caricoalain()
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
                        $sub_array[] = '<button class="btn btn-primary searchcoalain" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function caridept()
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
                        $sub_array[] = '<button class="btn btn-primary searchdept" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

}
