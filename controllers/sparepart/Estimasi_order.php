<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Estimasi_order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/estimasi_order_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function getdatasparepart()
    {
        $result =  $this->estimasi_order_model->getdatasparepart($this->input->post('kode'), $this->input->post('kode_cabang'), $this->input->post('kodecompany'));
        echo json_encode($result);
    }


    function save()
    {
        // print_r($this->input->post('detail'));         
        // die();
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $userlogin = $this->session->userdata('myusername');
        $kodecabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');
        $kodegrup = $this->session->userdata('mygrupcabang');

        $ambilnomor = "EO" . substr(date("Y"), 2, 2) . date("m");
        $get["booking"] = $this->estimasi_order_model->getMaxNomor($ambilnomor);
        if (!$get["booking"]->nomor) {
            $nomor = $ambilnomor . "00001";
        } else {
            $lastNomor = $get['booking']->nomor;
            $lastNoUrut = substr($lastNomor, 6, 11);

            // nomor urut ditambah 1
            $nextNoUrut = $lastNoUrut + 1;
            $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
        }

        foreach ($this->input->post('datadetail') as $key => $value) {
            // foreach ($val_dt_detail as $key => $value) {
            $data = array(
                'noestimasiorder' => $nomor,
                'kodepart' => $value['kode'],
                'namapart' => $value['nama'],
                'qty' => str_replace(",", "", $value['qty']),
                'hargausd' => str_replace(",", "", $value['hargausd']),
                'hargabeli' => str_replace(",", "", $value['hargabeli']),
                'hargajual' => str_replace(",", "", $value['hargajual']),
                'hargasatuan' => str_replace(",", "", $value['hargasatuan']),
                'hargatotal' => str_replace(",", "", $value['hargatotal']),
                'beratsatuan' => str_replace(",", "", $value['beratsatuan']),
                'biayaberat' => str_replace(",", "", $value['biayaberatsatuan']),
                'shippingsatuan' => str_replace(",", "", $value['shipsatuan']),
                'hargamodal' => str_replace(",", "", $value['hargamodal']),
                'marginjual' => str_replace(",", "", $value['marginjual']),
                'harganormal' => str_replace(",", "", $value['harganormal']),
                'sparemargin' => str_replace(",", "", $value['sparemargin']),
                'hargajualest' => str_replace(",", "", $value['hargajualest']),
            );
            $this->estimasi_order_model->savedetail($data);
        }

        foreach ($this->input->post('datadetail') as $key => $value) {
            $cek = $this->estimasi_order_model->checkmaster($value['kode'], $kodecabang, $kodecompany);
            if (empty($cek)) {
                $data = array(
                    'kode' => $value['kode'],
                    'nama' => $value['nama'],
                    'hargabeli' => str_replace(",", "", $value['hargamodal']),
                    'hargajual' => str_replace(",", "", $value['hargajualest']),
                    'cogs' => str_replace(",", "", $value['hargamodal']),
                    'kodecabang' => $kodecabang,
                    'kodecompany' => $kodecompany,
                    'aktif' => true,
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin
                );
                $this->estimasi_order_model->savemasterpart($data);
            } else {                
                $data = array(
                    'hargabeli' => str_replace(",", "", $value['hargamodal']),
                    'hargajual' => str_replace(",", "", $value['hargajualest']),
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin
                );
                $this->estimasi_order_model->updatemasterpart($data,$value['kode'], $kodecabang, $kodecompany);
            }
        }


        $data = array(
            'nomor' => $nomor,
            'tanggal' => date("Y-m-d H:i:s"),
            'kurs' => str_replace(",", "", $this->input->post('kurs')),
            'shipping' => str_replace(",", "", $this->input->post('shipping')),
            'totalshipping' => str_replace(",", "", $this->input->post('totalshipping')),
            'biayaberatkg' => str_replace(",", "", $this->input->post('biayaberat')),
            'totalbeamasuk' => str_replace(",", "", $this->input->post('totalbea')),
            'kode_cabang' => $kodecabang,
            'kodecompany' => $kodecompany,
            'kodegrupcabang' => $kodegrup,
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->estimasi_order_model->saveheader($data);


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


    function cancel()
    {
        $errorvalidasi = FALSE;
        $userlogin = $this->session->userdata('myusername');
        $cek = $this->estimasi_order_model->checkpenerimaan($this->input->post('nomor'));
        if (!empty($cek)) {
            $resultjson = array(
                'nomor' => "",
                'error' => true,
                'message' => "Gagal dibatalkan, Data " . $this->input->post('nomor') . " sudah penerimaan!"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $uangmuka = $this->estimasi_order_model->checkuangmuka($this->input->post('nomor'));
        if (!empty($uangmuka)) {
            $resultjson = array(
                'nomor' => "",
                'error' => true,
                'message' => "Gagal dibatalkan, Data " . $this->input->post('nomor') . " sudah pernah bayar uang muka!"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cduangmuka = $this->estimasi_order_model->checkcduangmuka($this->input->post('nomor'));
        if (!empty($cduangmuka)) {
            $resultjson = array(
                'nomor' => "",
                'error' => true,
                'message' => "Gagal dibatalkan, Data " . $this->input->post('nomor') . " sudah pernah dibuatkan permohonan uang muka!"
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
            $this->estimasi_order_model->updatedata($data, $this->input->post('nomor'));

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

    function update()
    {
        $nomor = $this->input->post('nomor');
        $userlogin = $this->session->userdata('myusername');        
        $kodecabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');
        $kodegrup = $this->session->userdata('mygrupcabang');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $this->estimasi_order_model->DeleteDetail($this->input->post('nomor'));
        if (!empty($this->input->post('datadetail'))) {
            foreach ($this->input->post('datadetail') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'noestimasiorder' => $nomor,
                    'kodepart' => $value['kode'],
                    'namapart' => $value['nama'],
                    'qty' => str_replace(",", "", $value['qty']),
                    'hargausd' => str_replace(",", "", $value['hargausd']),
                    'hargabeli' => str_replace(",", "", $value['hargabeli']),
                    'hargajual' => str_replace(",", "", $value['hargajual']),
                    'hargasatuan' => str_replace(",", "", $value['hargasatuan']),
                    'hargatotal' => str_replace(",", "", $value['hargatotal']),
                    'beratsatuan' => str_replace(",", "", $value['beratsatuan']),
                    'biayaberat' => str_replace(",", "", $value['biayaberatsatuan']),
                    'shippingsatuan' => str_replace(",", "", $value['shipsatuan']),
                    'hargamodal' => str_replace(",", "", $value['hargamodal']),
                    'marginjual' => str_replace(",", "", $value['marginjual']),
                    'harganormal' => str_replace(",", "", $value['harganormal']),
                    'sparemargin' => str_replace(",", "", $value['sparemargin']),
                    'hargajualest' => str_replace(",", "", $value['hargajualest']),
                );
                $this->estimasi_order_model->savedetail($data);
            }
        }

        #update ke master data
        foreach ($this->input->post('datadetail') as $key => $value) {
            $cek = $this->estimasi_order_model->checkmaster($value['kode'], $kodecabang, $kodecompany);
            if (empty($cek)) {
                $data = array(
                    'kode' => $value['kode'],
                    'nama' => $value['nama'],
                    'hargabeli' => str_replace(",", "", $value['hargamodal']),
                    'hargajual' => str_replace(",", "", $value['hargajualest']),
                    'cogs' => str_replace(",", "", $value['hargamodal']),
                    'kodecabang' => $kodecabang,
                    'kodecompany' => $kodecompany,
                    'aktif' => true,
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin
                );
                $this->estimasi_order_model->savemasterpart($data);
            } else {                
                $data = array(
                    'hargabeli' => str_replace(",", "", $value['hargamodal']),
                    'hargajual' => str_replace(",", "", $value['hargajualest']),
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin
                );
                $this->estimasi_order_model->updatemasterpart($data,$value['kode'], $kodecabang, $kodecompany);
            }
        }

        $data = array(
            'kurs' => str_replace(",", "", $this->input->post('kurs')),
            'shipping' => str_replace(",", "", $this->input->post('shipping')),
            'totalshipping' => str_replace(",", "", $this->input->post('totalshipping')),
            'biayaberatkg' => str_replace(",", "", $this->input->post('biayaberat')),
            'totalbeamasuk' => str_replace(",", "", $this->input->post('totalbea')),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->estimasi_order_model->updatedata($data, $nomor);

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
                'message' => "Data berhasil di Update"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
    }

    function find()
    {
        $data = $this->estimasi_order_model->getdatafind($this->input->post('nomor'));
        echo json_encode($data);
    }

    function finddetail()
    {
        $data = $this->estimasi_order_model->getdatafinddetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    function caridatasparepart()
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
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchrangka" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchsparepart" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
}
