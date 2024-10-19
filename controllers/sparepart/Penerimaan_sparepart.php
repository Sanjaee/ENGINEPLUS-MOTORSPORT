<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaan_sparepart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/penerimaan_sparepart_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function getdatasupplier()
    {
        $result =  $this->penerimaan_sparepart_model->getdatasupplier($this->input->post('nomorsupplier'));
        echo json_encode($result);
    }

    public function getdatasparepart()
    {
        $result =  $this->penerimaan_sparepart_model->getdatasparepart($this->input->post('kode'));
        echo json_encode($result);
    }

    public function getordering()
    {
        $result =  $this->penerimaan_sparepart_model->getordering($this->input->post('nomororder'));
        echo json_encode($result);
    }

    public function invoice()
    {
        $datadetail = $this->input->post('datadetail');
        $kodecabang = $this->input->post('kode_cabang');
        $userlogin = $this->session->userdata('myusername');
        $kodecompany = $this->session->userdata('mycompany');
        $datejttempo = $this->input->post('tanggalinvoice');
        $top = $this->input->post('top');
        $tgljttempo = date('Y-m-d', strtotime($datejttempo . ' + ' . $top . ' days'));
        // print_r($tgljttempo);
        // die();
        $errorvalidasi = FALSE;
        $uangmuka = str_replace(",", "", $this->input->post('nilaiuangmuka'));
        $tgltrx = date('Ym', strtotime($this->input->post('tanggalinvoice')));
        $tglterima = date('Ym', strtotime($this->input->post('tanggalpenerimaan')));

        $cekgl = $this->penerimaan_sparepart_model->checkclosinggl($tgltrx, $kodecabang, $kodecompany);
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

        $cekhpp = $this->penerimaan_sparepart_model->checkclosinghpp($tgltrx, $kodecabang, $kodecompany);
        if (!empty($cekhpp)) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, Periode ini " . $tgltrx . " Sudah Proses Closing Parts"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        if ($tgltrx != $tglterima) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, periode Invoice berbeda dengan periode terima barang!"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        foreach ($datadetail as $key => $valuex) {
            $hargasatuan = str_replace(",", "", $valuex['Total']) / $valuex['QtyTerima'];
            //-----------check harga beli sudah update atau belum sesuai dgn nilai penerimaan
            $cekharga = $this->penerimaan_sparepart_model->checkmaster($valuex['Kode'], $hargasatuan, $kodecabang, $kodecompany);
            // print_r($cekharga);
            // die();
            if (!empty($cekharga)) {
                $resultjson = array(
                    'error' => true,
                    'message' => "Data gagal disimpan, Harga Beli di master tidak sesuai! kode part " . $valuex['Kode'] . " "
                );
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
            }
        }


        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            foreach ($datadetail as $key => $value) {
                $data = array(
                    'harga' => str_replace(",", "", $value['Harga']),
                    'persendiscperitem' => str_replace(",", "", $value['Persendisc']),
                    'discountperitem' => str_replace(",", "", $value['Disc']),
                    'total' => str_replace(",", "", $value['Total']),
                );
                $this->penerimaan_sparepart_model->updateharga($data, $this->input->post('nomor'), $value['Kode']);

                $udata = array(
                    'hargabeliakhir' => (str_replace(",", "", $value['Total']) / $value['QtyTerima']),
                    'cogs' => (str_replace(",", "", $value['Total']) / $value['QtyTerima']),
                );
                $this->penerimaan_sparepart_model->updatepart($udata, $value['Kode'], $kodecabang, $kodecompany);
            }

            //nilai alokasi, jika piutang lebih kecil dari uang muka maka ambil nilai piutang utk alokasi
            $nilaialokasi = "0";
            if (str_replace(",", "", $this->input->post('grandtotal')) <= str_replace(",", "", $this->input->post('nilaiuangmuka'))) {
                $nilaialokasi = str_replace(",", "", $this->input->post('grandtotal'));
            } else {
                $nilaialokasi = str_replace(",", "", $this->input->post('nilaiuangmuka'));
            }

            $data = array(
                'invoice' => $this->input->post('invoice'),
                'noinvoice' => $this->input->post('nomorinvoice'),
                'tglinvoice' => $this->input->post('tanggalinvoice'),
                'nofakturpajak' => $this->input->post('nofakpajak'),
                'tglppn' => $this->input->post('tanggalppn'),
                'nilaiuangmuka' => $nilaialokasi,
                'dpp' => str_replace(",", "", $this->input->post('dpp')),
                'ppn' => str_replace(",", "", $this->input->post('ppn')),
                'total' => str_replace(",", "", $this->input->post('grandtotal'))
            );
            $this->penerimaan_sparepart_model->invoice($data, $this->input->post('nomor'));


            $data = array(
                'noreferensi' => $this->input->post('nomor'),
                'jenistransaksi' => '32',
                'tgltransaksi' => $this->input->post('tanggalinvoice'),
                'tgljttempo' => $tgljttempo,
                'nomorsupplier' => $this->input->post('kodesupplier'),
                'nilaihutang' => str_replace(",", "", $this->input->post('grandtotal')),
                'nilaiuangmuka' => $nilaialokasi,
                'kode_cabang' => $kodecabang,
                'kodesubcabang' => $this->input->post('kodesubcabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->penerimaan_sparepart_model->hutang($data);

            //update nilai alokasi order
            $this->penerimaan_sparepart_model->updateorderum($this->input->post('nomororder'), $nilaialokasi, false);

            //simpan alokasi uang muka
            if ($nilaialokasi != '0') {
                $ambilnomoral = $kodecabang . "-PL" . substr(date("Y"), 2, 2) . date("m");
                $get["noalokasi"] = $this->penerimaan_sparepart_model->getMaxNomorAlokasi($ambilnomoral);
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
                    'jenistransaksi' => '33',
                    'tanggal' => date("Y-m-d H:i:s"),
                    'noreferensi' => $this->input->post('nomororder'),
                    'nomorpembelian' => $this->input->post('nomor'),
                    'nomorsupplier' => $this->input->post('kodesupplier'),
                    'nilaialokasi' =>  $nilaialokasi,
                    'kodecabang' => $kodecabang,
                    'kodesubcabang' => $this->input->post('kodesubcabang'),
                    'kodecompany' => $this->input->post('kodecompany'),
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin
                );
                $this->penerimaan_sparepart_model->savealokasi($dataalokasi);
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
                    'message' => "Data berhasil disimpan!"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }

            echo json_encode($resultjson);
            return FALSE;
        }
    }


    function cancel()
    {
        $errorvalidasi = FALSE;
        $datadetail = $this->input->post('datadetail');
        $nomororder = $this->input->post('nomororder');
        $periode = date("Y") . date("m");
        $kodecabang = $this->input->post('kode_cabang');
        $userlogin = $this->session->userdata('myusername');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');

        //check permohonan / pengeluaran
        $cekpembayaran = $this->penerimaan_sparepart_model->checkpembayaran($this->input->post('nomor'));
        // print_r($cek);
        // die();
        if (!empty($cekpembayaran)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Data " . $this->input->post('nomor') . "  Sudah Pengeluaran uang"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        foreach ($datadetail as $key => $value) {
            //-----------check jika stock kurang maka batal tidak bisa
            $cek = $this->penerimaan_sparepart_model->checkstock($value['Kode'], $periode, $value['QtyTerima'], $kodecabang, $kodecompany, $kodesubcabang);
            // print_r($cek);
            // die();
            if (empty($cek)) {
                $resultjson = array(
                    'error' => true,
                    'message' => "Data gagal dibatalkan, Data Stock " . $value['Kode'] . "  tidak mencukupi"
                );
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
            }
        }
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
            $this->penerimaan_sparepart_model->canceltransaksi($data, $this->input->post('nomor'));

            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->penerimaan_sparepart_model->cancelhutang($data, $this->input->post('nomor'));

            $data = array(
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->penerimaan_sparepart_model->cancelalokasi($data, $this->input->post('nomor'), $this->input->post('nomororder'));

            //nilai alokasi di kembali kan
            $this->penerimaan_sparepart_model->updateorderum($this->input->post('nomororder'), str_replace(",", "", $this->input->post('nilaiuangmuka')), true);

            //balikan status close di order/request
            $this->penerimaan_sparepart_model->updateorder($this->input->post('nomororder'), TRUE);

            foreach ($datadetail as $key => $value) {
                //-----------update stock
                $cek = $this->penerimaan_sparepart_model->checkstock($value['Kode'], $periode, $value['QtyTerima'], $kodecabang, $kodecompany, $kodesubcabang);

                if (!empty($cek)) {

                    $this->penerimaan_sparepart_model->updatestock($value['Kode'], $value['QtyTerima'], $periode, $kodecabang, $kodecompany, $kodesubcabang, TRUE);

                    //update ke request cabang
                    $this->penerimaan_sparepart_model->updateordering($value['QtyTerima'], $this->input->post('nomororder'), $value['Kode'], TRUE);
                }
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

    function find()
    {
        $data = $this->penerimaan_sparepart_model->getdatafind($this->input->post('nomor'));
        echo json_encode($data);
    }

    function finddetail()
    {
        $data = $this->penerimaan_sparepart_model->getdatafinddetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    function findpenerimaan()
    {
        $data = $this->penerimaan_sparepart_model->findpenerimaan($this->input->post('nomor'));
        echo json_encode($data);
    }

    function findpenerimaandetail()
    {
        $data = $this->penerimaan_sparepart_model->findpenerimaandetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    function save()
    {
        // print_r(date("Y").date("m"));         
        // die();
        $periode = date("Y") . date("m");
        $kodecabang = $this->input->post('kode_cabang');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $userlogin = $this->session->userdata('myusername');
        $errorvalidasi = FALSE;

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $ambilnomor = "PP" . substr(date("Y"), 2, 2) . date("m");
            $get["penerimaan"] = $this->penerimaan_sparepart_model->getMaxNomor($ambilnomor);
            if (!$get["penerimaan"]->nomor) {
                $nomor = $ambilnomor . "00001";
            } else {
                $lastNomor = $get['penerimaan']->nomor;
                $lastNoUrut = substr($lastNomor, 6, 11);

                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor . sprintf('%05s', $nextNoUrut);
            }
            foreach ($this->input->post('detail') as $key => $value) {

                //-----------check jika tidak ada maka stock insert
                $ceksp = $this->penerimaan_sparepart_model->checkdatastock($value['Kode'], $periode, $kodecabang, $kodecompany, $kodesubcabang);

                if (!empty($ceksp)) {
                    $this->penerimaan_sparepart_model->updatestock($value['Kode'], $value['QtyTerima'], $periode, $kodecabang, $kodecompany, $kodesubcabang, FALSE);
                } else {
                    $stock = array(
                        'periode' => $periode,
                        'kodepart' => $value['Kode'],
                        'qtymasuk' => $value['QtyTerima'],
                        'kode_cabang' => $kodecabang,
                        'kodesubcabang' => $kodesubcabang,
                        'kodecompany' => $kodecompany,
                    );
                    $this->penerimaan_sparepart_model->insertstock($stock);
                }
                //--------------End Here
                $data = array(
                    'nomorpenerimaan' => $nomor,
                    'kodepart' => $value['Kode'],
                    'qty' => str_replace(",", "", $value['QtyTerima']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'persendiscperitem' => str_replace(",", "", $value['Persendisc']),
                    'discountperitem' => str_replace(",", "", $value['Disc']),
                    'total' => str_replace(",", "", $value['Total']),
                    'hargagr' => str_replace(",", "", $value['Harga']),
                    'persendiscperitemgr' => str_replace(",", "", $value['Persendisc']),
                    'discountperitemgr' => str_replace(",", "", $value['Disc']),
                    'totalgr' => str_replace(",", "", $value['Total']),
                );
                $this->penerimaan_sparepart_model->savedetail($data);

                //update ke request cabang
                $this->penerimaan_sparepart_model->updateordering($value['QtyTerima'], $this->input->post('nomororder'), $value['Kode'], FALSE);
            }

            $data = array(
                'nomor' => $nomor,
                'tanggal' => date("Y-m-d H:i:s"),
                'nomororder' => $this->input->post('nomororder'),
                'nomorsupplier' => $this->input->post('kodesupplier'),
                'noinvoice' => $this->input->post('nomorinvoice'),
                'tglinvoice' => $this->input->post('tanggalinvoice'),
                'nofakturpajak' => $this->input->post('nofakpajak'),
                'tglppn' => $this->input->post('tanggalppn'),
                'dpp' => str_replace(",", "", $this->input->post('dpp')),
                'ppn' => str_replace(",", "", $this->input->post('ppn')),
                'total' => str_replace(",", "", $this->input->post('grandtotal')),
                // 'nilaiuangmuka'=> str_replace(",","",$this->input->post('nilaiuangmuka')),

                'dppgr' => str_replace(",", "", $this->input->post('dpp')),
                'ppngr' => str_replace(",", "", $this->input->post('ppn')),
                'totalgr' => str_replace(",", "", $this->input->post('grandtotal')),

                'nilaiuangmuka' => 0,
                'kode_cabang' => $kodecabang,
                'kodesubcabang' => $kodesubcabang,
                'kodecompany' => $kodecompany,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->penerimaan_sparepart_model->saveheader($data);

            //jika qty = qtygr status order close
            $cekorder = $this->penerimaan_sparepart_model->checkorder($this->input->post('nomororder'));
            if (!empty($cekorder)) {
                foreach ($cekorder as $key => $value) {
                    if ($value->qty == $value->qtygr) {
                        $this->penerimaan_sparepart_model->updateorder($this->input->post('nomororder'), FALSE);
                    }
                }
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
    }

    function closebo()
    {
        $userlogin = $this->session->userdata('myusername');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);
        $data = array(
            'close' => true
        );
        $this->penerimaan_sparepart_model->updatetransaksi($data, $this->input->post('nomororder'));

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'error' => true,
                'message' => "Ordering Sparepart Gagal di close!"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'error' => false,
                'message' => "Ordering Sparepart Berhasil di close !"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }

        echo json_encode($resultjson);
    }

    function caridatasupplier()
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
                        $sub_array[] = '<button class="btn btn-success searchsupplier" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
                        $sub_array[] = '<button class="btn btn-success searchokbro" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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


    function caridatapenerimaan()
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
