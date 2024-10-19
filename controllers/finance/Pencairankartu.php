<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pencairankartu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('finance/pencairankartu_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function namaaccount()
    {
        $result =  $this->pencairankartu_model->namaaccount($this->input->post('nomor'));
        echo json_encode($result);
    }

    function datalist()
    {
        $result =  $this->pencairankartu_model->datalist($this->input->post('kode_cabang'),$this->input->post('jenis'), $this->input->post('kodesubcabang'),$this->input->post('kodecompany'));
        echo json_encode($result);
        // print_r($result);
        // die();
    }

    function cancel()
    {
        $errorvalidasi = FALSE;
        $alasan = $this->input->post('alasan');
        $nomor = $this->input->post('nomor');
        $datadetail = $this->input->post('datadetail');
        $userlogin = $this->session->userdata('myusername');
        $tglbatal = $this->input->post('tglbatal');
        //$userlogin = 'FBS';
        //CEK STATUS BATAL BOOKING   

        $periodebatal = date('Ym', strtotime($tglbatal));
        $periodenow = date('Ym', strtotime(date("Y-m-d H:i:s")));
        $kodecabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');
        if ($periodebatal != $periodenow) {
            $cekgl = $this->pencairankartu_model->checkclosinggl($periodebatal, $kodecabang, $kodecompany);
            if (!empty($cekgl)) {
                $resultjson = array(
                    'error' => true,
                    'nomor' => "",
                    'message' => "Data gagal disimpan, Periode " . $periodebatal . " Sudah Closing Accounting"
                );
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
            }


            $cekclo = $this->pencairankartu_model->checkclosingacc($periodebatal, $kodecabang, $kodecompany);
            if (!empty($cekclo)) {
                $resultjson = array(
                    'error' => true,
                    'message' => "Proses Gagal, Periode ini " . $periodebatal . " Sudah Proses Closing Accounting"
                );
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
            }
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            
            $dataheader = array(
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin,
                'keteranganbatal' => $alasan,
                'batal' => true,
            );
            $this->pencairankartu_model->canceltrx($dataheader, $nomor);

            $i = 1;
            foreach ($datadetail as $key => $value) {
                $nilaipenerimaan = str_replace(",", "", $value['nilaipenerimaan']);
                $this->pencairankartu_model->updatepiutangkartubatal($nilaipenerimaan, $value['nomorinvoice'], $value['nomorpiutang']);
                $i++;
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'nomor' => "",
                    'message' => "Data gagal dibatalkan, Nomor sudah pernah digunakan"
                );
                # Something went wrong.
                $this->db->trans_rollback();
            } else {
                $resultjson = array(
                    'nomor' => $nomor,
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
    function find()
    {
        $data = $this->pencairankartu_model->getdatafind($this->input->post('nomor'));
        echo json_encode($data);
    }

    function finddetail()
    {
        $data = $this->pencairankartu_model->getfinddetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    function save()
    {
        $errorvalidasi = FALSE;
        $tglpelunasan = $this->input->post('tglpelunasan');
        $kodecabang = $this->input->post('kodecabang');
        $datadetail = $this->input->post('datadetail');
        $bankcharge = $this->input->post('bankcharge');
        $nomorkasiraccountcair = $this->input->post('nomorkasiraccount');
        $userlogin = $this->session->userdata('myusername');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        //$userlogin = 'FBS';

        $tgllunas = date('Ym', strtotime($this->input->post('tglpelunasan')));

        $cekgl = $this->pencairankartu_model->checkclosinggl($tgllunas, $kodecabang, $kodecompany);
        if (!empty($cekgl)) {
            $resultjson = array(
                'error' => true,
                'nomor' => "",
                'message' => "Data gagal disimpan, Periode " . $tgllunas . " Sudah Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        $cekclo = $this->pencairankartu_model->checkclosingacc($tgllunas, $kodecabang, $kodecompany);
        if (!empty($cekclo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, Periode ini " . $tgllunas . " Sudah Proses Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }
        
        $kodeprefix = "";
        foreach ($datadetail as $key => $value) {
            $getaccountkasir = $this->pencairankartu_model->namaaccount($value['noaccount']);
            // print_r($getaccountkasir);
            foreach ($getaccountkasir as $value) {
                $kodeprefix = $value->kodeprefix;
                $jenisaccount = $value->jenisaccount;
            }
        }
        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $ambilnomor = $kodecabang . "-C" . $kodeprefix . substr(date("Y"), 2, 2) . date("m");
            $get["nomor"] = $this->pencairankartu_model->getMaxNomor($ambilnomor);
            if (!$get["nomor"]->nomor) {
                $nomor = $ambilnomor . "00001";
            } else {
                $lastNomor = $get['nomor']->nomor;
                $lastNoUrut = substr($lastNomor, 10, 11);

                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
            }

            $i = 1;
            foreach ($datadetail as $key => $value) {
                
                $data = array(
                    'nomor' => $nomor,
                    'noreferensi' => $value['nomorpiutang'],
                    'tanggal' => $tglpelunasan,
                    'nomorpenerimaan' => $value['nomorpenerimaan'],
                    'jenispenerimaan' => $jenisaccount,
                    'nomor_kasiraccount' => $value['noaccount'],
                    'nomor_kasiraccountcair' => $nomorkasiraccountcair,
                    'nilaipenerimaan' => str_replace(",", "", $value['nilaipenerimaan']),
                    'kode_cabang' => $value['kodecabang'],
                    'kodesubcabang' => $kodesubcabang,
                    'kodecompany' => $kodecompany,
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin,
                    'batal' => false,
                    'userbatal' => ''
                );
                $this->pencairankartu_model->savedetail($data);

                //update field nilaipenerimaan di piutang kartu
                $nilaipenerimaan = str_replace(",", "", $value['nilaipenerimaan']);
                $this->pencairankartu_model->updatepiutangkartu($nilaipenerimaan, $value['nomorinvoice'], $value['nomorpiutang']);
                $i++;
            }

            $data = array(
                'nomor' => $nomor,
                'bankcharge' => str_replace(",", "", $bankcharge),
                'kode_cabang' => $kodecabang,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->pencairankartu_model->savebankcharge($data);

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
                    'nomor' => $nomor,
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

    function caridatafind()
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
                        $sub_array[] = '<button class="btn btn-primary searchok" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
