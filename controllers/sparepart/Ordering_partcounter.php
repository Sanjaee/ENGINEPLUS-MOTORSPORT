<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ordering_partcounter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/ordering_partcounter_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function getdatacustomer()
    {
        $result =  $this->ordering_partcounter_model->getdatacustomer($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function getdatasparepart()
    {
        $result =  $this->ordering_partcounter_model->getdatasparepart($this->input->post('kode'), $this->input->post('kode_cabang'), $this->input->post('kodecompany'));
        echo json_encode($result);
    }


    function cancel()
    {

        // $result = $this->ordering_partcounter_model->cekdp($this->input->post('nomor'));
        $errorvalidasi = FALSE;
        $nomor = $this->input->post('nomor');
        $userlogin = $this->session->userdata('myusername');
        $checkdp = $this->ordering_partcounter_model->cekdp($nomor);
        if (!empty($checkdp)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomor . " Penerimaan DP Belum dibatalkan"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekstatus = $this->ordering_partcounter_model->checkstatus($nomor);
        if (!empty($cekstatus)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomor . " Sudah Faktur"
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
            $this->ordering_partcounter_model->canceltransaksi($data, $this->input->post('nomor'));

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

    function find()
    {
        $data = $this->ordering_partcounter_model->getdatafind($this->input->post('nomor'));
        echo json_encode($data);
    }

    function finddetail()
    {
        $data = $this->ordering_partcounter_model->getdatafinddetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    function GetDataOrderPart()
    {
        $data = $this->ordering_partcounter_model->GetDataOrderPart($this->input->post('nomor'));
        echo json_encode($data);
    }

    function save()
    {
        $kodecabang = $this->input->post('kodecabang');
        $userlogin = $this->session->userdata('myusername');
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $ambilnomor = "CO-" . $kodecabang . "-" . substr(date("Y"), 2, 2) . date("m");
        $get["nomor"] = $this->ordering_partcounter_model->GetMaxNomor($ambilnomor);

        if (!$get["nomor"]->nomor) {
            $nomor = $ambilnomor . "00001";
        } else {
            $lastNomor = $get['nomor']->nomor;

            $lastNoUrut = substr($lastNomor, 11, 16);

            // nomor urut ditambah 1
            $nextNoUrut = $lastNoUrut + 1;
            $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
        }

        foreach ($this->input->post('detail') as $key => $value) {
            $data = array(
                'nomor_order' => $nomor,
                'kode_parts' => $value['Kode'],
                'qty' => str_replace(",", "", $value['Qty']),
                'harga' => str_replace(",", "", $value['Harga']),
                'persendiscperitem' => str_replace(",", "", $value['Persen']),
                'discountperitem' => str_replace(",", "", $value['Discount']),
                'subtotal' => str_replace(",", "", $value['Total']),
                'jenisdetail' => $value['Jenis'],
                'keterangan' => $value['Keterangan']
            );
            $this->ordering_partcounter_model->savedetail($data);
        }

        $data = array(
            'nomor' => $nomor,
            'tanggal' => date("Y-m-d H:i:s"),
            'nomor_customer' => $this->input->post('nocustomer'),
            'nama_customer' => $this->input->post('namacustomer'),
            'alamat_customer' => $this->input->post('alamat'),
            'notelp' => $this->input->post('notlp'),
            'nohp' => $this->input->post('nohp'),
            'nopolisi' => $this->input->post('nopolisi'),
            'dpp' => str_replace(",", "", $this->input->post('dpp')),
            'ppn' => str_replace(",", "", $this->input->post('ppn')),
            'total' => str_replace(",", "", $this->input->post('grandtotal')),
            'kode_cabang' => $kodecabang,
            'kodesubcabang' => $this->input->post('kodesubcabang'),
            'kodecompany' => $this->input->post('kodecompany'),
            'noreferensi' => $this->input->post('nomororder'),
            'tipejual' => $this->input->post('tipejual'),
            'ongkir' =>  str_replace(",", "", $this->input->post('ongkir')),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->ordering_partcounter_model->saveheader($data);

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

    function update()
    {
        $nomor = $this->input->post('nomor');
        $userlogin = $this->session->userdata('myusername');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $this->ordering_partcounter_model->DeleteDetail($this->input->post('nomor'));
        if (!empty($this->input->post('detail'))) {
            foreach ($this->input->post('detail') as $key => $value) {
                $data = array(
                    'nomor_order' => $nomor,
                    'kode_parts' => $value['Kode'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'persendiscperitem' => str_replace(",", "", $value['Persen']),
                    'discountperitem' => str_replace(",", "", $value['Discount']),
                    'subtotal' => str_replace(",", "", $value['Total']),
                    'jenisdetail' => $value['Jenis'],
                    'keterangan' => $value['Keterangan']
                );
                $this->ordering_partcounter_model->SaveDetail($data);
            }
        }

        $data = array(
            'dpp' => str_replace(",", "", $this->input->post('dpp')),
            'ppn' => str_replace(",", "", $this->input->post('ppn')),
            'ongkir' => str_replace(",", "", $this->input->post('ongkir')),
            'total' => str_replace(",", "", $this->input->post('grandtotal')),
            'tipejual' => $this->input->post('tipejual'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->ordering_partcounter_model->updateheader($data, $nomor);

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

    function caridatacustomer()
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
                        // $sub_array[] = '<button class="btn1 btn-pilih searchtujuan" data-id="'.$msearch.'"><i class="fas fa-hand-o-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchcustomer" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariOrderPart()
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
                        // $sub_array[] = '<button class="btn1 btn-pilih searchtujuan" data-id="'.$msearch.'"><i class="fas fa-hand-o-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchop" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function caridatarefbatal()
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
                        $sub_array[] = '<button class="btn btn-success searchbatal" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
