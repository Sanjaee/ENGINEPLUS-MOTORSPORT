<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_sparepart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('sparepart/transfer_sparepart_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
	}
    
	public function getdatasparepart()
	{
		$result =  $this->transfer_sparepart_model->getdatasparepart($this->input->post('kode'));
		echo json_encode($result);
    }
    
    public function getdatacogssparepart()
    {
        $result =  $this->transfer_sparepart_model->getdatacogssparepart($this->input->post('kode'), $this->input->post('kode_cabang'), $this->input->post('kodesubcabang'), $this->input->post('kodecompany'));
        echo json_encode($result);
    }

    public function getordering()
	{   
		$result =  $this->transfer_sparepart_model->getordering($this->input->post('nomororder'));
		echo json_encode($result);
    }

    
    function find()
    {
            $data = $this->transfer_sparepart_model->getdatafind($this->input->post('nomor'));
            echo json_encode($data);
    }

    function finddetail()
    {
            $data = $this->transfer_sparepart_model->getdatafinddetail($this->input->post('nomor'));
            echo json_encode($data);
    }

    function findpenerimaan()
    {
            $data = $this->transfer_sparepart_model->findpenerimaan($this->input->post('nomor'));
            echo json_encode($data);
    }

    function findpenerimaandetail()
    {
            $data = $this->transfer_sparepart_model->findpenerimaandetail($this->input->post('nomor'));
            echo json_encode($data);
    }
    
    function cancel()
    {

        $errorvalidasi = FALSE;
        $kodecabang = $this->input->post('kode_cabang');
        $kodecabangorder = $this->input->post('kode_cabangorder');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        // print_r($kodecabang);         
        // die();
        $userlogin = $this->session->userdata('myusername');
        $periode = date("Y").date("m");
        // foreach ($this->input->post('datadetail') as $key => $value) {
        //     $cek = $this->transfer_sparepart_model->checkstock($value['Kode'], $periode, $value['QtyTF'], $kodecabangorder);
        //     //   print_r($cek);
        //     //   die();
        //     if (empty($cek)) {
        //         $resultjson = array(
        //             'nomor' => "",
        //             'error' => true,
        //             'message' => "Data Stock " . $value['Kode'] . "  tidak mencukupi");
        //             $errorvalidasi = TRUE;
        //             echo json_encode($resultjson);
        //             return FALSE;
        //     };
        // }

        $cek = $this->transfer_sparepart_model->checkpenerimaan($this->input->post('nomor'));
            //   print_r($cek);
            //   die();
            if (!empty($cek)) {
                $resultjson = array(
                    'nomor' => "",
                    'error' => true,
                    'message' => "Data Transfer Sudah dilakukan Penerimaan Sparepart di Cabang");
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
            $this->transfer_sparepart_model->canceltransaksi($data,$this->input->post('nomor'));
            
            foreach ($this->input->post('datadetail') as $key => $value) {
                
                //Mengurangi Qty Masuk Cabang
                $this->transfer_sparepart_model->updatestockbatal($value['Kode'], $value['QtyTF'], $periode, $kodecabangorder, $kodesubcabang, $kodecompany, TRUE);
                
                //Menambah Stock HO dan mengurangi Qty Kirim
                $this->transfer_sparepart_model->updatestockbatal($value['Kode'], $value['QtyTF'], $periode, $kodecabang, $kodesubcabang, $kodecompany, FALSE);

                //update ke request cabang
                $this->transfer_sparepart_model->updateordering($value['QtyTF'],$this->input->post('nomorrequest'),$value['Kode'],TRUE);
            }
            //balikan status close di order/request
            $this->transfer_sparepart_model->updateorder($this->input->post('nomorrequest'),TRUE);
            

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


    function save()
    {
        
        $errorvalidasi = FALSE;
        $kodecabang = $this->input->post('kode_cabang');
        $kodecabangorder = $this->input->post('kode_cabangorder');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $kodecompany = $this->input->post('kodecompany');
        $userlogin = $this->session->userdata('myusername');
        $periode = date("Y").date("m");
        foreach ($this->input->post('detail') as $key => $value) {
            $cek = $this->transfer_sparepart_model->checkstock($value['Kode'], $periode, $value['QtyTF'], $kodecabang ,$kodesubcabang, $kodecompany );
            //   print_r($value);
            //   die();
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
            $ambilnomor = "TS".substr(date("Y"), 2, 2).date("m");
            $get["penerimaan"] = $this->transfer_sparepart_model->getMaxNomor($ambilnomor); 
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
            foreach ($this->input->post('detail') as $key => $value) {
                $data = array(
                    'nomortransfer' => $nomor,
                    'kodepart' => $value['Kode'],
                    'qty'=> str_replace(",","",$value['QtyTF']),
                    'hargabeli'=> str_replace(",","",$value['Hargabeli']),
                    'cogs'=> str_replace(",","",$value['COGS'])
                );   
                $this->transfer_sparepart_model->savedetail($data);
                
            }
            
            foreach ($this->input->post('detail') as $key => $value) {
                //Menambah qty terima Cabang
                $ceksp = $this->transfer_sparepart_model->checkdatapart($value['Kode'], $periode, $kodecabangorder , $kodesubcabang, $kodecompany );
                if (!empty($ceksp)) {
                    $this->transfer_sparepart_model->updatestock($value['Kode'], $value['QtyTF'], $periode, $kodecabangorder,  $kodesubcabang, $kodecompany, FALSE);
                }else{
                    $stock = array(
                        'periode' => $periode,
                        'kode_cabang' => $kodecabangorder,
                        'kodepart' => $value['Kode'],
                        'qtyterima' => $value['QtyTF'],
                        'kodesubcabang' => $kodesubcabang,
                        'kodecompany' => $kodecompany,
                    );
                    $this->transfer_sparepart_model->insertstock($stock);
                }
                //Mengurangi Stock HO dan menambah Qty Kirim
                $this->transfer_sparepart_model->updatestock($value['Kode'], $value['QtyTF'], $periode, $kodecabang, $kodesubcabang, $kodecompany, TRUE);

                //update ke request cabang
                $this->transfer_sparepart_model->updateordering($value['QtyTF'],$this->input->post('nomorrequest'),$value['Kode'],FALSE);
            }

            $data = array(
                'nomor' => $nomor,
                'tanggal' => date("Y-m-d H:i:s"),
                'nomororder'=> $this->input->post('nomorrequest'),
                'keterangan' => $this->input->post('keterangan'),
                'kode_cabangorder' => $this->input->post('kode_cabangorder'),
                'kode_cabang'=> $kodecabang,
                'kodesubcabang' => $kodesubcabang,
                'kodecompany' => $kodecompany,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->transfer_sparepart_model->saveheader($data);

            //jika qty = qtygr status order close
            $cekorder = $this->transfer_sparepart_model->checkorder($this->input->post('nomorrequest'));
                if (!empty($cekorder)) {
                    foreach ($cekorder as $key => $value) {
                        if ($value->qty == $value->qtygr) {
                        $this->transfer_sparepart_model->updateorder($this->input->post('nomorrequest'),FALSE);
                        }
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