<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluarankasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('finance/pengeluarankasir_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function jenispermohonanpengeluaran()
    {
        $result =  $this->pengeluarankasir_model->jenispermohonanpengeluaran($this->input->post('kode'));
        echo json_encode($result);
    }

    public function departemen()
    {
        $result =  $this->pengeluarankasir_model->departemen($this->input->post('kode'));
        echo json_encode($result);
    }

    public function caridatacadanganpembayaran()
    {
        $result =  $this->pengeluarankasir_model->caridatacadanganpembayaran($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function tampildatapengeluarankasir()
    {
        $result =  $this->pengeluarankasir_model->tampildatapengeluarankasir($this->input->post('nomor'));
        echo json_encode($result);
    }


    function datadetaillist()
    {
        $result =  $this->pengeluarankasir_model->datadetaillist($this->input->post('nomor'));
        echo json_encode($result);
    }

    function headerpermohonan()
    {
        $result =  $this->pengeluarankasir_model->headerpermohonan($this->input->post('nomor'));
        echo json_encode($result);
    }

    function datadetaillistpermohonan()
    {
        $result =  $this->pengeluarankasir_model->datadetaillistpermohonan($this->input->post('nomor'));
        echo json_encode($result);
    }

    function cancel()
    {
        $errorvalidasi = FALSE;
        $alasan = $this->input->post('alasan');
        $nomor = $this->input->post('nomor');
        $jenistransaksi = $this->input->post('jenistransaksi');
        $datadetail = $this->input->post('datadetail');
        $nopermohonan = $this->input->post('nopermohonan');
        $userlogin = $this->session->userdata('myusername');
        $tglbatal = $this->input->post('tglbatal');
        //$userlogin = 'FBS';
        //CEK STATUS BATAL BOOKING   

        foreach ($datadetail as $key => $value) {
            if ($jenistransaksi == "31") {
                //OPL             
                $ceksj = $this->pengeluarankasir_model->getdatabatalopl($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " Sudah Batal"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } elseif ($jenistransaksi == "33") {
                //Part                
                $ceksj = $this->pengeluarankasir_model->getdatapenerimaanpart($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " sudah dibuatkan penerimaan parts"
                    );
                    $errorvalidasi = true;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } elseif ($jenistransaksi == "32") {
                //Part                 
                $ceksj = $this->pengeluarankasir_model->getdatabatalpart($value['invoice'], $jenistransaksi);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " sudah di buatkan pengeluaran uang"
                    );
                    $errorvalidasi = true;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            }
        }

        $periodebatal = date('Ym', strtotime($tglbatal));
        $periodenow = date('Ym', strtotime(date("Y-m-d H:i:s")));
        $kodecabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');
        if ($periodebatal != $periodenow) {
            $cekgl = $this->pengeluarankasir_model->checkclosinggl($periodebatal, $kodecabang, $kodecompany);
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


            $cekclo = $this->pengeluarankasir_model->checkclosingacc($periodebatal, $kodecabang, $kodecompany);
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
            $i = 1;
            foreach ($datadetail as $key => $value) {
                $nilaipembayaran = str_replace(",", "", $value['nilaipembayaran']) + str_replace(",", "", $value['nilaialokasi']);
                switch ($jenistransaksi) {
                    case "31":
                        //OPL
                        $this->pengeluarankasir_model->updatepembayaranhutang($nilaipembayaran, $value['invoice'], $jenistransaksi, TRUE);
                        break;
                    case "32":
                        //Part
                        $this->pengeluarankasir_model->updatepembayaranhutang($nilaipembayaran, $value['invoice'], $jenistransaksi, TRUE);
                        break;
                    case "33":
                        //Part
                        $this->pengeluarankasir_model->updateumorder($nilaipembayaran, $value['invoice'], TRUE);
                        break;
                }
                $i++;
            }
            $dataheader = array(
                'tglbatal' => $tglbatal . ' ' . date("H:i:s"),
                // 'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin,
                'keteranganbatal' => $alasan,
                'batal' => true,
            );
            $this->pengeluarankasir_model->canceltrx($dataheader, $nomor);
            $this->pengeluarankasir_model->updatestatuspermohonan($nopermohonan, false);
            // die();
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
        $data = $this->pengeluarankasir_model->getdatafind($this->input->post('nomor'));
        echo json_encode($data);
    }

    function finddata()
    {
        $data = $this->pengeluarankasir_model->getfinddata($this->input->post('nomor'));
        echo json_encode($data);
    }

    function save()
    {
        $errorvalidasi = FALSE;
        $tglpembayaran = $this->input->post('tglpembayaran');
        $keterangan = $this->input->post('keterangan');
        $jenistransaksi = $this->input->post('jenistransaksi');
        $datadetail = $this->input->post('datadetail');
        $kodecabang = $this->input->post('kodecabang');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $kodedepartemen = $this->input->post('kodedepartemen');
        $nopermohonan = $this->input->post('nopermohonan');

        $userlogin = $this->session->userdata('myusername');

        $tglbayar = date('Ym', strtotime($this->input->post('tglpembayaran')));

        // $cekapprove = $this->pengeluarankasir_model->checkApproval($nopermohonan, $kodecabang, $kodecompany);
        // if ($cekapprove[0]->approve == '2') {
        //     $resultjson = array(
        //         'error' => true,
        //         'nomor' => "",
        //         'message' => "Data gagal disimpan, Data " .$nopermohonan. " sudah di reject !!"
        //     );
        //     $errorvalidasi = TRUE;
        //     echo json_encode($resultjson);
        //     return FALSE;
        // }

        $cekgl = $this->pengeluarankasir_model->checkclosinggl($tglbayar, $kodecabang, $kodecompany);
        if (!empty($cekgl)) {
            $resultjson = array(
                'error' => true,
                'nomor' => "",
                'message' => "Data gagal disimpan, Periode " . $tglbayar . " Sudah Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        $cekclo = $this->pengeluarankasir_model->checkclosingacc($tglbayar, $kodecabang, $kodecompany);
        if (!empty($cekclo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, Periode ini " . $tglbayar . " Sudah Proses Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        //$userlogin = 'FBS';
        //CEK STATUS BATAL BOOKING   
        $kodeprefix = "";
        foreach ($datadetail as $key => $value) {
            $getaccountkasir = $this->pengeluarankasir_model->accountpenerima($value['account']);
            // print_r($getaccountkasir);
            foreach ($getaccountkasir as $value) {
                $kodeprefix = $value->kodeprefix;
                $jenisaccount = $value->jenisaccount;
            }
        }
        foreach ($datadetail as $key => $value) {
            if ($jenistransaksi == "31") {
                //OPL           
                $ceksj = $this->pengeluarankasir_model->getdatabatalopl($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'nomor' => "",
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " Sudah Batal"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } elseif ($jenistransaksi == "32") {
                //Part               
                $ceksj = $this->pengeluarankasir_model->getdatabatalpart($value['invoice']);
                // print_r($ceksj);
                // die();
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'nomor' => "",
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " Sudah Batal"
                    );
                    $errorvalidasi = true;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            };
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $ambilnomor = $kodecabang . "-O" . $kodeprefix . substr(date("Y"), 2, 2) . date("m");
            $get["nomor"] = $this->pengeluarankasir_model->getMaxNomor($ambilnomor);
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
                $nilaicadangan = str_replace(",", "", $value['nilaipembayaran']) + str_replace(",", "", $value['nilaialokasi']);
                // echo $nilaicadangan;
                // die();
                switch ($jenistransaksi) {
                    case "31":
                        //OPL
                        $this->pengeluarankasir_model->updatepembayaranhutang($nilaicadangan, $value['invoice'], $jenistransaksi, FALSE);
                        break;
                    case "32":
                        //Part
                        $this->pengeluarankasir_model->updatepembayaranhutang($nilaicadangan, $value['invoice'], $jenistransaksi, FALSE);
                        break;
                    case "33":
                        //Uang muka Part
                        $this->pengeluarankasir_model->updateumorder($nilaicadangan, $value['invoice'], FALSE);
                        break;
                }
                $data = array(
                    'nomorpembayaran' => $nomor,
                    'noreferensi' => $value['invoice'],
                    'kodesupplier' => $value['kode'],
                    'namasupplier' => $value['nama'],
                    'nourut' => $i,
                    'nilaipembayaran' => str_replace(",", "", $value['nilaipembayaran']),
                    'kodeaccount' => $value['account'],
                    'nilaialokasi' => str_replace(",", "", $value['nilaialokasi']),
                    'accountalokasi' => $value['accalokasi'],
                    'memo' => $value['memo']
                );
                $this->pengeluarankasir_model->savedetail($data);
                $i++;
            }
            $dataheader = array(
                'nomor' => $nomor,
                'nomorpermohonan' => $nopermohonan,
                'tanggal' => $tglpembayaran,
                'keterangan' => $keterangan,
                'jenistransaksi' => $jenistransaksi,
                'jenispermohonanpengeluaran' => $jenisaccount,
                'kode_departemen' => $kodedepartemen,
                'kode_cabang' => $kodecabang,
                'kodesubcabang' => $kodesubcabang,
                'kodecompany' => $kodecompany,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin,
                'batal' => false,
            );
            $this->pengeluarankasir_model->saveheader($dataheader);
            // die();
            $this->pengeluarankasir_model->updatestatuspermohonan($nopermohonan, true);
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

    function cariJenisTransaksi()
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
                        $sub_array[] = '<button class="btn btn-primary searchkodetransaksi" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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


    function caridatapermohonan()
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
                        $sub_array[] = '<button class="btn btn-primary searchnopermohonan" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
