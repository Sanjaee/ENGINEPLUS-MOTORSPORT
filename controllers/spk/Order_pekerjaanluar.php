<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_pekerjaanluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('spk/order_pekerjaanluar_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function GetDataSPK()
    {
        $result =  $this->order_pekerjaanluar_model->GetSPK($this->input->post('nomorspk'));
        echo json_encode($result);
    }

    function GetSPKDetail()
    {
        $data = $this->order_pekerjaanluar_model->GetDataSPKDetail($this->input->post('nomor'));
        echo json_encode($data);
    }


    public function getdataopl()
    {
        $result =  $this->order_pekerjaanluar_model->getdataopl($this->input->post('kode'));
        echo json_encode($result);
    }

    public function getdatasupp()
    {
        $result =  $this->order_pekerjaanluar_model->getdatasupp($this->input->post('nomor'));
        echo json_encode($result);
    }

    function FindOPL()
    {
        $data = $this->order_pekerjaanluar_model->FindOPL($this->input->post('nomor'));
        echo json_encode($data);
    }
    function FindOPLDetail()
    {
        $data = $this->order_pekerjaanluar_model->FindOPLDetail($this->input->post('nomor'));
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
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcustomer" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
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

    function CariDataSupp()
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
                        $sub_array[] = '<button class="btn btn-success searchsupp" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
        $kodecabang = $this->input->post('kodecabang');
        $userlogin = $this->session->userdata('myusername');

        foreach ($this->input->post('detail') as $key => $value) {
            $checkwo = $this->order_pekerjaanluar_model->checkwoopl($this->input->post('nomorspk'),$value['Kode']);
            if (!empty($checkwo)) {
                $resultjson = array(
                    'error' => true,
                    'nomor' => "",
                    'message' => "Data gagal disimpan, OPL " . $value['Nama'] . " Sudah Pernah Dibebankan"
                );
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
            }
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $ambilnomor = "GL" . substr(date("Y"), 2, 2) . date("m");
            $get["GL"] = $this->order_pekerjaanluar_model->GetMaxNomor($ambilnomor);
            if (!$get["GL"]->nomor) {
                $nomor = $ambilnomor . "00001";
            } else {
                $lastNomor = $get['GL']->nomor;
                $lastNoUrut = substr($lastNomor, 6, 11);

                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
            }
            foreach ($this->input->post('detail') as $key => $value) {

                $data = array(
                    'nomor_opl' => $nomor,
                    'kode_pekerjaan' => $value['Kode'],
                    'nama_pekerjaan' => $value['Nama'],
                    'kategoridetail' => $value['KategoriDetail'],
                    'hargabeli' => str_replace(",", "", $value['Harga']),
                    'hargajual' => str_replace(",", "", $value['HargaJual'])
                );

                $this->order_pekerjaanluar_model->SaveDetail($data);
            }

            $data = array(
                'nomor' => $nomor,
                'nomor_wo' => $this->input->post('nomorspk'),
                'tanggal' => date("Y-m-d H:i:s"),
                'nopolisi' => $this->input->post('nopolisi'),
                'nomor_supplier' => $this->input->post('kodesupplier'),
                'dppbeli' => str_replace(",", "", $this->input->post('dpp')),
                'ppnbeli' => str_replace(",", "", $this->input->post('ppn')),
                'total' => str_replace(",", "", $this->input->post('total')),
                'kode_cabang' => $this->input->post('kodecabang'),
                'kodesubcabang' => $this->input->post('kodesubcabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->order_pekerjaanluar_model->SaveHeader($data);

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

    function Invoice()
    {

        $errorvalidasi = FALSE;
        $kodecabang = $this->input->post('kodecabang');
        $userlogin = $this->session->userdata('myusername');
        $kodecompany = $this->input->post('kodecompany');
        $tgltrx = date('Ym', strtotime($this->input->post('tanggalinvoice')));

        $cekgl = $this->order_pekerjaanluar_model->checkclosinggl($tgltrx, $kodecabang, $kodecompany);
        if (!empty($cekgl)) {
            $resultjson = array(
                'error' => true,
                'nomor' => "",
                'message' => "Data gagal disimpan, Periode " . $tgltrx . " Sudah Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        $cekclo = $this->order_pekerjaanluar_model->checkclosingacc($tgltrx, $kodecabang, $kodecompany);
        if (!empty($cekclo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, Periode ini " . $tgltrx . " Sudah Proses Closing Accounting"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $data = array(
                'dppbeli' => str_replace(",", "", $this->input->post('dpp')),
                'ppnbeli' => str_replace(",", "", $this->input->post('ppn')),
                'total' => str_replace(",", "", $this->input->post('grandtotal')),
                'statusselesai' => true,
                'tglselesai' => $this->input->post('tanggalinvoice'),
                'noinvoice' => $this->input->post('noinvoice')
            );
            $this->order_pekerjaanluar_model->Invoice($data, $this->input->post('nomor'));

            foreach ($this->input->post('datadetail') as $key => $value) {

                $data = array(
                    'hargabeli' => str_replace(",", "", $value['Harga']),
                    'hargajual' => str_replace(",", "", $value['HargaJual'])
                );

                $this->order_pekerjaanluar_model->UpdateDetail($data, $this->input->post('nomor'), $value['Kode']);
            }

            $data = array(
                'noreferensi' => $this->input->post('nomor'),
                'jenistransaksi' => '31',
                'tgltransaksi' => $this->input->post('tanggalinvoice'),
                'tgljttempo' => $this->input->post('tanggalinvoice'),
                'nomorsupplier' => $this->input->post('kodesupplier'),
                'nilaihutang' => str_replace(",", "", $this->input->post('grandtotal')),
                'kode_cabang' => $kodecabang,
                'kodesubcabang' => $this->input->post('kodesubcabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $result =  $this->order_pekerjaanluar_model->hutang($data);

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
                    'nomor' => $data,
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
        $userlogin = $this->session->userdata('myusername');

        $cekwo = $this->order_pekerjaanluar_model->checkstatuswo($nomorspk);
        if (!empty($cekwo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Close SPK"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        //check permohonan / pengeluaran
        $cekpembayaran = $this->order_pekerjaanluar_model->checkpembayaran($this->input->post('nomor'));
        if (!empty($cekpembayaran)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Data " . $this->input->post('nomor') . "  Sudah Pengeluaran uang"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }
        //--------------End Here
        if ($errorvalidasi == FALSE) {
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->order_pekerjaanluar_model->CancelPembebanan($data, $this->input->post('nomor'));

            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $result =  $this->order_pekerjaanluar_model->updatehutang($data, $this->input->post('nomor'));


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

    function FindDataOPL()
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
                        $sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
                        $sub_array[] = $row->$value;
                    } else if ($i == 4) {
                        $msearch = $row->$value;
                        if ($msearch != "t") {
                            $sub_array[] = '<td>Belum Invoice</td>';
                        } else {
                            $sub_array[] = '<td>Sudah Invoice</td>';
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
