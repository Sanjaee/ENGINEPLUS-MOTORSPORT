<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bag_sparepart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/bag_sparepart_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
	}

    
	public function getdatasparepart()
	{
		$result =  $this->bag_sparepart_model->getdatasparepart($this->input->post('kode'),$this->input->post('kode_cabang'),$this->input->post('kodecompany'));
		echo json_encode($result);
    }

    public function caristockpart()
	{
		$result =  $this->bag_sparepart_model->caristockpart($this->input->post('kode'),$this->input->post('kode_cabang'),$this->input->post('kodesubcabang'),$this->input->post('kodecompany'),date("Y").date("m"));
        echo json_encode($result);
       
    }

    
    function cancel()
    {

        //$result = $this->bag_sparepart_model->cekdp($this->input->post('nomor'));
        $userlogin = $this->session->userdata('myusername');
        // if (!$result){
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->bag_sparepart_model->canceltransaksi($data,$this->input->post('nomor'));
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            // $this->bag_sparepart_model->canceldashboard($data,$this->input->post('nomor'));
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
        // }
        // else{
        //     // foreach ($result as $key => $value) {
        //     //    $resultdb = $value->nomor;
        //     //    $resultfkt = $value->approve;
        //     // }
        //     // if($resultfkt =="t"){
        //     //     $resultjson = array(
        //     //         'error' => true,
        //     //         'message' => "Data gagal dibatalkan, Booking sudah diapprove");
        //     // }else{
        //         $resultjson = array(
        //             'error' => true,
        //             'message' => "Data gagal dibatalkan, Customer sudah melakukan DP");
        //     // }
        // }
        
        echo json_encode($resultjson);
    }
    function find()
    {
            $data = $this->bag_sparepart_model->getdatafind($this->input->post('nomor'));
            echo json_encode($data);
    }

    function finddetail()
    {
            $data = $this->bag_sparepart_model->getdatafinddetail($this->input->post('nomor'));
            echo json_encode($data);
    }

    function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $jenis = $this->input->post('jenis');
        $errorvalidasi = FALSE;
        $periode = date("Y").date("m");
        $kodecabang = $this->input->post('kodecabang');
        if ($jenis == 2) {
            foreach ($this->input->post('detail') as $key => $value) {
                //-----------check jika stock kurang maka batal tidak bisa
                $cek = $this->bag_sparepart_model->checkstock($value['Kode'], $periode, $value['Qty'], $kodecabang,$this->input->post('kodesubcabang'),$this->input->post('kodecompany'));
                // print_r($cek);
                // die();
                if (empty($cek)) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal dibatalkan, Data Stock " . $value['Kode'] . "  tidak mencukupi");
                        $errorvalidasi = TRUE;
                        echo json_encode($resultjson);
                        return FALSE;
                }
            }  
        }
        
        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $ambilnomor = "BA".substr(date("Y"), 2, 2).date("m");
            $get["bag"] = $this->bag_sparepart_model->getMaxNomor($ambilnomor); 
            if (!$get["bag"]->nomor){
                $nomor = $ambilnomor."00001";
            }
            else{
                $lastNomor = $get['bag']->nomor;
                $lastNoUrut = substr($lastNomor, 6, 11); 
    
                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor.sprintf('%05s', $nextNoUrut);
            }
            foreach ($this->input->post('detail') as $key => $value) {
                // foreach ($val_dt_detail as $key => $value) {
                    $data = array(
                        'nomorbag' => $nomor,
                        'kodepart' => $value['Kode'],
                        'qty'=> str_replace(",","",$value['Qty']),
                        'cogs'=> str_replace(",","",$value['Harga']),
                    );   
                    $this->bag_sparepart_model->savedetail($data);
            }

            
            $data = array(
                'nomor' => $nomor,
                'tanggal' => date("Y-m-d H:i:s"),
                'jenis' => $this->input->post('jenis'),
                'keterangan' => $this->input->post('keterangan'),
                'kode_cabang'=> $this->input->post('kodecabang'),
                'kodesubcabang'=> $this->input->post('kodesubcabang'),
                'kodecompany'=> $this->input->post('kodecompany'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->bag_sparepart_model->saveheader($data);

            if ($jenis == 1) {
                foreach ($this->input->post('detail') as $key => $value) {
                    //-----------check jika tidak ada maka stock insert
                    $ceksp = $this->bag_sparepart_model->checkdatastock($value['Kode'], $periode, $kodecabang,$this->input->post('kodesubcabang'),$this->input->post('kodecompany'));
                        
                    if (!empty($ceksp)) {
                        $this->bag_sparepart_model->updatestock($value['Kode'], $value['Qty'], $periode, $kodecabang,$this->input->post('kodesubcabang'),$this->input->post('kodecompany'), FALSE);
                    }else{
                        $stock = array(
                            'periode' => $periode,
                            'kodepart' => $value['Kode'],
                            'qtymasuk' => $value['Qty'],
                            'kode_cabang' => $kodecabang,
                            'kodesubcabang'=> $this->input->post('kodesubcabang'),
                            'kodecompany'=> $this->input->post('kodecompany'),
                        );
                        $this->bag_sparepart_model->insertstock($stock);
                    }
                }
            } else {
                foreach ($this->input->post('detail') as $key => $value) {
                    //-------jiga BAG Out Mengurangi stock   
                        $this->bag_sparepart_model->updatestock($value['Kode'], $value['Qty'], $periode, $kodecabang, $this->input->post('kodesubcabang'),$this->input->post('kodecompany'), TRUE);
                }
            }
            
            
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
}

?>