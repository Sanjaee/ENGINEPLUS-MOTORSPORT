<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class faktur extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('faktur/faktur_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
    }

    public function GetDataSPK()
	{
		$result =  $this->FAKTUR_model->GetSPK($this->input->post('nomorspk'));
		echo json_encode($result);
    }
    public function GetDataTipe()
	{
		$result =  $this->FAKTUR_model->GetTipe($this->input->post('kode_tipe'));
		echo json_encode($result);
    }
    public function GetDataProduct()
	{
		$result =  $this->FAKTUR_model->GetProduct($this->input->post('kode'));
		echo json_encode($result);
    }
    public function GetDataCustomer()
	{
		$result =  $this->FAKTUR_model->GetCustomer($this->input->post('nocustomer'));
		echo json_encode($result);
    }
    public function GetDataParts()
	{
		$result =  $this->FAKTUR_model->GetParts($this->input->post('kode'));
		echo json_encode($result);
    }
    public function GetDataTask()
	{
		$result =  $this->FAKTUR_model->GetTask($this->input->post('kode'));
		echo json_encode($result);
    }
    function GetSPKDetail()
    {
            $data = $this->FAKTUR_model->GetDataSPKDetail($this->input->post('nomor'));
            echo json_encode($data);
    }
    function FindFaktur()
    {
            $data = $this->FAKTUR_model->GetDataFind($this->input->post('nomor'));
            echo json_encode($data);
    }
    function FindFakturDetail()
    {
            $data = $this->FAKTUR_model->GetDataFakturDetail($this->input->post('nomor'));
            echo json_encode($data);
    }

    function CariDataSPK(){  

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
                        $sub_array[] = '<button class="btn btn-new searchspk" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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
                        $sub_array[] = '<button class="btn btn-new searchparts" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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
                        $sub_array[] = '<button class="btn btn-new searchtask" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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
                        $sub_array[] = '<button class="btn btn-new searchok" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $ambilnomor = "SF".substr(date("Y"), 2, 2).date("m");
        $get["SPK"] = $this->FAKTUR_model->GetMaxNomor($ambilnomor); 
		if (!$get["SPK"]->nomor){
            $nomor = $ambilnomor."00001";
        }
        else{
            $lastNomor = $get['SPK']->nomor;
            $lastNoUrut = substr($lastNomor, 6, 11); 
 
            // nomor urut ditambah 1
            $nextNoUrut = $lastNoUrut + 1;
            $nomor = $ambilnomor.sprintf('%05s', $nextNoUrut);
        }
        foreach ($this->input->post('detaildatafaktur') as $key => $value) {
            // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'nomorfaktur' => $nomor,
                    'jenis' => $value['Jenis'],
                    'kodereferensi' => $value['Kode'],
                    'namareferensi' => $value['Nama'],
                    'qty'=> str_replace(",","",$value['Qty']),
                    'harga'=> str_replace(",","",$value['Harga']),
                    'persendiscperitem'=> str_replace(",","",$value['Persen']),
                    'discperitem'=> str_replace(",","",$value['Discount']),
                    'subtotal'=> str_replace(",","",$value['Subtotal']),
                );
                $this->FAKTUR_model->SaveDetail($data);
        }

        $data = array(
            'nomor' => $nomor,
            'nosn' => $this->input->post('nosn'),
            'nomor_spk' => $this->input->post('nomorspk'),
            'nomor_customer'=> $this->input->post('nomor_customer'),
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan' => $this->input->post('keterangan'),
            'dpp'=> str_replace(",","",$this->input->post('dpp')),
            'ppn'=> str_replace(",","",$this->input->post('ppn')),
            'grandtotal'=> str_replace(",","",$this->input->post('grandtotal')),
            'kode_teknisi' => $this->input->post('kode_teknisi'),
            
            'kode_cabang' => 'KRW',
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => 'test'
        );
        $this->FAKTUR_model->SaveHeader($data);

        $data = array(
            'noreferensi' => $nomor,
            'jenistransaksi' => 1,
            'tgltransaksi' => date("Y-m-d H:i:s"),
            'tgljttempo' => date("Y-m-d H:i:s"),
            'nomor_customer'=> $this->input->post('nomor_customer'),
            'nilaipiutang' => str_replace(",","",$this->input->post('grandtotal')),
            'nilaipenerimaan' => 0,
            'nilaiuangmuka' => 0,
            'kode_cabang' => 'KRW',
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => 'test'

        );
        $this->FAKTUR_model->SavePiutang($data);

        $data = array(
            'status' => 1
        );
        $this->FAKTUR_model->UpdateStatusFaktur($data,$this->input->post('nomorspk'));


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

    function Cancel()
    {

        $data = array(
            'keteranganbatal' => $this->input->post('alasan'),
            'batal' => true,
            'tglbatal' => date("Y-m-d H:i:s"),
            'userbatal' => 'test Batal'
        );
        $this->FAKTUR_model->CancelFaktur($data,$this->input->post('nomor'));
        
        $data = array(
            'keteranganbatal' => $this->input->post('alasan'),
            'batal' => true,
            'tglbatal' => date("Y-m-d H:i:s"),
            'userbatal' => 'test Batal'
        );
        $this->FAKTUR_model->CancelPiutang($data,$this->input->post('nomor'));

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
    }


    
}
?>