<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('spk/booking_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
		$this->load->library('form_validation');
        $this->load->library('session');
    }


    public function GetDataNopol()
	{
		$result =  $this->booking_model->GetNopolisi($this->input->post('nopolisi'));
		echo json_encode($result);
    }
    public function GetDataCustomer()
	{
		$result =  $this->booking_model->GetCustomer($this->input->post('nocustomer'));
		echo json_encode($result);
    }
    public function GetDataParts()
	{
		$result =  $this->booking_model->GetParts($this->input->post('kode'), $this->input->post('kode_cabang'),$this->input->post('kodecompany'));
		echo json_encode($result);
    }
    public function GetDataTask()
	{
		$result =  $this->booking_model->GetTask($this->input->post('kode'),$this->input->post('model'));
		echo json_encode($result);
    }
    public function GetDataTipe()
	{
		$result =  $this->booking_model->GetTipe($this->input->post('kode_tipe'));
		echo json_encode($result);
    }
    function find()
    {
        $data = $this->booking_model->GetDataFind($this->input->post('nomor'));
        echo json_encode($data);
    }
    function FindDetail()
    {
        $data = $this->booking_model->GetDataFindDetail($this->input->post('nomor'));
        echo json_encode($data);
    }

    public function Getregularcheck()
	{
		$result =  $this->booking_model->Getregularcheck($this->input->post('kode'));
		echo json_encode($result);
    }

    public function GetDataRegularDetail()
	{
		$result =  $this->booking_model->GetDataRegularDetail($this->input->post('kode'), $this->input->post('kodemodel'));
		echo json_encode($result);
    }


    function CariDataNopol(){  

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
                        $sub_array[] = '<button class="btn btn-success searchsn" data-id="'.$msearch.'"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
        // $fetch_data = $this->caridata2_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'));  

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
        //                 $sub_array[] = '<button class="btn btn-success searchsn" data-id="'.$msearch.'"   data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
        //     "draw"                    =>     intval($_POST["draw"]),  
        //     "recordsTotal"          =>      $this->caridata2_model->get_all_data($this->input->post('nmtb')),  
        //     "recordsFiltered"     =>     $this->caridata2_model->get_filtered_data($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where')),  
        //     "data"                    =>     $data  
        // );  
        // echo json_encode($output);  
    }
    function CariDataTipe(){  

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
                        $sub_array[] = '<button class="btn btn-success searchtipe" data-id="'.$msearch.'"   data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
    function CariDataCustomer(){  

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
                        $sub_array[] = '<button class="btn btn-success searchcustomer" data-id="'.$msearch.'"   data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
    function CariDataTeknisi(){  

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
                        $sub_array[] = '<button class="btn btn-success searchteknisi" data-id="'.$msearch.'"   data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
    function CariDataParts(){  

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
                        $sub_array[] = '<button class="btn btn-success searchparts" data-id="'.$msearch.'"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
    function CariDataTask(){  

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
                        $sub_array[] = '<button class="btn btn-success searchtask" data-id="'.$msearch.'"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
    function CariDataFind(){  

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
                        $sub_array[] = '<button class="btn btn-success searchok" data-id="'.$msearch.'"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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

    function Cariregularcheck(){  

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
                        $sub_array[] = '<button class="btn btn-success searchrc" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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



    function Save()
    {
        $kodecabang = $this->input->post('kodecabang');
        $userlogin = $this->session->userdata('myusername');
        
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $ambilnomor = "BKS-". $kodecabang . "-" . substr(date("Y"), 2, 2).date("m");
        $get["nomor"] = $this->booking_model->GetMaxNomor($ambilnomor); 
    
        if (!$get["nomor"]->nomor){
            $nomor = $ambilnomor."00001";
        }
        else{
            $lastNomor = $get['nomor']->nomor;
            
            $lastNoUrut = substr($lastNomor, 12, 17); 

            // nomor urut ditambah 1
            $nextNoUrut = $lastNoUrut + 1;
            $nomor = $ambilnomor.sprintf('%05s', $nextNoUrut);
        }
        if (!empty($this->input->post('detailspk'))){
            foreach ($this->input->post('detailspk') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                    $data = array(
                        'nomorbooking' => $nomor,
                        'jenis' => $value['Jenis'],
                        'kodereferensi' => $value['Kode'],
                        'kategori' => $value['Kategori'],
                        'namareferensi' => $value['Nama'],
                        'qty'=> str_replace(",","",$value['Qty']),
                        'harga'=> str_replace(",","",$value['Harga']),
                        'subtotal'=> str_replace(",","",$value['Subtotal']),
                    );
                    $this->booking_model->SaveDetail($data);
            }
        }

        $data = array(
            'nomor' => $nomor,
            'nopolisi' => $this->input->post('nopolisi'),
            'nomor_customer'=> $this->input->post('nomorcustomer'),
            'nama_customer'=> $this->input->post('namacustomer'),
            'returnjob'=> $this->input->post('returnjob'),
            'jenisservice'=> $this->input->post('jenisservice'),
            'tanggalbooking' => $this->input->post('tanggal'),
            'pic'=> $this->input->post('pic'),
            'nohppic'=> $this->input->post('nohppic'),
            'dpp'=> str_replace(",","",$this->input->post('dpp')),
            'ppn'=> str_replace(",","",$this->input->post('ppn')),
            'grandtotal'=> str_replace(",","",$this->input->post('grandtotal')),
            'keluhan'=> $this->input->post('keluhan'),
            'totalpart'=> str_replace(",","",$this->input->post('totalpart')),
            'totaljasa'=> str_replace(",","",$this->input->post('totaljasa')),
            'inventaris'=> $this->input->post('inventaris'),
            'kode_cabang'=> $this->input->post('kodecabang'),
            'kodetipe'=> $this->input->post('kodetipe'),
            'namatipe'=> $this->input->post('namatipe'),
            'model'=> $this->input->post('model'),
            'kode_regularcheck'=> $this->input->post('koderegular'),
            'nama_regularcheck'=> $this->input->post('namaregular'),
            'kodesubcabang'=> $this->input->post('kodesubcabang'),
            'kodecompany'=> $this->input->post('kodecompany'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->booking_model->SaveHeader($data);

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
    

    public function Update()
	{
        $nomor = $this->input->post('nomor');
        $this->booking_model->DeleteDetail($nomor);
        if (!empty($this->input->post('detailspk'))){
            foreach ($this->input->post('detailspk') as $key => $value) {
                $data = array(
                    'nomorbooking' => $nomor,
                    'kodereferensi' => $value['Kode'],
                    'kategori' => $value['Kategori'],
                    'namareferensi' => $value['Nama'],
                    'jenis' => $value['Jenis'],
                    'qty'=> str_replace(",","",$value['Qty']),
                    'harga'=> str_replace(",","",$value['Harga']),
                    'subtotal'=> str_replace(",","",$value['Subtotal']),
                );
                $this->booking_model->SaveDetail($data);
            }
        }
        $data = array(
            'returnjob' => $this->input->post('returnjob'),
            'tanggalbooking' => $this->input->post('tanggalbooking'),
            'dpp'=> str_replace(",","",$this->input->post('dpp')),
            'ppn'=> str_replace(",","",$this->input->post('ppn')),
            'grandtotal'=> str_replace(",","",$this->input->post('grandtotal')),
            'totalpart'=> str_replace(",","",$this->input->post('totalpart')),
            'totaljasa'=> str_replace(",","",$this->input->post('totaljasa')),
            'inventaris'=> $this->input->post('inventaris'),
            'kode_regularcheck'=> $this->input->post('koderegular'),
            'nama_regularcheck'=> $this->input->post('namaregular')
        );
        $result =  $this->booking_model->UpdateHeader($data,$nomor);

        if($result == 1) {
            $resultjson = array(
                'error' => false,
                'message' => "Data berhasil diubah");
        }
        else{
            $resultjson = array(
                'error' => false,
                'message' => "Data berhasil gagal diubah");
        }
		echo json_encode($resultjson);
    }

    function Cancel()
    {
        $errorvalidasi = FALSE;
        $nomorspk = $this->input->post('nomor');
        $userlogin = $this->session->userdata('myusername');

        $cekstatus = $this->booking_model->checkstatuswo($nomorspk);
        if (!empty($cekstatus)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomorspk . " Dibuatkan WO"
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
            $this->booking_model->CancelTransaksi($data,$this->input->post('nomor'));
            
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

    function historyspk(){  

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
                        //$sub_array[] = '<button class="btn btn-success searchok" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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
?>