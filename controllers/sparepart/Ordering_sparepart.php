<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordering_sparepart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/ordering_sparepart_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
	}

    public function getdatasupplier()
	{
		$result =  $this->ordering_sparepart_model->getdatasupplier($this->input->post('nomor'));
		echo json_encode($result);
    }
    
	public function getdatasparepart()
	{
		$result =  $this->ordering_sparepart_model->getdatasparepart($this->input->post('kode'),$this->input->post('kode_cabang'),$this->input->post('kodecompany'));
		echo json_encode($result);
    }

    public function getdatacabang()
	{
		$result =  $this->ordering_sparepart_model->getdatacabang($this->input->post('kode'));
		echo json_encode($result);
    }
    
    function cancel()
    {   
        $errorvalidasi = FALSE;
        $userlogin = $this->session->userdata('myusername');
        $cek = $this->ordering_sparepart_model->checkpenerimaan($this->input->post('nomor'));
            if (!empty($cek)) {
                $resultjson = array(
                    'nomor' => "",
                    'error' => true,
                    'message' => "Gagal dibatalkan, Data " . $this->input->post('nomor') . " sudah penerimaan!");
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
            };
        
        $uangmuka = $this->ordering_sparepart_model->checkuangmuka($this->input->post('nomor'));
            if (!empty($uangmuka)) {
                $resultjson = array(
                    'nomor' => "",
                    'error' => true,
                    'message' => "Gagal dibatalkan, Data " . $this->input->post('nomor') . " sudah pernah bayar uang muka!");
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
            };
        
        $cduangmuka = $this->ordering_sparepart_model->checkcduangmuka($this->input->post('nomor'));
            if (!empty($cduangmuka)) {
                $resultjson = array(
                    'nomor' => "",
                    'error' => true,
                    'message' => "Gagal dibatalkan, Data " . $this->input->post('nomor') . " sudah pernah dibuatkan permohonan uang muka!");
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
            $this->ordering_sparepart_model->canceltransaksi($data,$this->input->post('nomor'));

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
            $data = $this->ordering_sparepart_model->getdatafind($this->input->post('nomor'));
            echo json_encode($data);
    }

    function finddetail()
    {
            $data = $this->ordering_sparepart_model->getdatafinddetail($this->input->post('nomor'));
            echo json_encode($data);
    }

    function save()
    {
        // print_r($this->input->post('detail'));         
        // die();
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);
        $userlogin = $this->session->userdata('myusername');
        $kodecabang = $this->input->post('kodecabang');
        $ambilnomor = "PO".substr(date("Y"), 2, 2).date("m");
        $get["booking"] = $this->ordering_sparepart_model->getMaxNomor($ambilnomor); 
		if (!$get["booking"]->nomor){
            $nomor = $ambilnomor."00001";
        }
        else{
            $lastNomor = $get['booking']->nomor;
            $lastNoUrut = substr($lastNomor, 6, 11); 
 
            // nomor urut ditambah 1
            $nextNoUrut = $lastNoUrut + 1;
            $nomor = $ambilnomor.sprintf('%05s', $nextNoUrut);
        }
        foreach ($this->input->post('detail') as $key => $value) {
            // foreach ($val_dt_detail as $key => $value) {
                $data = array(
                    'nomororder' => $nomor,
                    'kodepart' => $value['Kode'],
                    'qty'=> str_replace(",","",$value['Qty']),
                    'harga'=> str_replace(",","",$value['Harga']),
                    'total'=> str_replace(",","",$value['Total']),
                );   
                $this->ordering_sparepart_model->savedetail($data);
        }

        
        $data = array(
            'nomor' => $nomor,
            'tanggal' => date("Y-m-d H:i:s"),
            'kodesupplier' => $this->input->post('kodesupplier'),
            'namasupplier'=> $this->input->post('namasupplier'),
            'alamatsupplier'=> $this->input->post('alamat'),
            'dpp'=> str_replace(",","",$this->input->post('dpp')),
            'ppn'=> str_replace(",","",$this->input->post('ppn')),
            'total'=> str_replace(",","",$this->input->post('grandtotal')),
            'kode_cabang'=> $kodecabang,         
            'kodesubcabang' => $this->input->post('kodesubcabang'),
            'kodecompany' => $this->input->post('kodecompany'),
            'keterangan' => $this->input->post('keterangan'),
            'jenis' => $this->input->post('jenis'),
            'nomorestimasi' => $this->input->post('nomorestimasi'),            
            'statusorder' => $this->input->post('statusorder'),
            'tglrealorder' => $this->input->post('tglrealorder'),
            'tglestimasidtng' => $this->input->post('tanggalestimasidtng'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->ordering_sparepart_model->saveheader($data);

        
        $data = array(
            'nomororder' => $nomor,
            'status' => $this->input->post('statusorder'),
            'tglrealorder' => $this->input->post('tglrealorder'),
            'tglestimasidtng' => $this->input->post('tanggalestimasidtng'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $this->ordering_sparepart_model->inserthistoryorder($data);

        
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

    function update()
    {   
        $errorvalidasi = FALSE;
        $userlogin = $this->session->userdata('myusername');
        
        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $data = array(
                'statusorder' => $this->input->post('statusorder'),
                'tglrealorder' => $this->input->post('tglrealorder'),
                'tglestimasidtng' => $this->input->post('tanggalestimasidtng')
            );
            $this->ordering_sparepart_model->updatetransaksi($data,$this->input->post('nomor'));

            $data = array(
                'nomororder' => $this->input->post('nomor'),
                'status' => $this->input->post('statusorder'),
                'tglrealorder' => $this->input->post('tglrealorder'),
                'tglestimasidtng' => $this->input->post('tanggalestimasidtng'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->ordering_sparepart_model->inserthistoryorder($data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'error' => true,
                    'message' => "Data gagal diupdate");
                # Something went wrong.
                $this->db->trans_rollback();
            } 
            else {
                $resultjson = array(
                    'error' => false,
                    'message' => "Data berhasil diupdate"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }               
            echo json_encode($resultjson);
            return FALSE;
        }
    }

	function caridatasupplier(){  

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
                        // $sub_array[] = '<button class="btn1 btn-pilih searchtujuan" data-id="'.$msearch.'"><i class="fas fa-hand-o-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchsupplier" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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

    function caridataestimasi(){  

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
                        // $sub_array[] = '<button class="btn1 btn-pilih searchtujuan" data-id="'.$msearch.'"><i class="fas fa-hand-o-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searcheo" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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

    function caridatasparepart(){  

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
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchrangka" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchsparepart" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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

    function caridatacabang(){  

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
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchrangka" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchcabang" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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
    
    function caridataref()
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
                        $sub_array[] = '<button class="btn btn-success searchref" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function getdataestimasi()
    {
            $data = $this->ordering_sparepart_model->getdataestimasi($this->input->post('nomor'));
            echo json_encode($data);
    }

    function getminstock()
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

}

?>