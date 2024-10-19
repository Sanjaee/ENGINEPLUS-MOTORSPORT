<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Entry_spk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('spk/entry_spk_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }


    public function GetDataSN()
    {
        $result =  $this->entry_spk_model->GetSN($this->input->post('nomorsn'));
        echo json_encode($result);
    }
    public function getdatamobil()
    {
        $result =  $this->entry_spk_model->getdatamobil($this->input->post('nopol'));
        echo json_encode($result);
    }
    public function GetDataTipe()
    {
        $result =  $this->entry_spk_model->GetTipe($this->input->post('kode_tipe'));
        echo json_encode($result);
    }
    public function GetDataCustomer()
    {
        $result =  $this->entry_spk_model->GetCustomer($this->input->post('nocustomer'));
        echo json_encode($result);
    }
    public function GetDataTeknisi()
    {
        $result =  $this->entry_spk_model->GetTeknisi($this->input->post('kode'));
        echo json_encode($result);
    }
    public function GetDataForeman()
    {
        $result =  $this->entry_spk_model->GetForeman($this->input->post('kode'));
        echo json_encode($result);
    }
    public function GetDataParts()
    {
        $result =  $this->entry_spk_model->GetParts($this->input->post('kode'), $this->input->post('kode_cabang'), $this->input->post('kodecompany'));
        echo json_encode($result);
    }
    public function GetDataTask()
    {
        $result =  $this->entry_spk_model->GetTask($this->input->post('kode'), $this->input->post('model'));
        echo json_encode($result);
    }
    public function GetDataOPL()
    {
        $result =  $this->entry_spk_model->GetOPL($this->input->post('kode'));
        echo json_encode($result);
    }
    function find()
    {
        $data = $this->entry_spk_model->GetDataFind($this->input->post('nomor'));
        echo json_encode($data);
    }
    function FindDetail()
    {
        $data = $this->entry_spk_model->GetDataFindDetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    function GetDataBooking()
    {
        $data = $this->entry_spk_model->GetDataBooking($this->input->post('nomor'));
        echo json_encode($data);
    }
    function BookDetail()
    {
        $data = $this->entry_spk_model->BookDetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    public function Getregularcheck()
    {
        $result =  $this->entry_spk_model->Getregularcheck($this->input->post('kode'));
        echo json_encode($result);
    }

    public function GetDataRegularDetail()
    {
        $result =  $this->entry_spk_model->GetDataRegularDetail($this->input->post('kode'), $this->input->post('kodemodel'));
        echo json_encode($result);
    }

    function GetDataEstimasi()
    {
        $data = $this->entry_spk_model->GetDataEstimasi($this->input->post('nomor'));
        echo json_encode($data);
    }
    function EstimasiDetail()
    {
        $data = $this->entry_spk_model->EstimasiDetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    function CariDataTeknisi()
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
                        $sub_array[] = '<button class="btn btn-success searchteknisi" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataTeknisi2()
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
                        $sub_array[] = '<button class="btn btn-success searchteknisi2" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataTeknisi3()
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
                        $sub_array[] = '<button class="btn btn-success searchteknisi3" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataTeknisi4()
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
                        $sub_array[] = '<button class="btn btn-success searchteknisi4" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataForeman()
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
                        $sub_array[] = '<button class="btn btn-success searchforeman" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
    function CariDataTask()
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
                        $sub_array[] = '<button class="btn btn-success searchtask" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
    function CariDataFind()
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

    function Cariregularcheck()
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
                        $sub_array[] = '<button class="btn btn-success searchrc" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
        $kodecabang = $this->input->post('kodecabang');
        $userlogin = $this->session->userdata('myusername');
        $booking = $this->input->post('booking');
        $estimasi = $this->input->post('noestimasi');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        // $cekWO['nopolisi'] = $this->entry_spk_model->cekWO($this->input->post('nopolisi'));
        // foreach ($cekWO['nopolisi'] as $cek) {
        //     if (($cek->nopolisi >= 2)) {
        //         if (($cek->approve == '0')) {
        //             $resultjson = array(
        //                 'nomor' => "",
        //                 'error' => true,
        //                 'message' => "Data gagal disimpan, WO dengan No polisi " . $this->input->post('nopolisi') . " belum di approve"
        //             );
        //             echo json_encode($resultjson);
        //             return FALSE;
        //         }
        //     }
        // }


        $ambilnomor = "WO-" . $kodecabang . "-" . substr(date("Y"), 2, 2) . date("m");
        $get["nomor"] = $this->entry_spk_model->getMaxNomor($ambilnomor);

        if (!$get["nomor"]->nomor) {
            $nomor = $ambilnomor . "00001";
        } else {
            $lastNomor = $get['nomor']->nomor;

            $lastNoUrut = substr($lastNomor, 11, 16);

            // nomor urut ditambah 1
            $nextNoUrut = $lastNoUrut + 1;
            $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
        }

        if (!empty($this->input->post('detailpart'))) {
            foreach ($this->input->post('detailpart') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'nomorwo' => $nomor,
                    'jenis' => 1,
                    'kodereferensi' => $value['Kode'],
                    'namareferensi' => $value['Nama'],
                    'kategori' => $value['Kategori'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                    'statuspekerjaan' => 0
                );
                $this->entry_spk_model->SaveDetail($data);
            }
        }
        if (!empty($this->input->post('detailjasa'))) {
            foreach ($this->input->post('detailjasa') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'nomorwo' => $nomor,
                    'jenis' => 2,
                    'kodereferensi' => $value['Kode'],
                    'namareferensi' => $value['Nama'],
                    'kategori' => $value['Kategori'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                    'statuspekerjaan' => 0,
                );
                $this->entry_spk_model->SaveDetail($data);
            }
        }

        if (!empty($this->input->post('detailopl'))) {
            foreach ($this->input->post('detailopl') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'nomorwo' => $nomor,
                    'jenis' => 3,
                    'kodereferensi' => $value['Kode'],
                    'namareferensi' => $value['Nama'],
                    'kategori' => $value['Kategori'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                    'statuspekerjaan' => 0
                );
                $this->entry_spk_model->SaveDetail($data);
            }
        }

        $data = array(
            'nomor' => $nomor,
            'nopolisi' => $this->input->post('nopolisi'),
            'norangka' => $this->input->post('norangka'),
            'nomor_customer' => $this->input->post('nomor_customer'),
            'tipe' => $this->input->post('tipe'),
            'returnjob' => $this->input->post('returnjob'),
            'jenisservice' => $this->input->post('jenisservice'),
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan' => $this->input->post('keterangan'),
            'pic' => $this->input->post('pic'),
            'nohppic' => $this->input->post('nohppic'),
            'dpp' => str_replace(",", "", $this->input->post('dpp')),
            'ppn' => str_replace(",", "", $this->input->post('ppn')),
            'grandtotal' => str_replace(",", "", $this->input->post('grandtotal')),
            'kode_teknisi' => $this->input->post('kode_teknisi'),
            'nama_teknisi' => $this->input->post('nama_teknisi'),
            'kode_foreman' => $this->input->post('kode_foreman'),
            'nama_foreman' => $this->input->post('nama_foreman'),
            'keluhan' => $this->input->post('keluhan'),
            'totalpart' => str_replace(",", "", $this->input->post('totalpart')),
            'totaljasa' => str_replace(",", "", $this->input->post('totaljasa')),
            'inventaris' => $this->input->post('inventaris'),
            'kode_cabang' => $this->input->post('kodecabang'),
            'odemeter' => $this->input->post('odemeter'),
            'nomorbooking' => $this->input->post('nomorbooking'),
            'booking' => $this->input->post('booking'),
            'kode_regularcheck' => $this->input->post('koderegular'),
            'nama_regularcheck' => $this->input->post('namaregular'),
            'garansi' => $this->input->post('warranty'),
            'nomorestimasi' => $this->input->post('noestimasi'),
            'kodesubcabang' => $this->input->post('kodesubcabang'),
            'kodecompany' => $this->input->post('kodecompany'),
            'tglestimasi' => $this->input->post('tglestimasi'),
            'statustunggu' => $this->input->post('statustunggu'),
            'tanggalmasuk' => $this->input->post('tanggalmasuk'),
            'tanggalkerja' => $this->input->post('tanggalkerja'),
            'projectmanager' => $this->input->post('projectmanager'),
            'kode_teknisi2' => $this->input->post('kode_teknisi2'),
            'kode_teknisi3' => $this->input->post('kode_teknisi3'),
            'kode_teknisi4' => $this->input->post('kode_teknisi4'),
            'statuskendaraan' => $this->input->post('statuskendaraan'),
            'statuspekerjaanmobil' => $this->input->post('stkendaraan'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->entry_spk_model->SaveHeader($data);

        // print_r($booking);
        // die();
        if ($booking == TRUE) {
            $this->entry_spk_model->UpdateBooking($this->input->post('nomorbooking'), false);
        }

        if (!empty($estimasi) || $estimasi == "") {
            $this->entry_spk_model->UpdateEstimasi($this->input->post('noestimasi'), false);
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
    }

    public function Update()
    {
        $nomorwo = $this->input->post('nomor');
        $this->entry_spk_model->DeleteDetail($this->input->post('nomor'));
        if (!empty($this->input->post('detailpart'))) {
            foreach ($this->input->post('detailpart') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'nomorwo' => $nomorwo,
                    'jenis' => 1,
                    'kodereferensi' => $value['Kode'],
                    'namareferensi' => $value['Nama'],
                    'kategori' => $value['Kategori'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                    'statuspekerjaan' => 0
                );
                $this->entry_spk_model->SaveDetail($data);
            }
        }
        if (!empty($this->input->post('detailjasa'))) {
            foreach ($this->input->post('detailjasa') as $key => $value) {

                // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'nomorwo' => $nomorwo,
                    'jenis' => 2,
                    'kodereferensi' => $value['Kode'],
                    'namareferensi' => $value['Nama'],
                    'kategori' => $value['Kategori'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                    'statuspekerjaan' => $value['Kodestatus'],
                );
                $this->entry_spk_model->SaveDetail($data);
            }
        }
        if (!empty($this->input->post('detailopl'))) {
            foreach ($this->input->post('detailopl') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'nomorwo' => $nomorwo,
                    'jenis' => 3,
                    'kodereferensi' => $value['Kode'],
                    'namareferensi' => $value['Nama'],
                    'kategori' => $value['Kategori'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                    'statuspekerjaan' => 0
                );
                $this->entry_spk_model->SaveDetail($data);
            }
        }

        $data = array(
            'returnjob' => $this->input->post('returnjob'),
            'keterangan' => $this->input->post('keterangan'),
            'keluhan' => $this->input->post('keluhan'),
            'dpp' => str_replace(",", "", $this->input->post('dpp')),
            'ppn' => str_replace(",", "", $this->input->post('ppn')),
            'grandtotal' => str_replace(",", "", $this->input->post('grandtotal')),
            'totalpart' => str_replace(",", "", $this->input->post('totalpart')),
            'totaljasa' => str_replace(",", "", $this->input->post('totaljasa')),
            'inventaris' => $this->input->post('inventaris'),
            'kode_teknisi' => $this->input->post('kode_teknisi'),
            'nama_teknisi' => $this->input->post('nama_teknisi'),
            'kode_foreman' => $this->input->post('kode_foreman'),
            'nama_foreman' => $this->input->post('nama_foreman'),
            'kode_regularcheck' => $this->input->post('koderegular'),
            'nama_regularcheck' => $this->input->post('namaregular'),
            'tglestimasi' => $this->input->post('tglestimasi'),
            'statustunggu' => $this->input->post('statustunggu'),
            'tanggalmasuk' => $this->input->post('tanggalmasuk'),
            'tanggalkerja' => $this->input->post('tanggalkerja'),
            'projectmanager' => $this->input->post('projectmanager'),
            'kode_teknisi2' => $this->input->post('kode_teknisi2'),
            'kode_teknisi3' => $this->input->post('kode_teknisi3'),
            'kode_teknisi4' => $this->input->post('kode_teknisi4'),
            'statuskendaraan' => $this->input->post('statuskendaraan'),
            'statuspekerjaanmobil' => $this->input->post('stkendaraan'),
            'garansi' => $this->input->post('warranty')
        );
        $result =  $this->entry_spk_model->UpdateHeader($data, $this->input->post('nomor'));

        if ($result == 1) {
            $resultjson = array(
                'error' => false,
                'message' => "Data berhasil diubah"
            );
        } else {
            $resultjson = array(
                'error' => false,
                'message' => "Data berhasil gagal diubah"
            );
        }
        echo json_encode($resultjson);
    }

    function Cancel()
    {
        $errorvalidasi = FALSE;
        $nomorspk = $this->input->post('nomor');
        $userlogin = $this->session->userdata('myusername');
        $booking = $this->input->post('booking');
        $estimasi = $this->input->post('noestimasi');

        $cekwo = $this->entry_spk_model->checkmemopembatalan($nomorspk);
        if (empty($cekwo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomorspk . " Belum melakukan Memo Pembatalan"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekpembebanan = $this->entry_spk_model->CekPembebanan($nomorspk);
        if (!empty($cekpembebanan)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomorspk . " Masih ada pembebanan Spareparts"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $checkdp = $this->entry_spk_model->CekDp($nomorspk);
        if (!empty($checkdp)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomorspk . " Penerimaan DP Belum dibatalkan"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekstatus = $this->entry_spk_model->checkstatuswo($nomorspk);
        if (!empty($cekstatus)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Sudah Close atau Faktur"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekopl = $this->entry_spk_model->checkopl($nomorspk);
        if (!empty($cekopl)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Sudah Dibuat OPL"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->entry_spk_model->CancelTransaksi($data, $this->input->post('nomor'));

            if ($booking = true) {
                $this->entry_spk_model->UpdateBooking($this->input->post('nomorbooking'), true);
            }

            if (!empty($estimasi) || $estimasi == "") {
                $this->entry_spk_model->UpdateEstimasi($this->input->post('noestimasi'), true);
            }

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

    function historyspk()
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

    function CariDataOPL()
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
                        $sub_array[] = '<button class="btn btn-success searchopl" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataBooking()
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
                        $sub_array[] = '<button class="btn btn-success searchbk" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataEstimasi()
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
                        $sub_array[] = '<button class="btn btn-success searchest" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
