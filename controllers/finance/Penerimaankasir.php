<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaankasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('finance/penerimaankasir_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function jenispenerimaan()
    {
        $result =  $this->penerimaankasir_model->jenispenerimaan($this->input->post('kode'));
        echo json_encode($result);
    }

    public function departemen()
    {
        $result =  $this->penerimaankasir_model->departemen($this->input->post('kode'));
        echo json_encode($result);
    }
    public function datacoa()
    {
        $result =  $this->penerimaankasir_model->datacoa($this->input->post('nomor'));
        echo json_encode($result);
    }
    public function caridatapenerimaan()
    {
        $result =  $this->penerimaankasir_model->caridatapenerimaan($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function accountpenerima()
    {
        $result =  $this->penerimaankasir_model->accountpenerima($this->input->post('nomor'));
        echo json_encode($result);
    }

    function datadetaillist()
    {
        $result =  $this->penerimaankasir_model->datadetaillist($this->input->post('nomor'));
        echo json_encode($result);
    }

    function cancel()
    {
        $errorvalidasi = FALSE;
        $alasan = $this->input->post('alasan');
        $nomor = $this->input->post('nomor');
        $jenistransaksi = $this->input->post('jenistransaksi');
        $datadetail = $this->input->post('datadetail');
        $tglbatal = $this->input->post('tglbatal');
        $userlogin = $this->session->userdata('myusername');
        //$userlogin = 'FBS';
        //CEK STATUS BATAL BOOKING   

        foreach ($datadetail as $key => $value) {
            if ($jenistransaksi == "01") {
                //Uang Muka Service    (klo sudah faktur tidak bisa batal uang muka)          
                $ceksj = $this->penerimaankasir_model->getstatuswo($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal dibatalkan, Nomor " . $value['invoice'] . " Close SPK atau Faktur"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } else if ($jenistransaksi == "02") {
                //Uang muka partcounter             
                $ceksj = $this->penerimaankasir_model->getstatuspc($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " Faktur"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } else if ($jenistransaksi == "51") {
                //Pelunasan Service                
                $ceksj = $this->penerimaankasir_model->getdatafaktur($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal dibatalkan, Nomor " . $value['invoice'] . " Sudah Batal"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            }

            //jika sudah dicairkan maka tidak bisa batal          
            $cekpp = $this->penerimaankasir_model->getpencairanpiutang($value['invoice'],  $nomor);
            if (!empty($cekpp)) {
                $resultjson = array(
                    'error' => true,
                    'message' => "Data gagal dibatalkan, Nomor " . $value['invoice'] . " sudah dicairkan"
                );
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
            }
        }

        $periodebatal = date('Ym', strtotime($tglbatal));
        $periodenow = date('Ym', strtotime(date("Y-m-d H:i:s")));
        $kodecabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');
        if ($periodebatal != $periodenow) {
            $cekgl = $this->penerimaankasir_model->checkclosinggl($periodebatal, $kodecabang, $kodecompany);
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


            $cekclo = $this->penerimaankasir_model->checkclosingacc($periodebatal, $kodecabang, $kodecompany);
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
                $nilaipenerimaan = str_replace(",", "", $value['nilaipenerima']) + str_replace(",", "", $value['nilaialokasi']);
                switch ($jenistransaksi) {
                    case "01":
                        // Uang Muka Service (update ke WO)
                        $this->penerimaankasir_model->updatedpwo($value['invoice'], $nilaipenerimaan, TRUE);
                        break;
                    case "51":
                        //Pelunasan Service (update ke piutang)
                        $this->penerimaankasir_model->updatepenerimaanpiutang($nilaipenerimaan, $value['invoice'], $jenistransaksi, TRUE);
                        break;
                    case "02":
                        // Uang Muka Part counter (update ke order)
                        $this->penerimaankasir_model->updatedppc($value['invoice'], $nilaipenerimaan, TRUE);
                        break;
                    case "52":
                        //Pelunasan part counter (update ke piutang)
                        $this->penerimaankasir_model->updatepenerimaanpiutang($nilaipenerimaan, $value['invoice'], $jenistransaksi, TRUE);
                        break;
                    case "53":
                        //Retur Parts (update ke piutang)
                        $this->penerimaankasir_model->updatepenerimaanpiutang($nilaipenerimaan, $value['invoice'], $jenistransaksi, TRUE);
                        break;
                    case "54":
                        //Pengembalian UM Pembelian Part (update ke order)
                        $this->penerimaankasir_model->updatepenerimaanorder($nilaipenerimaan, $value['invoice'], TRUE);
                        break;
                }
                $i++;
            }

            $dataheader = array(
                'tglbatal' => $tglbatal . ' ' . date("H:i:s"),
                'userbatal' => $userlogin,
                'keteranganbatal' => $alasan,
                'batal' => true,
            );
            $this->penerimaankasir_model->canceltrx($dataheader, $nomor);

            //Cancel piutang kartu
            foreach ($datadetail as $key => $value) {
                $data = array(
                    'tglbatal' => $tglbatal . ' ' . date("H:i:s"),
                    // 'tglbatal' => date("Y-m-d H:i:s"),
                    'userbatal' => $userlogin,
                    'batal' => true,
                );
                $this->penerimaankasir_model->cancelpiutang($data, $nomor);
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
        $data = $this->penerimaankasir_model->getdatafind($this->input->post('nomor'));
        echo json_encode($data);
    }

    function finddata()
    {
        $data = $this->penerimaankasir_model->getfinddata($this->input->post('nomor'));
        echo json_encode($data);
    }

    function save()
    {
        $errorvalidasi = FALSE;
        $tglpenerimaan = $this->input->post('tglpenerimaan');
        $keterangan = $this->input->post('keterangan');
        $jenistransaksi = $this->input->post('jenistransaksi');
        $datadetail = $this->input->post('datadetail');
        $kodecabang = $this->input->post('kodecabang');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $nomorkasiraccount = $this->input->post('nomorkasiraccount');
        $kodedepartemen = $this->input->post('kodedepartemen');

        $tglterima = date('Ym', strtotime($this->input->post('tglpenerimaan')));

        $cekgl = $this->penerimaankasir_model->checkclosinggl($tglterima, $kodecabang, $kodecompany);
        if (!empty($cekgl)) {
            $resultjson = array(
                'error' => true,
                'nomor' => "",
                'message' => "Data gagal disimpan, Periode " . $tglterima . " Sudah Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        $cekclo = $this->penerimaankasir_model->checkclosingacc($tglterima, $kodecabang, $kodecompany);
        if (!empty($cekclo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, Periode ini " . $tglterima . " Sudah Proses Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        $userlogin = $this->session->userdata('myusername');
        //$userlogin = 'FBS';
        //CEK STATUS BATAL BOOKING   
        $kodeprefix = "";

        $getaccountkasir = $this->penerimaankasir_model->accountpenerima($nomorkasiraccount);
        // print_r($getaccountkasir);
        foreach ($getaccountkasir as $value) {
            $kodeprefix = $value->kodeprefix;
            $jenisaccount = $value->jenisaccount;
        };
        foreach ($datadetail as $key => $value) {
            if ($jenistransaksi == "01") {
                //Uang muka service             
                $ceksj = $this->penerimaankasir_model->getstatuswo($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'nomor' => "",
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " Close SPK atau Faktur"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } else if ($jenistransaksi == "02") {
                //Uang muka partcounter             
                $ceksj = $this->penerimaankasir_model->getstatuspc($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'nomor' => "",
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " Faktur"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } else if ($jenistransaksi == "51") {
                //Pelunasan Service                
                $ceksj = $this->penerimaankasir_model->getdatafaktur($value['invoice']);
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
            };
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $ambilnomor = $kodecabang . "-I" . $kodeprefix . substr(date("Y"), 2, 2) . date("m");
            $get["nomor"] = $this->penerimaankasir_model->getMaxNomor($ambilnomor);
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
                $nilaipenerimaan = str_replace(",", "", $value['nilaipenerima']) + str_replace(",", "", $value['nilaialokasi']);
                // echo $nilaipenerimaan;
                // die();
                switch ($jenistransaksi) {
                    case "01":
                        // Uang Muka Service (update ke WO)
                        $this->penerimaankasir_model->updatedpwo($value['invoice'], $nilaipenerimaan, FALSE);
                        break;
                    case "51":
                        //Pelunasan Service (update ke piutang)
                        $this->penerimaankasir_model->updatepenerimaanpiutang($nilaipenerimaan, $value['invoice'], $jenistransaksi, FALSE);
                        break;
                    case "02":
                        // Uang Muka Part counter (update ke order)
                        $this->penerimaankasir_model->updatedppc($value['invoice'], $nilaipenerimaan, FALSE);
                        break;
                    case "52":
                        //Pelunasan part counter (update ke piutang)
                        $this->penerimaankasir_model->updatepenerimaanpiutang($nilaipenerimaan, $value['invoice'], $jenistransaksi, FALSE);
                        break;
                    case "53":
                        //Pelunasan retur parts (update ke piutang)
                        $this->penerimaankasir_model->updatepenerimaanpiutang($nilaipenerimaan, $value['invoice'], $jenistransaksi, FALSE);
                        break;
                    case "54":
                        //Pengembalian Uang Muka Pembelian Part (update ke Order)
                        $this->penerimaankasir_model->updatepenerimaanorder($nilaipenerimaan, $value['invoice'], FALSE);
                        break;
                }
                $data = array(
                    'nomorpenerimaan' => $nomor,
                    'noreferensi' => $value['invoice'],
                    'kodecustomer' => $value['kode'],
                    'namacustomer' => $value['nama'],
                    'nourut' => $i,
                    'nilaipenerimaan' => str_replace(",", "", $value['nilaipenerima']),
                    'kodeaccount' => $value['account'],
                    'nilaialokasi' => str_replace(",", "", $value['nilaialokasi']),
                    'accountalokasi' => $value['accalokasi'],
                    'memo' => $value['memo']
                );
                $this->penerimaankasir_model->savedetail($data);
                $i++;
            }

            //simpan di piutang kartu jika penerimaan jenis account 3/4/5   
            if ($jenisaccount == 3 || $jenisaccount == 4 || $jenisaccount == 5) {
                foreach ($datadetail as $key => $value) {
                    $ambilnomorDK =  $kodecabang . "-DK" . substr(date("Y"), 2, 2) . date("m");
                    $get["nomor"] = $this->penerimaankasir_model->getMaxNomorDK($ambilnomorDK);
                    if (!$get["nomor"]->nomor) {
                        $nomorDK = $ambilnomorDK . "00001";
                    } else {
                        $lastNomor = $get['nomor']->nomor;
                        $lastNoUrut = substr($lastNomor, 10, 11);

                        // nomor urut ditambah 1
                        $nextNoUrut = $lastNoUrut + 1;
                        $nomorDK = $ambilnomorDK . sprintf('%05s', $nextNoUrut);
                    }
                    $data = array(
                        'nomor' => $nomorDK,
                        'tanggal' => $tglpenerimaan,
                        'jenis' => $jenisaccount,
                        'nomorpenerimaan' => $nomor,
                        'noreferensi' => $value['invoice'],
                        'nomor_customer' => $value['kode'],
                        'nomor_kasiraccount' => $value['account'],
                        'nilaipiutang' => str_replace(",", "", $value['nilaipenerima']),
                        'kode_cabang' => $kodecabang,
                        'kodesubcabang' => $kodesubcabang,
                        'kodecompany' => $kodecompany,
                        'tglsimpan' => date("Y-m-d H:i:s"),
                        'pemakai' => $userlogin,
                        'batal' => false,
                        'userbatal' => ''
                    );
                    $this->penerimaankasir_model->savepiutangkartu($data);
                }
            }

            $dataheader = array(
                'nomor' => $nomor,
                'tanggal' => $tglpenerimaan,
                'keterangan' => $keterangan,
                'jenistransaksi' => $jenistransaksi,
                'jenispenerimaan' => $jenisaccount,
                'kode_departemen' => $kodedepartemen,
                'kode_cabang' => $kodecabang,
                'kodesubcabang' => $kodesubcabang,
                'kodecompany' => $kodecompany,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin,
                'batal' => false,
            );
            $this->penerimaankasir_model->saveheader($dataheader);
            // die();
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

    function caridepartemen()
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
                        $sub_array[] = '<button class="btn btn-primary searchkodedepartemen" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
    function cariinvoice()
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
                        $sub_array[] = '<button class="btn btn-primary searchinvoice" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function caricoapenghapusan()
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
                        $sub_array[] = '<button class="btn btn-primary searchcoapenghapusan" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function carikasiraccount()
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
                        $sub_array[] = '<button class="btn btn-primary searchkasiraccount" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
