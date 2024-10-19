<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Entry_datakendaraan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('spk/entry_datakendaraan_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }


    public function GetDataSN()
    {
        $result =  $this->entry_datakendaraan_model->GetSN($this->input->post('nopolisi'));
        echo json_encode($result);
    }
    public function GetDataTipe()
    {
        $result =  $this->entry_datakendaraan_model->GetTipe($this->input->post('kode_tipe'));
        echo json_encode($result);
    }
    public function GetDataProduct()
    {
        $result =  $this->entry_datakendaraan_model->GetProduct($this->input->post('kode'));
        echo json_encode($result);
    }
    public function GetDataCustomer()
    {
        $result =  $this->entry_datakendaraan_model->GetCustomer($this->input->post('nocustomer'));
        echo json_encode($result);
    }
    public function getKelurahan()
    {
        $result =  $this->entry_datakendaraan_model->getKelurahan($this->input->post('kode'));
        echo json_encode($result);
    }
    public function getwarna()
    {
        $result =  $this->entry_datakendaraan_model->getwarna($this->input->post('kode'));
        echo json_encode($result);
    }
    function FindDetail()
    {
        $data = $this->entry_datakendaraan_model->GetDataFindDetail($this->input->post('nopolisi'), $this->input->post('norangka'), $this->input->post('kodecompany'), $this->input->post('kodecabang'), $this->input->post('kodegrup'));
        echo json_encode($data);
    }

    public function CekNopol()
    {
        $result =  $this->entry_datakendaraan_model->CekNopol($this->input->post('nopolisi'));
        if (!empty($result)) {
            $resultjson = array(
                'error' => false,
                'message' => "Stock ada"
            );
        } else {
            $resultjson = array(
                'error' => true,
                'message' => "Stock tidak ada"
            );
        }
        echo json_encode($resultjson);
    }

    function getSaranKendaraan()
    {
        $data = $this->entry_datakendaraan_model->getSaranKendaraan($this->input->post('nopolisi'));
        echo json_encode($data);
    }


    function carinopol()
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
                        $sub_array[] = '<button class="btn btn-success searchnopol" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

        // $fetch_data = $this->caridata2_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'));  
        // //console.log($fetch_data);
        // $data = array();  
        // foreach($fetch_data as $row)  
        // {  
        //     $sub_array = array(); 
        //     $i= 1;
        //     $count = count($this->input->post('field'));
        //     foreach($this->input->post('field') as $key => $value){
        //         if ($i <= $count){
        //             if ($i == 1){
        //                 $msearch = $row->$value;
        //                 // $sub_array[] = '<button class="btn btnt-info btn-xs searchok" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';
        //                 $sub_array[] = '<button class="btn btn-success searchnopol" data-id="'.$msearch.'"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
        //                 // class="btn btn-new"><i class="fa fa-pen"></i>
        //                 $sub_array[] = $row->$value;

        //             }
        //             else{
        //                 if ($i == $count){
        //                     $sub_array[] = $row->$value;
        //                 }
        //                 else
        //                 {
        //                     $sub_array[] = $row->$value;
        //                 }
        //             }   
        //         }
        //     $i++;
        // } 
        // $data[] = $sub_array; 
        // }  
        // $output = array(  
        //     "draw"                =>     intval($_POST["draw"]),  
        //     "recordsTotal"        =>      $this->caridata2_model->get_all_data($this->input->post('nmtb')),  
        //     "recordsFiltered"     =>     $this->caridata2_model->get_filtered_data($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where')),  
        //     "data"                =>     $data  
        // );  
        // echo json_encode($output);  
    }
    function CariDataTipe()
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
                        $sub_array[] = '<button class="btn btn-success searchtipe" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
    function caridatakodepos()
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
                        $sub_array[] = '<button class="btn btn-success searchpos" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
    function cariwarna()
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
                        $sub_array[] = '<button class="btn btn-success searchwarna" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
        $kodecompany = $this->session->userdata('mycompany');
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        // $approve = 0;
        // $cekWO['nopolisi'] = $this->entry_datakendaraan_model->cekWO($this->input->post('nopolisi'));
        // foreach ($cekWO['nopolisi'] as $cek) {
        //     if (($cek->nopolisi > 2)) {
        //        $this->entry_datakendaraan_model->updateApprove($this->input->post('nopolisi'));
        //     } else{
        //         $approve = 1;
        //     }
        // }

        $ceknopol = $this->entry_datakendaraan_model->GetSN($this->input->post('nopolisi'));
        if (empty($ceknopol)) {
            $cekdata  = $this->entry_datakendaraan_model->GetCustomer($this->input->post('nocustomer'));
            if (empty($cekdata)) {
                $get["customer"] = $this->entry_datakendaraan_model->GetMaxNomor("C");
                // print_r( $get["customer"]);
                // die();
                if (!$get["customer"]) {
                    $nomor = "C000000001";
                } else {
                    $lastNomor = $get['customer']->nomor;
                    $lastNoUrut = substr($lastNomor, 2, 9);

                    // nomor urut ditambah 1
                    $nextNoUrut = $lastNoUrut + 1;
                    $nomor = "C" . sprintf('%09s', $nextNoUrut);
                }
            }

            if (empty($cekdata)) {
                $nocustomer = $nomor;
            } else {
                $nocustomer = $this->input->post('nocustomer');
            }

            $data = array(
                'nopolisi' => $this->input->post('nopolisi'),
                'norangka' => $this->input->post('norangka'),
                'nomesin' => $this->input->post('nomesin'),
                'tahunpembuatan' => $this->input->post('tahun'),
                'transmisi' => $this->input->post('transmisi'),
                'kodetipe' => $this->input->post('kodetipe'),
                'namatipe' => $this->input->post('namatipe'),
                'kodewarna' => $this->input->post('kodewarna'),
                'namawarna' => $this->input->post('namawarna'),
                'nomor_customer' =>  $nocustomer,
                'namapic' => $this->input->post('pic'),
                'nohppic' => $this->input->post('nohppic'),
                'odmeterakhir' => $this->input->post('odemeter'),
                'kode_cabang' => $this->input->post('kodecabang'),
                'jenismobil' => $this->input->post('jenismobil'),
                'pemakai' => $userlogin,
                // 'approve' => $approve,
            );
            $this->entry_datakendaraan_model->SaveHeader($data);

            if (empty($cekdata)) {
                $data = array(
                    'nomor' => $nomor,
                    'title' => $this->input->post('titlecustomer'),
                    'nama' => $this->input->post('namacustomer'),
                    'alamat' => $this->input->post('alamat'),
                    'kelurahan' => $this->input->post('kelurahan'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kota' => $this->input->post('kota'),
                    'provinsi' => $this->input->post('provinsi'),
                    'kodepos' => $this->input->post('kodepos'),
                    'nohp' => $this->input->post('nohp'),
                    'email' => $this->input->post('email'),
                    'npwp' => $this->input->post('npwp'),
                    'namanpwp' => $this->input->post('namacustomer'),
                    'alamatnpwp' => $this->input->post('alamat'),
                    'jeniscustomer' => $this->input->post('jeniscustomer'),
                    'kode_cabang' => $this->input->post('kodecabang'),
                    'kodecompany' => $kodecompany,
                    'aktif' => true
                );
                $this->entry_datakendaraan_model->SaveCustomer($data);
            } else {
                $data = array(
                    'title' => $this->input->post('titlecustomer'),
                    'nama' => $this->input->post('namacustomer'),
                    'alamat' => $this->input->post('alamat'),
                    'kelurahan' => $this->input->post('kelurahan'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kota' => $this->input->post('kota'),
                    'provinsi' => $this->input->post('provinsi'),
                    'kodepos' => $this->input->post('kodepos'),
                    'nohp' => $this->input->post('nohp'),
                    'email' => $this->input->post('email'),
                    'npwp' => $this->input->post('npwp'),
                    'jeniscustomer' => $this->input->post('jeniscustomer'),
                    'namanpwp' => $this->input->post('namacustomer'),
                    'alamatnpwp' => $this->input->post('alamat'),
                    'aktif' => true
                );
                $this->entry_datakendaraan_model->UpdateCustomer($data, $this->input->post('nocustomer'));
            };
        } else {
            $cekcust  = $this->entry_datakendaraan_model->GetCustomer($this->input->post('nocustomer'));
            if (empty($cekcust)) {
                $get["customer"] = $this->entry_datakendaraan_model->GetMaxNomor("C");
                // print_r( $get["customer"]);
                // die();
                if (!$get["customer"]) {
                    $nomor = "C000000001";
                } else {
                    $lastNomor = $get['customer']->nomor;
                    $lastNoUrut = substr($lastNomor, 2, 9);

                    // nomor urut ditambah 1
                    $nextNoUrut = $lastNoUrut + 1;
                    $nomor = "C" . sprintf('%09s', $nextNoUrut);
                }
            }

            if (empty($cekcust)) {
                $data = array(
                    'nomor' => $nomor,
                    'title' => $this->input->post('titlecustomer'),
                    'nama' => $this->input->post('namacustomer'),
                    'alamat' => $this->input->post('alamat'),
                    'kelurahan' => $this->input->post('kelurahan'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kota' => $this->input->post('kota'),
                    'provinsi' => $this->input->post('provinsi'),
                    'kodepos' => $this->input->post('kodepos'),
                    'nohp' => $this->input->post('nohp'),
                    'email' => $this->input->post('email'),
                    'npwp' => $this->input->post('npwp'),
                    'namanpwp' => $this->input->post('namacustomer'),
                    'alamatnpwp' => $this->input->post('alamat'),
                    'jeniscustomer' => $this->input->post('jeniscustomer'),
                    'kode_cabang' => $this->input->post('kodecabang'),
                    'kodecompany' => $kodecompany,
                    'aktif' => true
                );
                $this->entry_datakendaraan_model->SaveCustomer($data);
            } else {
                $data = array(
                    'title' => $this->input->post('titlecustomer'),
                    'nama' => $this->input->post('namacustomer'),
                    'alamat' => $this->input->post('alamat'),
                    'kelurahan' => $this->input->post('kelurahan'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kota' => $this->input->post('kota'),
                    'provinsi' => $this->input->post('provinsi'),
                    'kodepos' => $this->input->post('kodepos'),
                    'nohp' => $this->input->post('nohp'),
                    'email' => $this->input->post('email'),
                    'npwp' => $this->input->post('npwp'),
                    'namanpwp' => $this->input->post('namacustomer'),
                    'jeniscustomer' => $this->input->post('jeniscustomer'),
                    'alamatnpwp' => $this->input->post('alamat'),
                    'aktif' => true
                );
                $this->entry_datakendaraan_model->UpdateCustomer($data, $this->input->post('nocustomer'));
            };

            if (empty($cekcust)) {
                $nocustomer = $nomor;
            } else {
                $nocustomer = $this->input->post('nocustomer');
            }

            $data = array(
                'norangka' => $this->input->post('norangka'),
                'nomesin' => $this->input->post('nomesin'),
                'tahunpembuatan' => $this->input->post('tahun'),
                'transmisi' => $this->input->post('transmisi'),
                'kodetipe' => $this->input->post('kodetipe'),
                'namatipe' => $this->input->post('namatipe'),
                'kodewarna' => $this->input->post('kodewarna'),
                'namawarna' => $this->input->post('namawarna'),
                'nomor_customer' => $nocustomer,
                'odmeterakhir' => $this->input->post('odemeter'),
                'namapic' => $this->input->post('pic'),
                'nohppic' => $this->input->post('nohppic'),
                'kode_cabang' => $this->input->post('kodecabang'),
                'jenismobil' => $this->input->post('jenismobil'),
                'pemakai' => $userlogin
            );
            $this->entry_datakendaraan_model->UpdateHeader($data, $this->input->post('nopolisi'));
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
                'nomor' => $nocustomer,
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
        $this->entry_datakendaraan_model->DeleteDetail($this->input->post('nomor'));
        if (!empty($this->input->post('detailspk'))) {
            foreach ($this->input->post('detailspk') as $key => $value) {
                $data = array(
                    'nomorwo' => $nomorwo,
                    'kodereferensi' => $value['Kode'],
                    'namareferensi' => $value['Nama'],
                    'jenis' => $value['Jenis'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                );
                //$kode = $value['Kode'];

                //$this->entry_datakendaraan_model->DeleteDetail($this->input->post('nomor'),$kode);
                $this->entry_datakendaraan_model->SaveDetail($data);
            }
        }
        $data = array(
            'garansi' => $this->input->post('garansi'),
            'keterangan' => $this->input->post('keterangan'),
            'dpp' => str_replace(",", "", $this->input->post('dpp')),
            'ppn' => str_replace(",", "", $this->input->post('ppn')),
            'grandtotal' => str_replace(",", "", $this->input->post('grandtotal')),
            'totalpart' => str_replace(",", "", $this->input->post('totalpart')),
            'totaljasa' => str_replace(",", "", $this->input->post('totaljasa')),
            'inventaris' => $this->input->post('inventaris')
        );
        $result =  $this->entry_datakendaraan_model->UpdateHeader($data, $this->input->post('nomor'));

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
        $cekwo = $this->entry_datakendaraan_model->checkmemopembatalan($nomorspk);
        if (empty($cekwo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomorspk . " Belum melakukan Memo Pembatalan"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekpembebanan = $this->entry_datakendaraan_model->CekPembebanan($nomorspk);
        if (!empty($cekpembebanan)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomorspk . " Masih ada pembebanan Spareparts"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $checkdp = $this->entry_datakendaraan_model->CekDp($nomorspk);
        if (!empty($checkdp)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomorspk . " Penerimaan DP Belum dibatalkan"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekstatus = $this->entry_datakendaraan_model->checkstatuswo($nomorspk);
        if (!empty($cekstatus)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Close atau Faktur"
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
            $this->entry_datakendaraan_model->CancelTransaksi($data, $this->input->post('nomor'));

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

    function GantiNopol()
    {
        $errorvalidasi = FALSE;
        $nopollama = $this->input->post('nopollama');
        $userlogin = $this->session->userdata('myusername');
        $nopolbaru = $this->input->post('nopolbaru');

        $ceknopol = $this->entry_datakendaraan_model->CekNopol($nopolbaru);
        if (!empty($ceknopol)) {
            $resultjson = array(
                'error' => true,
                'message' => "Gagal Ganti No Polisi: " . $nopolbaru . " Sudah Terdaftar"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);


            $this->entry_datakendaraan_model->InsertHistory($nopolbaru, $this->input->post('nopollama'));
            $data = array(
                'nopolisi' => $this->input->post('nopolbaru')
            );
            $this->entry_datakendaraan_model->GantiNopol($data, $this->input->post('nopollama'));
            $this->entry_datakendaraan_model->UpdateNoPolWO($data, $this->input->post('nopollama'));
            $this->entry_datakendaraan_model->UpdateNoPolBook($data, $this->input->post('nopollama'));
            $this->entry_datakendaraan_model->UpdateNoPolClose($data, $this->input->post('nopollama'));
            $this->entry_datakendaraan_model->UpdateNoPolFaktur($data, $this->input->post('nopollama'));


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
                    'message' => "No Polisi Berhasil diganti !!"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }

            echo json_encode($resultjson);
            return FALSE;
        }
    }
}
