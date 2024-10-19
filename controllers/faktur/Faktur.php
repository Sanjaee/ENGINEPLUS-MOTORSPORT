<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Faktur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('faktur/faktur_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }


    public function CekDisc()
    {
        $result =  $this->faktur_model->CekDisc($this->input->post('mgrup'), $this->input->post('modul'), $this->input->post('persen'));
        if (!empty($result)) {
            $resultjson = array(
                'error' => false,
                'message' => "Validasi ok"
            );
        } else {
            $resultjson = array(
                'error' => true,
                'message' => "Discount Melebihi Kapasitas"
            );
        }
        echo json_encode($resultjson);
    }



    public function GetDataSPK()
    {
        $result =  $this->faktur_model->GetSPK($this->input->post('nomorspk'));
        echo json_encode($result);
    }
    public function GetDataTipe()
    {
        $result =  $this->faktur_model->GetTipe($this->input->post('kode_tipe'));
        echo json_encode($result);
    }
    public function GetDataProduct()
    {
        $result =  $this->faktur_model->GetProduct($this->input->post('kode'));
        echo json_encode($result);
    }
    public function GetDataCustomer()
    {
        $result =  $this->faktur_model->GetCustomer($this->input->post('nocustomer'));
        echo json_encode($result);
    }

    function GetDetail()
    {
        $data = $this->faktur_model->GetDetail($this->input->post('nomor'));
        echo json_encode($data);
    }
    function FindFaktur()
    {
        $data = $this->faktur_model->GetDataFind($this->input->post('nomor'));
        echo json_encode($data);
    }
    function FindFakturDetail()
    {
        $data = $this->faktur_model->GetDataFakturDetail($this->input->post('nomor'));
        echo json_encode($data);
    }
    public function GetDataTask()
    {
        $result =  $this->faktur_model->GetTask($this->input->post('kode'), $this->input->post('model'));
        echo json_encode($result);
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
                        $sub_array[] = '<button class="btn btn-success searchspk" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
                        $sub_array[] = '<button class="btn btn-success searchparts" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
    function CariDataFaktur()
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

    function Save()
    {
        $userlogin = $this->session->userdata('myusername');
        $kodecabang = $this->input->post('kodecabang');
        $uangmuka = str_replace(",", "", $this->input->post('uangmuka'));
        $errorvalidasi = FALSE;

        $cekwo = $this->faktur_model->checkwo($this->input->post('nomorspk'));
        if (!empty($cekwo)) {
            $resultjson = array(
                'nomor' => "",
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $this->input->post('nomorspk') . " Sudah di Invoice "
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(TRUE);

            $ambilnomor = "SV-" . $kodecabang . "-" . substr(date("Y"), 2, 2) . date("m");
            $get["SPK"] = $this->faktur_model->GetMaxNomor($ambilnomor);
            if (!$get["SPK"]->nomor) {
                $nomor = $ambilnomor . "00001";
            } else {
                $lastNomor = $get['SPK']->nomor;
                $lastNoUrut = substr($lastNomor, 11, 16);

                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
            }

            //simpan alokasi uang muka
            if ($uangmuka != '0') {
                $ambilnomoral = $kodecabang . "-AL" . substr(date("Y"), 2, 2) . date("m");
                $get["noalokasi"] = $this->faktur_model->getMaxNomorAlokasi($ambilnomoral);
                if (!$get["noalokasi"]->nomor) {
                    $nomoralokasi = $ambilnomoral . "00001";
                } else {
                    $lastNomor = $get['noalokasi']->nomor;
                    $lastNoUrut = substr($lastNomor, 10, 12);

                    // nomor urut ditambah 1
                    $nextNoUrut = $lastNoUrut + 1;
                    $nomoralokasi = $ambilnomoral . sprintf('%05s', $nextNoUrut);
                }

                $dataalokasi = array(
                    'nomor' => $nomoralokasi,
                    'jenistransaksi' => 51,
                    'tanggal' => date("Y-m-d H:i:s"),
                    'noreferensi' => $this->input->post('nomorspk'),
                    'nomorpenjualan' => $nomor,
                    'nomorcustomer' => $this->input->post('nomor_customer'),
                    'nilaialokasi' =>  $uangmuka,
                    'kodecabang' => $kodecabang,
                    'kodesubcabang' => $this->input->post('kodesubcabang'),
                    'kodecompany' => $this->input->post('kodecompany'),
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin
                );
                $this->faktur_model->savealokasi($dataalokasi);
            }

            if (!empty($this->input->post('detailpart'))) {
                foreach ($this->input->post('detailpart') as $key => $value) {
                    $get["cogs"] = $this->faktur_model->GetCogs($value['Kode'],$kodecabang, $this->input->post('kodecompany'));
                    $cogs = $get['cogs']->cogs;
                    $data = array(
                        'nomorfaktur' => $nomor,
                        'jenis' => 1,
                        'kodereferensi' => $value['Kode'],
                        'namareferensi' => $value['Nama'],
                        'kategoridetail' => $value['Kategori'],
                        'qty' => str_replace(",", "", $value['Qty']),
                        'harga' => str_replace(",", "", $value['Harga']),
                        'persendiscperitem' => str_replace(",", "", $value['Persendisc']),
                        'discperitem' => str_replace(",", "", $value['Discount']),
                        'subtotal' => round(str_replace(",", "", $value['Subtotal'])),
                        'cogs' => round(str_replace(",", "", $cogs)),
                    );
                    $this->faktur_model->SaveDetail($data);
                }
            }

            if (!empty($this->input->post('detailjasa'))) {
                foreach ($this->input->post('detailjasa') as $key => $value) {
                    $data = array(
                        'nomorfaktur' => $nomor,
                        'jenis' => 2,
                        'kodereferensi' => $value['Kode'],
                        'namareferensi' => $value['Nama'],
                        'kategoridetail' => $value['Kategori'],
                        'qty' => str_replace(",", "", $value['Qty']),
                        'harga' => str_replace(",", "", $value['Harga']),
                        'persendiscperitem' => str_replace(",", "", $value['Persendisc']),
                        'discperitem' => str_replace(",", "", $value['Discount']),
                        'subtotal' => round(str_replace(",", "", $value['Subtotal'])),
                    );
                    $this->faktur_model->SaveDetail($data);
                }
            }

            if (!empty($this->input->post('detailopl'))) {
                foreach ($this->input->post('detailopl') as $key => $value) {
                    $data = array(
                        'nomorfaktur' => $nomor,
                        'jenis' => 3,
                        'kodereferensi' => $value['Kode'],
                        'namareferensi' => $value['Nama'],
                        'kategoridetail' => $value['Kategori'],
                        'qty' => str_replace(",", "", $value['Qty']),
                        'harga' => str_replace(",", "", $value['Harga']),
                        'persendiscperitem' => str_replace(",", "", $value['Persendisc']),
                        'discperitem' => str_replace(",", "", $value['Discount']),
                        'subtotal' => round(str_replace(",", "", $value['Subtotal'])),
                    );
                    $this->faktur_model->SaveDetail($data);
                }
            }

            $data = array(
                'nomor' => $nomor,
                'nopolisi' => $this->input->post('nopolisi'),
                'nomor_spk' => $this->input->post('nomorspk'),
                'nomor_customer' => $this->input->post('nomor_customer'),
                'tanggal' => date("Y-m-d H:i:s"),
                'keterangan' => $this->input->post('keterangan'),
                'dpp' => str_replace(",", "", $this->input->post('dpp')),
                'ppn' => str_replace(",", "", $this->input->post('ppn')),
                'grandtotal' => str_replace(",", "", $this->input->post('grandtotal')),
                'kode_teknisi' => $this->input->post('kode_teknisi'),
                'kodesubcabang' => $this->input->post('kodesubcabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'kode_cabang' => $this->input->post('kodecabang'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->faktur_model->SaveHeader($data);

            $data = array(
                'noreferensi' => $nomor,
                'jenistransaksi' => '51',
                'tgltransaksi' => date("Y-m-d H:i:s"),
                'tgljttempo' => $this->input->post('tgljttempo'),
                'nomor_customer' => $this->input->post('nomor_customer'),
                'nilaipiutang' => str_replace(",", "", $this->input->post('grandtotal')),
                'nilaipenerimaan' => 0,
                'nilaiuangmuka' => str_replace(",", "", $this->input->post('uangmuka')),
                'kode_cabang' => $this->input->post('kodecabang'),
                'kodesubcabang' => $this->input->post('kodesubcabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->faktur_model->SavePiutang($data);

            $data = array(
                'status' => 2
            );
            $this->faktur_model->UpdateStatusFaktur($data, $this->input->post('nomorspk'));


            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'nomor' => "",
                    'message' => "Data Invoice gagal disimpan!"
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
    }

    function Cancel()
    {
        $errorvalidasi = FALSE;
        $nomorspk = $this->input->post('nomorspk');
        $nomor = $this->input->post('nomor');
        $userlogin = $this->session->userdata('myusername');
        //klo udah serah terima tidak bisa di batalin faktur nya
        $cekstu = $this->faktur_model->checkserahterima($nomor);
        if (!empty($cekstu)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dicancel, Nomor " . $nomor . " Sudah Dibuatkan Serah Terima Unit"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        //klo sudah dibayar tidak bisa cancel faktur
        $cekbayar = $this->faktur_model->checkbayar($nomor);
        if (!empty($cekbayar)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomor . " Pelunasan Invoice"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        if ($errorvalidasi == FALSE) {
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->faktur_model->CancelFaktur($data, $this->input->post('nomor'));

            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->faktur_model->CancelPiutang($data, $this->input->post('nomor'));

            $data = array(
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->faktur_model->cancelalokasi($data, $this->input->post('nomor'), $this->input->post('nomorspk'));

            $data = array(
                'status' => 1
            );
            $this->faktur_model->UpdateStatusFaktur($data, $this->input->post('nomorspk'));

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

    function CariDataCustomer()
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
                        $sub_array[] = '<button class="btn btn-success searchcustomer" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
