<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/parts_model");
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function update()
    {
        $errorvalidasi = FALSE;
    
        $userlogin = $this->session->userdata('myusername');
        $kode = $this->input->post('kode');

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $data = array(
                'nama' => $this->input->post('nama'),
                'satuan' => $this->input->post('satuan'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'kategori' => $this->input->post('jenis'),
                'kategorips' => $this->input->post('kategoripart'),
                'pemakai' => $userlogin,
                'hargabeli' => str_replace(",","",$this->input->post('hargabeli')),
                'hargajual' => str_replace(",","",$this->input->post('hargajual')),
                'kodecabang' => $this->input->post('kode_cabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'lokasi' => $this->input->post('lokasi'),
                'minstock' => $this->input->post('minstock'),
                'keterangan' => $this->input->post('keterangan')
            );
            $this->parts_model->update($data,$this->input->post('kode'), $this->input->post('kode_cabang'),$this->input->post('kodecompany'));

            // $cek = $this->parts_model->GetDataPart($this->input->post('kode'),$this->input->post('kode_cabang'),$this->input->post('kodecompany'));
            // if (empty($cek)) {
            //     $data = array(
            //         'kodepart' => $this->input->post('kode'),
            //         'hargabeli' => str_replace(",","",$this->input->post('hargabeli')),
            //         'hargajual' => str_replace(",","",$this->input->post('hargajual')),
            //         'kodecabang' => $this->input->post('kode_cabang'),
            //         'kodecompany' => $this->input->post('kodecompany'),
            //         'lokasi' => $this->input->post('lokasi')
            //     );
            //     $this->parts_model->savedetail($data);
            // }else{
            //     $data = array(
            //         'kodepart' => $this->input->post('kode'),
            //         'hargabeli' => str_replace(",","",$this->input->post('hargabeli')),
            //         'hargajual' => str_replace(",","",$this->input->post('hargajual')),
            //         'kodecabang' => $this->input->post('kode_cabang'),
            //         'kodecompany' => $this->input->post('kodecompany'),
            //         'lokasi' => $this->input->post('lokasi')
            //     );
            //     $this->parts_model->updatedetail($data,$this->input->post('kode'),$this->input->post('kode_cabang'),$this->input->post('kodecompany'));
            // }
            
            
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
                    'nomor' => $kode,
                    'message' => "Data berhasil di perbarui"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }   
            echo json_encode($resultjson);
        }
    }
    public function find()
    {           
            $data = $this->parts_model->get($this->input->post('kode'),$this->input->post('kode_cabang'),$this->input->post('kodecompany'));
            echo json_encode($data);
    }
    public function GetDataPart()
    {
            $data = $this->parts_model->GetDataPart($this->input->post('kodepart'),$this->input->post('kode_cabang'),$this->input->post('kodecompany'));
            echo json_encode($data);
    }
    public function GetDataStock()
    {
            $periode = date("Y").date("m");
            $data = $this->parts_model->GetDataStock($this->input->post('kodepart'),$this->input->post('kode_cabang'),$this->input->post('kodecompany'),$periode);
            echo json_encode($data);
    }
    
    function getminstock()
    {
        $cabang = $this->session->userdata('mycabang');
        $data = $this->parts_model->getminstock($this->input->post('kodepart'),$cabang);
        echo json_encode($data);
    }

    public function save()
    {
        $errorvalidasi = FALSE;
    
        $userlogin = $this->session->userdata('myusername');
        $kode = $this->input->post('kode');

		$cek = $this->parts_model->get($this->input->post('kode'),$this->input->post('kode_cabang'),$this->input->post('kodecompany')); 
        if (!empty($cek)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal disimpan, Kode " . $$this->input->post('kode') . " Sudah Pernah ada"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            $data = array(
                'kode' => str_replace(" ","",$this->input->post('kode')),
                'nama' => $this->input->post('nama'),
                'satuan' => $this->input->post('satuan'),
                'aktif' => $this->input->post('aktif'),
                'tglsimpan' => date("Y-m-d H:i:s"),
                'kategori' => $this->input->post('jenis'),
                'kategorips' => $this->input->post('kategoripart'),
                'pemakai' => $userlogin,
                'hargabeli' => str_replace(",","",$this->input->post('hargabeli')),
                'hargajual' => str_replace(",","",$this->input->post('hargajual')),
                'kodecabang' => $this->input->post('kode_cabang'),
                'kodecompany' => $this->input->post('kodecompany'),
                'lokasi' => $this->input->post('lokasi'),
                'minstock' => $this->input->post('minstock'),
                'keterangan' => $this->input->post('keterangan')
            );
            $this->parts_model->save($data);

            // $data = array(
            //     'kodepart' => $this->input->post('kode'),
            //     'hargabeli' => str_replace(",","",$this->input->post('hargabeli')),
            //     'hargajual' => str_replace(",","",$this->input->post('hargajual')),
            //     'kodecabang' => $this->input->post('kode_cabang'),
            //     'kodecompany' => $this->input->post('kodecompany'),
            //     'lokasi' => $this->input->post('lokasi')
            // );
            // $this->parts_model->savedetail($data);

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
                    'nomor' => $kode,
                    'message' => "Data berhasil disimpan"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }   
            echo json_encode($resultjson);
        }
    }

    
    function finddata()
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
                        $sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
            "draw"                =>     intval($_POST["draw"]),
            "recordsTotal"        =>     $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"                =>     $data
        );
        echo json_encode($output);
    }
}
