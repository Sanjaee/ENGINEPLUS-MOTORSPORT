<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembebanan_sparepart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/pembebanan_sparepart_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function GetDataSPK()
    {
        $result =  $this->pembebanan_sparepart_model->GetSPK($this->input->post('nomorspk'));
        echo json_encode($result);
    }

    function GetSPKDetail()
    {
        $data = $this->pembebanan_sparepart_model->GetDataSPKDetail($this->input->post('nomor'));
        echo json_encode($data);
    }


    public function getdatasparepart()
    {
        $result =  $this->pembebanan_sparepart_model->getdatasparepart($this->input->post('kode'));
        echo json_encode($result);
    }

    public function GetDataTipe()
    {
        $result =  $this->pembebanan_sparepart_model->GetTipe($this->input->post('kode_tipe'));
        echo json_encode($result);
    }
    public function GetDataProduct()
    {
        $result =  $this->pembebanan_sparepart_model->GetProduct($this->input->post('kode'));
        echo json_encode($result);
    }
    public function GetDataCustomer()
    {
        $result =  $this->pembebanan_sparepart_model->GetCustomer($this->input->post('nocustomer'));
        echo json_encode($result);
    }

    public function GetRefBatal()
    {
        $result =  $this->pembebanan_sparepart_model->GetRefBatal($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function GetDataParts()
    {
        $result =  $this->pembebanan_sparepart_model->GetParts($this->input->post('kode'), $this->input->post('kode_cabang'), $this->input->post('kodecompany'));
        echo json_encode($result);
    }

    public function GetDataStock()
    {
        $periode = date("Y") . date("m");
        $result =  $this->pembebanan_sparepart_model->GetStock($this->input->post('kode'), $this->input->post('kodecabang'), $this->input->post('kodesubcabang'), $this->input->post('kodecompany'), $periode);
        echo json_encode($result);
    }

    function FindPembebanan()
    {
        $data = $this->pembebanan_sparepart_model->GetDataFind($this->input->post('nomor'));
        echo json_encode($data);
    }
    function FindPembebananDetail()
    {
        $data = $this->pembebanan_sparepart_model->GetDataPembebananDetail($this->input->post('nomor'));
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
                        $sub_array[] = '<button class="btn btn-success searchspk" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataPembebanan()
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
                        $sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataRefbatal()
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
                        $sub_array[] = '<button class="btn btn-success searchokref" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataParts()
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
                        $sub_array[] = '<button class="btn btn-success searchparts" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

        $errorvalidasi = FALSE;
        $periode = date("Y") . date("m");
        $kodecabang = $this->input->post('kodecabang');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $userlogin = $this->session->userdata('myusername');

        $cekstatusso = $this->pembebanan_sparepart_model->checkstatuswo($this->input->post('nomorspk'));
        if (!empty($cekstatusso)) {
            $resultjson = array(
                'nomor' => "",
                'error' => true,
                'message' => "Nomor SO " . $this->input->post('nomorspk') . "  Sudah Close / Invoice"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekwox = $this->pembebanan_sparepart_model->checkstatuswox($this->input->post('nomorspk'));
        if (!empty($cekwox)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $this->input->post('nomorspk') . " Sudah Batal"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        foreach ($this->input->post('detail') as $key => $value) {
            $cek = $this->pembebanan_sparepart_model->checkstock($value['Kode'], $periode, $value['Qty'], $kodecabang, $kodesubcabang, $kodecompany);
            //   print_r($value);
            //   die();
            if (empty($cek)) {
                $resultjson = array(
                    'nomor' => "",
                    'error' => true,
                    'message' => "Data Stock " . $value['Kode'] . "  tidak mencukupi"
                );
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
            };
        }
        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $ambilnomor = "PS" . substr(date("Y"), 2, 2) . date("m");
            $get["PS"] = $this->pembebanan_sparepart_model->GetMaxNomor($ambilnomor);
            if (!$get["PS"]->nomor) {
                $nomor = $ambilnomor . "00001";
            } else {
                $lastNomor = $get['PS']->nomor;
                $lastNoUrut = substr($lastNomor, 6, 11);

                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
            }

            $data = array(
                'nomor' => $nomor,
                'nomorwo' => $this->input->post('nomorspk'),
                'tanggal' => date("Y-m-d H:i:s"),
                'kode_cabang' => $this->input->post('kodecabang'),
                'kodesubcabang' => $this->input->post('kodesubcabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->pembebanan_sparepart_model->SaveHeader($data);

            foreach ($this->input->post('detail') as $key => $value) {

                $data = array(
                    'nomorpembebanan' => $nomor,
                    'kodepart' => $value['Kode'],
                    'namapart' => $value['Nama'],
                    'kategori' => $value['Kategori'],
                    'kategoridetail' => $value['KategoriDetail'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'hargasatuan' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                );

                $this->pembebanan_sparepart_model->SaveDetail($data);

                $this->pembebanan_sparepart_model->updatestock($value['Kode'], $value['Qty'], $periode, $kodecabang, $kodesubcabang, $kodecompany, TRUE);
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

    function Cancel()
    {
        //harus check jika sudah close wo/faktur/serahterima unit tidak bisa dibatalin
        $errorvalidasi = FALSE;
        $datadetail = $this->input->post('detail');
        $nomorspk = $this->input->post('nomorspk');
        $periode = date("Y") . date("m");
        $kodecabang = $this->input->post('kodecabang');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $userlogin = $this->session->userdata('myusername');

        $cekwo = $this->pembebanan_sparepart_model->checkstatuswo($nomorspk);
        if (!empty($cekwo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Close SPK"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekwox = $this->pembebanan_sparepart_model->checkstatuswox($nomorspk);
        if (!empty($cekwox)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Sudah Batal"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        // foreach ($datadetail as $key => $value) {
        //     //-----------check jika stock kurang maka batal tidak bisa
        //     $cek = $this->pembebanan_sparepart_model->checkstock($value['Kode'], $periode, $value['Qty'], $kodecabang, $kodesubcabang, $kodecompany);
        //     // print_r($cek);
        //     // die();
        //     if (empty($cek)) {
        //         $resultjson = array(
        //             'nomor' => "",
        //             'error' => true,
        //             'message' => "Data Stock " . $value['Kode'] . "  tidak mencukupi");
        //             $errorvalidasi = TRUE;
        //             echo json_encode($resultjson);
        //             return FALSE;
        //     };
        // }
        //--------------End Here
        if ($errorvalidasi == FALSE) {

            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->pembebanan_sparepart_model->CancelPembebanan($data, $this->input->post('nomor'));

            //----update stock batal--------
            foreach ($datadetail as $key => $value) {
                $ceksp = $this->pembebanan_sparepart_model->checkdatastock($value['Kode'], $periode, $kodecabang, $kodecompany, $kodesubcabang);

                if (!empty($ceksp)) {
                    $this->pembebanan_sparepart_model->updatestock($value['Kode'], $value['Qty'], $periode, $kodecabang, $kodesubcabang, $kodecompany, FALSE);
                } else {
                    $stock = array(
                        'periode' => $periode,
                        'kodepart' => $value['Kode'],
                        'qtymasuk' => $value['Qty'],
                        'kode_cabang' => $kodecabang,
                        'kodesubcabang' => $kodesubcabang,
                        'kodecompany' => $kodecompany,
                    );
                    $this->pembebanan_sparepart_model->insertstock($stock);
                }
            };
            //----end here

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


    function HistoryPembebanan()
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
                        //$sub_array[] = '<button class="btn btn-success searchok" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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
