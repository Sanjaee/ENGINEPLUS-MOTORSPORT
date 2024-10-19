<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/customer_model");
        $this->load->library('form_validation');
        $this->load->library('session');
        
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
    }

    public function update()
    {
        $userlogin = $this->session->userdata('myusername');
        $data = array(
            'title'=> $this->input->post('titlecustomer'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nohp' => $this->input->post('nohp'),
            'notlp' => $this->input->post('notlp'),
            'email' => $this->input->post('email'),
            'kode' => $this->input->post('kode'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kota' => $this->input->post('kota'),
            'provinsi' => $this->input->post('provinsi'),
            'kodepos' => $this->input->post('kodepos'),
            'top' => $this->input->post('top'),
            'kreditlimit' => $this->input->post('kreditlimit'),
            'pkp' => $this->input->post('pkp'),
            'npwp' => $this->input->post('npwp'),
            'namanpwp' => $this->input->post('namanpwp'),
            'alamatnpwp' => $this->input->post('alamatnpwp'),
            'kategoricustomer' => $this->input->post('kategoricustomer'),
            'jeniscustomer' => $this->input->post('jeniscustomer'),
            'aktif' => $this->input->post('aktif'),
            'tglsimpan' => date("Y-m-d H:i:s"),
            // 'pemakai' => $this->session->userdata('myusername')
            'pemakai' => $userlogin
        );
            $result = $this->customer_model->update($data,$this->input->post('nomor'));
            if($result == true){
                $resultjson = array(
                    'nomor' => $this->input->post('nomor'),
                    'message' => "Data berhasil diubah");
            }
            else{
                $resultjson = array(
                    'nomor' => $this->input->post('nomor'),
                    'message' => "Data gagal diubah, silahkan cek kembali");
            }
            echo json_encode($resultjson);
            // $this->session->set_flashdata('success', 'Berhasil diubah');
    }

    public function find()
    {
        $data = $this->customer_model->get($this->input->post('nomor'));
        echo json_encode($data);
    }

    // public function getKodeKelurahan()
    // {
    //         $data = $this->tipe_model->getKelurahan($this->input->post('kode'));
    //         echo json_encode($data);
    // }

    public function getKelurahan()
    {
            $data = $this->customer_model->getKelurahan($this->input->post('kode'));
            echo json_encode($data);
    }

    public function save()
    {
        $userlogin = $this->session->userdata('myusername');
        $kodecabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');

        $cekdata = $this->customer_model->cekdata($this->input->post('nama'),$this->input->post('nohp'),$kodecabang);
        if (!$cekdata){
            $get["customer"] = $this->customer_model->getMaxNomor("C");    
            // print_r( $get["customer"]);
            // die();
            if (!$get["customer"]){
                $nomor = "C000000001";
            }
            else
            {
                $lastNomor = $get['customer']->nomor;
                $lastNoUrut = substr($lastNomor, 2, 9); 
    
                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $nomor ="C".sprintf('%09s', $nextNoUrut);;
            }
            $data = array(
                'nomor' => $nomor,
                'title'=> $this->input->post('titlecustomer'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'nohp' => $this->input->post('nohp'),
                'notlp' => $this->input->post('notlp'),
                'email' => $this->input->post('email'),
                'kode' => $this->input->post('kode'),
                'kelurahan' => $this->input->post('kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kota' => $this->input->post('kota'),
                'provinsi' => $this->input->post('provinsi'),
                'kodepos' => $this->input->post('kodepos'),
                'top' => $this->input->post('top'),
                'kreditlimit' => $this->input->post('kreditlimit'),
                'pkp' => $this->input->post('pkp'),
                'npwp' => $this->input->post('npwp'),
                'namanpwp' => $this->input->post('namanpwp'),
                'alamatnpwp' => $this->input->post('alamatnpwp'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'kategoricustomer' => $this->input->post('kategoricustomer'),
                'jeniscustomer' => $this->input->post('jeniscustomer'),
                'kode_cabang' => $kodecabang,
                'kodecompany' => $kodecompany,
                // 'pemakai' => $this->session->userdata('myusername')
                'pemakai' => $userlogin
            );
            $result =  $this->customer_model->save($data);
            if($result == true){
                $resultjson = array(
                    'nomor' => $nomor,
                    'message' => "Data berhasil disimpan");
            }
            else{
                $resultjson = array(
                    'nomor' => "",
                    'message' => "Data gagal disimpan, silahkan cek kembali");
            }
        }
        else{
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan, Customer sudah terdaftar dinomor " .$cekdata[0]->nomor);
        }
        echo json_encode($resultjson);
    }

    function caridatakodepos(){  
        // echo "AAA";
        // die();
        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'),$this->input->post('nmtb'),$this->input->post('sort'),$this->input->post('where'),$this->input->post('value'));  
        // print_r($_POST["order"]);
        // print_r($this->input->post('value'));
        
        
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
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchaccount" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
                        $sub_array[] = '<button class="btn btn-success searchkodepos" data-id="'.$msearch.'"><i class="fa fa-hand-o-right"></i></button> ';  
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
