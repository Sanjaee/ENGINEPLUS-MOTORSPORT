<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permohonanpengeluarankasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('finance/permohonanpengeluarankasir_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function jenispermohonanpengeluaran()
    {
        $result =  $this->permohonanpengeluarankasir_model->jenispermohonanpengeluaran($this->input->post('kode'));
        echo json_encode($result);
    }

    public function departemen()
    {
        $result =  $this->permohonanpengeluarankasir_model->departemen($this->input->post('kode'));
        echo json_encode($result);
    }
    public function datacoa()
    {
        $result =  $this->permohonanpengeluarankasir_model->datacoa($this->input->post('nomor'));
        echo json_encode($result);
    }
    public function caridatacadanganpembayaran()
    {
        $result =  $this->permohonanpengeluarankasir_model->caridatacadanganpembayaran($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function tampildatapermohonanpengeluarankasir()
    {
        $result =  $this->permohonanpengeluarankasir_model->tampildatapermohonanpengeluarankasir($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function accountpembayaran()
    {
        $result =  $this->permohonanpengeluarankasir_model->accountpembayaran($this->input->post('nomor'));
        echo json_encode($result);
    }

    function datadetaillist()
    {
        $result =  $this->permohonanpengeluarankasir_model->datadetaillist($this->input->post('nomor'));
        echo json_encode($result);
    }

    function cancel()
    {
        $errorvalidasi = FALSE;
        $alasan = $this->input->post('alasan');
        $nomor = $this->input->post('nomor');
        $jenistransaksi = $this->input->post('jenistransaksi');
        $datadetail = $this->input->post('datadetail');

        $userlogin = $this->session->userdata('myusername');
        //$userlogin = 'FBS';
        //CEK STATUS BATAL BOOKING   

        foreach ($datadetail as $key => $value) {
            if ($jenistransaksi == "31") {
                //OPL                
                $ceksj = $this->permohonanpengeluarankasir_model->getdatabatalopl($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " Sudah Batal"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
                $cekhutang = $this->permohonanpengeluarankasir_model->cekhutang($value['invoice'], $jenistransaksi);
                if (!empty($cekhutang)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " sudah di buatkan pengeluaran uang"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } elseif ($jenistransaksi == "32") {
                //Part                
                $ceksj = $this->permohonanpengeluarankasir_model->getdatabatalpart($value['invoice'], $jenistransaksi);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " sudah Batal penerimaan"
                    );
                    $errorvalidasi = true;
                    echo json_encode($resultjson);
                    return FALSE;
                }
                $cekhutang = $this->permohonanpengeluarankasir_model->cekpengeluaran($nomor);
                if (!empty($cekhutang)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $nomor . " sudah dibuatkan pengeluaran uang"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } elseif ($jenistransaksi == "33") {
                //Part                
                $ceksj = $this->permohonanpengeluarankasir_model->getdatapenerimaanpart($value['invoice'], $jenistransaksi);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " sudah dibuatkan penerimaan parts"
                    );
                    $errorvalidasi = true;
                    echo json_encode($resultjson);
                    return FALSE;
                }
                $cekhutang = $this->permohonanpengeluarankasir_model->cekpengeluaran($nomor);
                if (!empty($cekhutang)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $nomor . " sudah dibuatkan pengeluaran uang"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } elseif ($jenistransaksi == "99") {
                $cekpengluaran = $this->permohonanpengeluarankasir_model->getpengeluaran($nomor);
                if (!empty($cekpengluaran)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $nomor . " sudah dibuatkan pengeluaran uang"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            }
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $i = 1;
            foreach ($datadetail as $key => $value) {
                $nilaicadangan = str_replace(",", "", $value['nilaipembayaran']) + str_replace(",", "", $value['nilaialokasi']);
                switch ($jenistransaksi) {
                    case "31":
                        //OPL
                        $this->permohonanpengeluarankasir_model->updatepembayaranhutang($nilaicadangan, $value['invoice'], $jenistransaksi, TRUE);
                        break;
                    case "32":
                        //Part
                        $this->permohonanpengeluarankasir_model->updatepembayaranhutang($nilaicadangan, $value['invoice'], $jenistransaksi, TRUE);
                        break;
                    case "34":
                        // Memo kelebihan UM Service
                        $this->permohonanpengeluarankasir_model->updatepiutang($nilaicadangan, $value['invoice'], TRUE);
                        break;
                    case "35":
                        // Memo kelebihan UM Counter
                        $this->permohonanpengeluarankasir_model->updatepiutang($nilaicadangan, $value['invoice'], TRUE);
                        break;
                }
                $i++;
            }
            $dataheader = array(
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin,
                'keteranganbatal' => $alasan,
                'batal' => true,
            );
            $this->permohonanpengeluarankasir_model->canceltrx($dataheader, $nomor);
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
        $data = $this->permohonanpengeluarankasir_model->getdatafind($this->input->post('nomor'));
        echo json_encode($data);
    }

    function finddata()
    {
        $data = $this->permohonanpengeluarankasir_model->getfinddata($this->input->post('nomor'));
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
        $nomorkasiraccount = $this->input->post('nomorkasiraccount');
        $kodedepartemen = $this->input->post('kodedepartemen');

        $userlogin = $this->session->userdata('myusername');
        //$userlogin = 'FBS';
        $kodeprefix = "";

        $getaccountkasir = $this->permohonanpengeluarankasir_model->accountpenerima($nomorkasiraccount);
        // print_r($getaccountkasir);
        foreach ($getaccountkasir as $value) {
            $kodeprefix = $value->kodeprefix;
            $jenisaccount = $value->jenisaccount;
        };
        foreach ($datadetail as $key => $value) {
            if ($jenistransaksi == "31") {
                //OPL             
                $ceksj = $this->permohonanpengeluarankasir_model->getdatabatalopl($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal disimpan, Nomor " . $value['invoice'] . " Sudah Batal"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            } elseif ($jenistransaksi == "32") {
                //Ongkos parts                  
                $ceksj = $this->permohonanpengeluarankasir_model->getdatabatalpart($value['invoice']);
                if (!empty($ceksj)) {
                    $resultjson = array(
                        'error' => true,
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
            $ambilnomor = $kodecabang . "-P" . $kodeprefix . substr(date("Y"), 2, 2) . date("m");
            $get["nomor"] = $this->permohonanpengeluarankasir_model->getMaxNomor($ambilnomor);
            if (!$get["nomor"]->nomor) {
                $nomor = $ambilnomor . "00001";
            } else {
                $lastNomor = $get['nomor']->nomor;
                $lastNoUrut = substr($lastNomor, 11, 12);

                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
            }

            $i = 1;
            foreach ($datadetail as $key => $value) {
                $nilaicadangan = str_replace(",", "", $value['nilaipembayaran']) + str_replace(",", "", $value['nilaialokasi']);

                switch ($jenistransaksi) {
                    case "31":
                        //OPL
                        $this->permohonanpengeluarankasir_model->updatepembayaranhutang($nilaicadangan, $value['invoice'], $jenistransaksi, FALSE);
                        break;
                    case "32":
                        //Part
                        $this->permohonanpengeluarankasir_model->updatepembayaranhutang($nilaicadangan, $value['invoice'], $jenistransaksi, FALSE);
                        break;
                    case "34":
                        // Memo kelebihan UM Service
                        $this->permohonanpengeluarankasir_model->updatepiutang($nilaicadangan, $value['invoice'], FALSE);
                        break;
                    case "35":
                        // Memo kelebihan UM Counter
                        $this->permohonanpengeluarankasir_model->updatepiutang($nilaicadangan, $value['invoice'], FALSE);
                        break;
                }

                $data = array(
                    'nomorcadangan' => $nomor,
                    'noreferensi' => $value['invoice'],
                    'kodesupplier' => $value['kode'],
                    'namasupplier' => $value['nama'],
                    'nourut' => $i,
                    'nilaipermohonan' => str_replace(",", "", $value['nilaipembayaran']),
                    'kodeaccount' => $value['account'],
                    'nilaialokasi' => str_replace(",", "", $value['nilaialokasi']),
                    'accountalokasi' => $value['accalokasi'],
                    'memo' => $value['memo']
                );
                $this->permohonanpengeluarankasir_model->savedetail($data);
                $i++;
            }
            $dataheader = array(
                'nomor' => $nomor,
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
                // 'approve' => '0',
            );
            $this->permohonanpengeluarankasir_model->saveheader($dataheader);
            // die();
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
                        $sub_array[] = '<button class="btn btn-primary searchkodetransaksi" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
