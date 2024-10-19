<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penghapusanpiutang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('finance/penghapusanpiutang_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function namaaccount()
    {
        $result =  $this->penghapusanpiutang_model->namaaccount($this->input->post('nomor'));
        echo json_encode($result);
    }

    function datafaktur()
    {
        $result =  $this->penghapusanpiutang_model->datafaktur($this->input->post('nomor'));
        echo json_encode($result);
    }

    function save()
    {
        $errorvalidasi = FALSE;
        $datadetail = $this->input->post('datadetail');
        $tglpenghapusan = $this->input->post('tglpenghapusan');
        $noaccount = $this->input->post('noaccount');
        $keterangan = $this->input->post('keterangan');
        $jenis = $this->input->post('jenis');
        $kodecabang = $this->input->post('kodecabang');
        $userlogin = $this->session->userdata('myusername');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        //$userlogin = 'FBS';

        $tglpenghapusanx = date('Ym', strtotime($this->input->post('tglpenghapusan')));

        
        $cekclo = $this->penghapusanpiutang_model->checkclosingacc($tglpenghapusanx, $kodecabang, $kodecompany);
        if (!empty($cekclo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, Periode ini " . $tglpenghapusanx . " Sudah Proses Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }
        
        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $ambilnomor = $kodecabang . "-HP" . substr(date("Y"), 2, 2) . date("m");
            $get["nomor"] = $this->penghapusanpiutang_model->getMaxNomor($ambilnomor);
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
                    'jenistransaksi' => $jenis,
                    'noreferensi' => $value['nomorinvoice'],
                    'jenispencairan' => $jenis,
                    'tanggal' => $tglpenghapusan,
                    'tgltransaksi' => $value['tgltransaksi'],
                    'nomor_customer' => $value['nomorcustomer'],
                    'nilaipiutang' =>  str_replace(",", "", $value['nilaipiutang']),
                    'nilaipenerimaan' => str_replace(",", "", $value['nilaipenghapusan']),
                    'nomoraccount' => $noaccount,
                    'keterangan' => $keterangan,
                    'kode_cabang' => $kodecabang,
                    'kodesubcabang' => $kodesubcabang,
                    'kodecompany' => $kodecompany,
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin,
                    'batal' => false,
                    'keteranganbatal' => '',
                    'kodedepartment' => '',
                    'userbatal' => ''
                );
                $this->penghapusanpiutang_model->savedetail($data);

                //update field nilaipenerimaan di piutang
                $nilaipenghapusan = str_replace(",", "", $value['nilaipenghapusan']);
                $this->penghapusanpiutang_model->updatepiutang($nilaipenghapusan, $value['nomorinvoice']);
                $i++;
            }

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
            return FALSE;
        }
    }

    function find()
    {
        $data = $this->penghapusanpiutang_model->getdatafind($this->input->post('nomor'));
        echo json_encode($data);
    }

    function finddetail()
    {
        $data = $this->penghapusanpiutang_model->getfinddetail($this->input->post('nomor'));
        echo json_encode($data);
    }
    
    function cancel()
    {
        $errorvalidasi = FALSE;
        $alasan = $this->input->post('alasan');
        $nomor = $this->input->post('nomor');
        $datadetail = $this->input->post('datadetail');
        $userlogin = $this->session->userdata('myusername');
        //$userlogin = 'FBS';
        //CEK STATUS BATAL BOOKING   

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            
            $dataheader = array(
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin,
                'keteranganbatal' => $alasan,
                'batal' => true,
            );
            $this->penghapusanpiutang_model->canceltrx($dataheader, $nomor);

            $i = 1;
            foreach ($datadetail as $key => $value) {
                $nilaipenghapusan = str_replace(",", "", $value['nilaipenghapusan']);
                $this->penghapusanpiutang_model->updatepiutangbatal($nilaipenghapusan, $value['nomorinvoice']);
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

    
    function approve()
    {
        $errorvalidasi = FALSE;
        $nomor = $this->input->post('nomor');
        $userlogin = $this->session->userdata('myusername');

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            
            $dataheader = array(
                'tglapprove' => date("Y-m-d H:i:s"),
                'userapprove' => $userlogin,
                'approve' => true,
            );
            $this->penghapusanpiutang_model->canceltrx($dataheader, $nomor);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'nomor' => "",
                    'message' => "Data gagal di approve"
                );
                # Something went wrong.
                $this->db->trans_rollback();
            } else {
                $resultjson = array(
                    'nomor' => $nomor,
                    'message' => "Data berhasil di approve"
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

    function carifaktur()
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
                        $sub_array[] = '<button class="btn btn-primary searchfaktur" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
                    } else if ($i == 5) {
                        $msearch = $row->$value;
                        if ($msearch != "t") {
                            $sub_array[] = '<td>Not Approved Yet</td>';
                        } else {
                            $sub_array[] = '<td>Approved</td>';
                        }
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
