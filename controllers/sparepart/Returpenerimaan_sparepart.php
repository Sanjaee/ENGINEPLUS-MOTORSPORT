<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Returpenerimaan_sparepart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/returpenerimaan_sparepart_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
	}

    public function getdatasupplier()
	{
		$result =  $this->returpenerimaan_sparepart_model->getdatasupplier($this->input->post('nomorsupplier'));
		echo json_encode($result);
    }
    
	public function getdatasparepart()
	{
		$result =  $this->returpenerimaan_sparepart_model->getdatasparepart($this->input->post('kode'));
		echo json_encode($result);
    }

    function cancel()
    {       
        $errorvalidasi = FALSE;
        $datadetail = $this->input->post('datadetail');
        $nomororder = $this->input->post('nomororder');
        $periode = date("Y").date("m");
        $kodecabang = $this->input->post('kode_cabang');
        $userlogin = $this->session->userdata('myusername');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');

        //check Penerimaan
        $cekpembayaran = $this->returpenerimaan_sparepart_model->checkpembayaran($this->input->post('nomor'));
        if (!empty($cekpembayaran)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Data " . $this->input->post('nomor') . "  Sudah Penerimaan Uang");
                $errorvalidasi = TRUE;
                echo json_encode($resultjson);
                return FALSE;
            }
        
        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->returpenerimaan_sparepart_model->canceltransaksi($data,$this->input->post('nomor'));
            
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->returpenerimaan_sparepart_model->cancelpiutang($data,$this->input->post('nomor'));

            foreach ($datadetail as $key => $value) {
                //-----------check jika tidak ada maka stock insert
                $ceksp = $this->returpenerimaan_sparepart_model->checkdatastock($value['Kode'], $periode, $kodecabang, $kodesubcabang, $kodecompany);
                
                if (!empty($ceksp)) {
                    $this->returpenerimaan_sparepart_model->updatestock($value['Kode'], $value['Qty'], $periode, $kodecabang, $kodesubcabang, $kodecompany, FALSE);
                }else{
                    $stock = array(
                        'periode' => $periode,
                        'kodepart' => $value['Kode'],
                        'qtymasuk' => $value['Qty'],
                        'kode_cabang' => $kodecabang,
                        'kodesubcabang' => $kodesubcabang,
                        'kodecompany' => $kodecompany,
                    );
                    $this->returpenerimaan_sparepart_model->insertstock($stock);
                }
                //--------------End Here

                //update ke Penerimaan Part
                $this->returpenerimaan_sparepart_model->updatepenerimaan($value['Qty'],$this->input->post('nomorpenerimaan'),$value['Kode'],TRUE);
            
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'error' => true,
                    'message' => "Data gagal disimpan, Nomor sudah pernah digunakan");
                # Something went wrong.
                $this->db->trans_rollback();
            } 
            else {
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
            $data = $this->returpenerimaan_sparepart_model->getdatafind($this->input->post('nomor'));
            echo json_encode($data);
    }

    function finddetail()
    {
            $data = $this->returpenerimaan_sparepart_model->getdatafinddetail($this->input->post('nomor'));
            echo json_encode($data);
    }

    function getdatapenerimaan()
    {
            $data = $this->returpenerimaan_sparepart_model->getdatapenerimaan($this->input->post('nomor'));
            echo json_encode($data);
    }

    function getpenerimaandetail()
    {
            $data = $this->returpenerimaan_sparepart_model->getpenerimaandetail($this->input->post('nomor'));
            echo json_encode($data);
    }

    function save()
    {
        $periode = date("Y").date("m");
        $kodecabang = $this->input->post('kode_cabang');
        $userlogin = $this->session->userdata('myusername');        
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $errorvalidasi = FALSE;

        foreach ($this->input->post('detail') as $key => $value) {
            //-----------check jika stock kurang maka batal tidak bisa
            $cek = $this->returpenerimaan_sparepart_model->checkstock($value['Kode'], $periode, $value['Qty'], $kodecabang, $kodesubcabang, $kodecompany);
            
            if (empty($cek)) {
                $resultjson = array(
                    'error' => true,
                    'message' => "Data gagal dibatalkan, Data Stock " . $value['Kode'] . "  tidak mencukupi");
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
            }
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $ambilnomor = "PR".substr(date("Y"), 2, 2).date("m");
            $get["penerimaan"] = $this->returpenerimaan_sparepart_model->getMaxNomor($ambilnomor); 
            if (!$get["penerimaan"]->nomor){
                $nomor = $ambilnomor."00001";
            }
            else{
                $lastNomor = $get['penerimaan']->nomor;
                $lastNoUrut = substr($lastNomor, 6, 11); 
    
                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor.sprintf('%05s', $nextNoUrut);
            }
            
            $data = array(
                'nomor' => $nomor,
                'tanggal' => date("Y-m-d H:i:s"),
                'nomorpenerimaan'=> $this->input->post('nomorpenerimaan'),
                'tanggalterima'=> $this->input->post('tanggalpenerimaan'),
                'nomorsupplier' => $this->input->post('kodesupplier'),
                'noinvoice' => $this->input->post('nomorinvoice'),
                'tglinvoice' => $this->input->post('tglinvoice'),
                'nofakpajak' => $this->input->post('nofakpajak'),
                'tglppn' => $this->input->post('tglppn'),
                'dpp'=> str_replace(",","",$this->input->post('dpp')),
                'ppn'=> str_replace(",","",$this->input->post('ppn')),
                'total'=> str_replace(",","",$this->input->post('grandtotal')),
                'totalbiayapenalti'=> str_replace(",","",$this->input->post('totalpinalti')),
                'alasanretur' => $this->input->post('keterangan'),
                'kode_cabang'=> $kodecabang,
                'kodesubcabang' => $kodesubcabang,
                'kodecompany' => $kodecompany,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->returpenerimaan_sparepart_model->saveheader($data);

            foreach ($this->input->post('detail') as $key => $value) {
                $this->returpenerimaan_sparepart_model->updatestock($value['Kode'], $value['Qty'], $periode,$kodecabang, $kodesubcabang, $kodecompany, TRUE);

                //update ke Penerimaan Part
                $this->returpenerimaan_sparepart_model->updatepenerimaan($value['Qty'],$this->input->post('nomorpenerimaan'),$value['Kode'],FALSE);
            
                $data = array(
                    'nomorretur' => $nomor,
                    'kodepart' => $value['Kode'],
                    'qtyterima'=> str_replace(",","",$value['QtyTerima']),
                    'qtyretur'=> str_replace(",","",$value['Qty']),
                    'harga'=> str_replace(",","",$value['Harga']),
                    'persendiscperitem'=> str_replace(",","",$value['Persendisc']),
                    'discountperitem'=> str_replace(",","",$value['Disc']),
                    'total'=> str_replace(",","",$value['Total']),
                    'biayapenalti'=> str_replace(",","",$value['BiayaPenalti']),
                );   
                $this->returpenerimaan_sparepart_model->savedetail($data);            
            }

            $data = array(
                'noreferensi' => $nomor,
                'jenistransaksi' => '53',
                'tgltransaksi' => date("Y-m-d H:i:s"),
                'tgljttempo' => date("Y-m-d H:i:s"),
                'nomor_customer'=> $this->input->post('kodesupplier'),
                'nilaipiutang' => str_replace(",","",$this->input->post('grandtotal')),
                'nilaipenerimaan' => 0,
                'nilaiuangmuka' => 0,
                'kode_cabang' => $kodecabang,
                'kodesubcabang' => $kodesubcabang,
                'kodecompany' => $kodecompany,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin

            );
            $this->returpenerimaan_sparepart_model->piutang($data);
            
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
        }
    }

    function caridatafind(){  

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


    function caridatapenerimaan(){  

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
                        $sub_array[] = '<button class="btn btn-success searchokbro" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
}
