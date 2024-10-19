<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur_partcounter extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/faktur_partcounter_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
    }

    public function CekDisc()
    {
        $result =  $this->faktur_partcounter_model->CekDisc($this->input->post('mgrup'), $this->input->post('modul'), $this->input->post('persen'));
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

    public function GetDataOrder()
	{
		$result =  $this->faktur_partcounter_model->GetDataOrder($this->input->post('nomor'));
		echo json_encode($result);
    }

    function GetDetail()
    {
            $data = $this->faktur_partcounter_model->GetDetail($this->input->post('nomor'));
            echo json_encode($data);
    }
    function FindFaktur()
    {
            $data = $this->faktur_partcounter_model->GetDataFind($this->input->post('nomor'));
            echo json_encode($data);
    }
    function FindFakturDetail()
    {
            $data = $this->faktur_partcounter_model->GetDataFakturDetail($this->input->post('nomor'));
            echo json_encode($data);
    }

    function CariDataOrder(){  

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value'));  

        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $sub_array = array(); 
            $i= 1;
            $count = count($this->input->post('field'));
            foreach($this->input->post('field') as $key => $value){
                if ($i <= $count){
                    if ($i == 1){
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcustomer" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchorder" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
                        $sub_array[] = $row->$value;
                        
                    }
                    else{
                        if ($i == $count){
                            $sub_array[] = $row->$value;
                        }
                        else
                        {
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
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value')),  
            "data"                    =>     $data  
        );  
        echo json_encode($output);  
    }
    function CariDataFaktur(){  

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value'));  
        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $sub_array = array(); 
            $i= 1;
            $count = count($this->input->post('field'));
            foreach($this->input->post('field') as $key => $value){
                if ($i <= $count){
                    if ($i == 1){
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchok" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchok" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
                        $sub_array[] = $row->$value;
                        
                    }
                    else{
                        if ($i == $count){
                            $sub_array[] = $row->$value;
                        }
                        else
                        {
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
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value')),  
            "data"                    =>     $data  
        );  
        echo json_encode($output);  
    }

    function Save(){
        $userlogin = $this->session->userdata('myusername');
        $kodecabang = $this->input->post('kodecabang');
        $periode = date("Y").date("m");
        $uangmuka = str_replace(",","",$this->input->post('uangmuka'));
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $errorvalidasi = FALSE;
        
        foreach ($this->input->post('detailfaktur') as $key => $value) {
            //-----------check jika stock kurang maka tidak bisa Save
            $cek = $this->faktur_partcounter_model->checkstock($value['Kode'], $periode, $value['Qty'], $kodecabang, $kodesubcabang, $kodecompany);
            // print_r($cek);
            // die();
            if (empty($cek)) {
                $resultjson = array(
                    'nomor' => "",
                    'error' => true,
                    'message' => "Data Stock " . $value['Kode'] . "  tidak mencukupi");
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                };
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            
            $ambilnomor = "CF-". $kodecabang . "-" . substr(date("Y"), 2, 2).date("m");
            $get["SPK"] = $this->faktur_partcounter_model->GetMaxNomor($ambilnomor); 
            if (!$get["SPK"]->nomor){
                $nomor = $ambilnomor."00001";
            }
            else{
                $lastNomor = $get['SPK']->nomor;
                $lastNoUrut = substr($lastNomor, 11, 16); 
    
                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor.sprintf('%05s', $nextNoUrut);
            }

             //simpan alokasi uang muka
            if ($uangmuka != '0') {
                $ambilnomoral = $kodecabang . "-AL" . substr(date("Y"), 2, 2) . date("m");
                $get["noalokasi"] = $this->faktur_partcounter_model->getMaxNomorAlokasi($ambilnomoral);
               
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
                    'jenistransaksi' => '52',
                    'tanggal' => date("Y-m-d H:i:s"),
                    'noreferensi' => $this->input->post('nomororder'),
                    'nomorpenjualan' => $nomor,
                    'nomorcustomer' => $this->input->post('nomor_customer'),
                    'nilaialokasi' =>  $uangmuka,
                    'kodecabang' => $kodecabang,
                    'kodesubcabang' => $kodesubcabang,
                    'kodecompany' => $kodecompany,
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $userlogin
                );
                $this->faktur_partcounter_model->savealokasi($dataalokasi);
            }
            
            foreach ($this->input->post('detailfaktur') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                    $data = array(
                        'nomor_faktur' => $nomor,
                        'kode_parts' => $value['Kode'],
                        'qty'=> str_replace(",","",$value['Qty']),
                        'harga'=> str_replace(",","",$value['Harga']),
                        'persendiscperitem'=> str_replace(",","",$value['Persen']),
                        'discountperitem'=> str_replace(",","",$value['Discount']),
                        'subtotal'=> str_replace(",","",$value['Subtotal']),
                        'jenisdetail'=> $value['Jenis']
                    );
                    $this->faktur_partcounter_model->SaveDetail($data);

                    $this->faktur_partcounter_model->updatestock($value['Kode'], $value['Qty'], $periode, $kodecabang, $kodesubcabang, $kodecompany, TRUE);
            }

            $data = array(
                'nomor' => $nomor,
                'nopolisi' => $this->input->post('nopolisi'),
                'nomor_order' => $this->input->post('nomororder'),
                'nomor_customer'=> $this->input->post('nomor_customer'),
                'nama_customer'=> $this->input->post('namacustomer'),
                'alamat_customer'=> $this->input->post('alamat'),
                'notelp'=> $this->input->post('notlp'),
                'nohp'=> $this->input->post('nohp'),
                'tanggal' => date("Y-m-d H:i:s"),
                'nilaiuangmuka' => str_replace(",","",$this->input->post('uangmuka')),
                'dpp'=> str_replace(",","",$this->input->post('dpp')),
                'ppn'=> str_replace(",","",$this->input->post('ppn')),
                'total'=> str_replace(",","",$this->input->post('grandtotal')),
                'kode_cabang' => $this->input->post('kodecabang'),
                'kodesubcabang' => $kodesubcabang,
                'kodecompany' => $kodecompany,
                'ongkir' => str_replace(",","",$this->input->post('ongkir')),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->faktur_partcounter_model->SaveHeader($data);

            $data = array(
                'noreferensi' => $nomor,
                'jenistransaksi' => '52',
                'tgltransaksi' => date("Y-m-d H:i:s"),
                'tgljttempo' => date("Y-m-d H:i:s"),
                'nomor_customer'=> $this->input->post('nomor_customer'),
                'nilaipiutang' => str_replace(",","",$this->input->post('grandtotal')),
                'nilaipenerimaan' => 0,
                'nilaiuangmuka' => str_replace(",","",$this->input->post('uangmuka')),
                'kode_cabang' => $this->input->post('kodecabang'),
                'kodesubcabang' => $kodesubcabang,
                'kodecompany' => $kodecompany,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin

            );
            $this->faktur_partcounter_model->SavePiutang($data);

            $data = array(
                'statusfaktur' => true
            );
            $this->faktur_partcounter_model->UpdateStatusFaktur($data,$this->input->post('nomororder'));


            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'nomor' => "",
                    'message' => "Data gagal disimpan, Nomor sudah pernah digunakan");
                # Something went wrong.
                $this->db->trans_rollback();
            } 
            else {
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
        $errorvalidasi = FALSE;
        $nomor = $this->input->post('nomor');
        $periode = date("Y").date("m");
        $kodecabang = $this->input->post('kodecabang');
        $datadetail = $this->input->post('datadetail');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $userlogin = $this->session->userdata('myusername');

        // foreach ($datadetail as $key => $value) {
        //    //-----------check jika stock kurang maka batal tidak bisa
        //    $cek = $this->faktur_partcounter_model->checkstock($value['Kode'], $periode, $value['Qty'], $kodecabang, $kodesubcabang, $kodecompany);
        // //    print_r($cek);
        // //    die();
        //    if (empty($cek)) {
        //        $resultjson = array(
        //            'nomor' => "",
        //            'error' => true,
        //            'message' => "Data Stock " . $value['Kode'] . "  tidak mencukupi");
        //            $errorvalidasi = TRUE;
        //            echo json_encode($resultjson);
        //            return FALSE;
        //         };
        // };

        //klo sudah dibayar tidak bisa cancel faktur
        $cekbayar = $this->faktur_partcounter_model->checkbayar($nomor);
        // print_r($cekbayar);
        // die();
        if (!empty($cekbayar)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomor . " Pelunasan Invoice");
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
            $this->faktur_partcounter_model->CancelFaktur($data,$this->input->post('nomor'));
            
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->faktur_partcounter_model->CancelPiutang($data,$this->input->post('nomor'));

            $data = array(
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->faktur_partcounter_model->cancelalokasi($data,$this->input->post('nomor'),$this->input->post('nomororder'));

            $data = array(
                'statusfaktur' => false
            );
            $this->faktur_partcounter_model->UpdateStatusFaktur($data,$this->input->post('nomororder'));

            foreach ($datadetail as $key => $value) {
                $ceksp = $this->faktur_partcounter_model->checkdatastock($value['Kode'], $periode, $kodecabang, $kodecompany, $kodesubcabang);
                if (!empty($ceksp)) {
                    $this->faktur_partcounter_model->updatestock($value['Kode'], $value['Qty'], $periode, $kodecabang, $kodesubcabang, $kodecompany, FALSE);
                }else{
                    $stock = array(
                        'periode' => $periode,
                        'kodepart' => $value['Kode'],
                        'qtymasuk' => $value['Qty'],
                        'kode_cabang' => $kodecabang,
                        'kodesubcabang' => $kodesubcabang,
                        'kodecompany' => $kodecompany,
                    );
                    $this->faktur_partcounter_model->insertstock($stock);
                }
            };

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                # Something went wrong.
                $this->db->trans_rollback();
                $resultjson = array(
                    'error' => true,
                    'message' => "Data gagal disimpan, Nomor sudah pernah digunakan");
            } 
            else {                
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
                $resultjson = array(
                    'error' => false,
                    'message' => "Data berhasil dibatalkan"
                );
            }
            
            echo json_encode($resultjson);
            return FALSE;
        }
    }


    
}
?>