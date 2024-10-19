<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembatalan_spk extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('spk/pembatalan_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
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
                        $sub_array[] = '<button class="btn btn-success searchspk" data-id="'.$msearch.'"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';  
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

    function CariDataMemo(){  

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

    function GetDataMemo()
    {
        $data = $this->pembatalan_model->GetMemo($this->input->post('nomor'));
        echo json_encode($data);
    }

    public function GetDataSPK()
	{
		$result =  $this->pembatalan_model->GetSPK($this->input->post('nomorspk'));
		echo json_encode($result);
    }

    function GetSPKDetail()
    {
            $data = $this->pembatalan_model->GetDataSPKDetail($this->input->post('nomor'));
            echo json_encode($data);
    }

    public function GetDataCustomer()
	{
		$result =  $this->pembatalan_model->GetCustomer($this->input->post('nocustomer'));
		echo json_encode($result);
    }

    public function GetDataTipe()
	{
		$result =  $this->pembatalan_model->GetTipe($this->input->post('kode_tipe'));
		echo json_encode($result);
    }

    function Save()
    {
        
        $errorvalidasi = FALSE;
        $nomorspk = $this->input->post('nomorspk');

        $cekwo = $this->pembatalan_model->CekPembebanan($nomorspk);
        if (!empty($cekwo)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Nomor " . $nomorspk . " Masih ada pembebanan Spareparts"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };
        //$result = $this->pembatalan_model->CekPembebanan($this->input->post('nomorspk'));

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $userlogin = $this->session->userdata('myusername');
            $ambilnomor = "MP".substr(date("Y"), 2, 2).date("m");
            $get["MP"] = $this->pembatalan_model->GetMaxNomor($ambilnomor); 
            if (!$get["MP"]->nomor)
            {
                $nomor = $ambilnomor."00001";
            }
            else
            {
                $lastNomor = $get['MP']->nomor;
                $lastNoUrut = substr($lastNomor, 6, 11); 
 
                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor = $ambilnomor.sprintf('%05s', $nextNoUrut);
            }
            $data = array(
                'nomor' => $nomor,
                'nospk' => $this->input->post('nomorspk'),
                'tanggal' => date("Y-m-d H:i:s"),
                'alasanpembatalan' => $this->input->post('alasanpembatalan'),
                'kode_cabang' => $this->input->post('kodecabang'),
                'kodesubcabang' => $this->input->post('kodesubcabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->pembatalan_model->SaveHeader($data);

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
            //echo json_encode($resultjson);

            echo json_encode($resultjson);
            return FALSE;
        }
    }

    function Cancel()
    {
        $errorvalidasi = FALSE;
        $nomorspk = $this->input->post('nomorspk');
        $userlogin = $this->session->userdata('myusername');
        $cekstatus = $this->pembatalan_model->checkstatuswo($nomorspk);
        if (!empty($cekstatus)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal dibatalkan, Nomor " . $nomorspk . " SPK dibatalkan"
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
            $this->pembatalan_model->CancelTransaksi($data,$this->input->post('nomor'));
            
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
}
?>