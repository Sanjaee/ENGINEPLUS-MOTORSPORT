<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Entry_jasa_detail extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('spk/entry_jasa_detail_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function getDataWO()
    {
        $result =  $this->entry_jasa_detail_model->getDataWO($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function getDataJasa()
    {
        $result =  $this->entry_jasa_detail_model->getDataJasa($this->input->post('kode'));
        echo json_encode($result);
    }

    public function getDataJasaDetail()
    {
        $result =  $this->entry_jasa_detail_model->getDataJasaDetail($this->input->post('kode'));
        echo json_encode($result);
    }

    public function DataJasaDetail()
    {
        $result =  $this->entry_jasa_detail_model->DataJasaDetail($this->input->post('kode'));
        echo json_encode($result);
    }

    function FindDataEntryJasa()
    {
        $data = $this->entry_jasa_detail_model->FindDataEntryJasa($this->input->post('no_wo'));
        echo json_encode($data);
    }

    function FindDataEntryJasaDetail()
    {
        $data = $this->entry_jasa_detail_model->FindDataEntryJasaDetail($this->input->post('no_wo'));
        echo json_encode($data);
    }

    function CariDataNoWO()
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
                        $sub_array[] = '<button class="btn btn-success searchnomorwo" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataJasa()
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
                        $sub_array[] = '<button class="btn btn-success searchjasa" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function CariDataJasaDetail()
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
                        $sub_array[] = '<button class="btn btn-success searchjasadetail" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function Save()
    {
        $errorvalidasi = FALSE;
        $userlogin = $this->session->userdata('myusername');
        $kode_cabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');
        $kodesubcabang = $this->session->userdata('mysubcabang');
        $no_wo = $this->input->post('no_wo');
        $datadetail = $this->input->post('detailjasa');

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $data = array(
                'no_wo' => $no_wo,
                'nopolisi' => $this->input->post('nopolisi'),
                'nomor_customer' => $this->input->post('nomor_customer'),
                'kode_tipe' => $this->input->post('kode_tipe'),
                'kode_cabang' => $kode_cabang,
                'kodecompany' => $kodecompany,
                'kodesubcabang' => $kodesubcabang,
                'tglsimpan' => date("Y-m-d H:i:s"),
                'pemakai' => $userlogin
            );
            $this->entry_jasa_detail_model->SaveHeader($data);

            foreach ($datadetail as $key => $value) {
                $data = array(
                    'nomor' => $no_wo,
                    'kode_jasahead' => str_replace(",", "", $value['headjasa']),
                    'kode_jasa' => str_replace(",", "", $value['kodedetailjasa']),
                    'nama_jasa' => str_replace(",", "", $value['namadetailjasa']),
                );
                $this->entry_jasa_detail_model->SaveDetail($data);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'nomor' => "",
                    'message' => "Data Gagal Disimpan, Nomor WO Sudah Pernah Digunakan"
                );
                # Something went wrong.
                $this->db->trans_rollback();
            } else {
                $resultjson = array(
                    'nomor' => $no_wo,
                    'message' => "Data Berhasil Disimpan"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }
            echo json_encode($resultjson);
            return FALSE;
        }
    }

    public function Update()
    {
        $userlogin = $this->session->userdata('myusername');
        $kode_cabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');
        $kodesubcabang = $this->session->userdata('mysubcabang');
        $no_wo = $this->input->post('no_wo');
        $datadetail = $this->input->post('detailjasa');
        $this->entry_jasa_detail_model->DeleteDetail($no_wo);

        if (!empty($datadetail)) {
            foreach ($datadetail as $key => $value) {
                $data = array(
                    'nomor' => $no_wo,                    
                    'kode_jasahead' => str_replace(",", "", $value['headjasa']),
                    'kode_jasa' => str_replace(",", "", $value['kodedetailjasa']),
                    'nama_jasa' => str_replace(",", "", $value['namadetailjasa']),
                );
                $this->entry_jasa_detail_model->SaveDetail($data);
            }
        }

        $data = array(
            'nopolisi' => $this->input->post('nopolisi'),
            'nomor_customer' => $this->input->post('nomor_customer'),
            'kode_tipe' => $this->input->post('kode_tipe'),
            'kode_cabang' => $kode_cabang,
            'kodecompany' => $kodecompany,
            'kodesubcabang' => $kodesubcabang,
            'tglsimpan' => date("Y-m-d H:i:s"),
            'pemakai' => $userlogin
        );
        $result = $this->entry_jasa_detail_model->UpdateHeader($data, $no_wo);

        if ($result == 1) {
            $resultjson = array(
                'error' => false,
                'message' => "Data berhasil diubah"
            );
        } else {
            $resultjson = array(
                'error' => false,
                'message' => "Data berhasil gagal diubah"
            );
        }
        echo json_encode($resultjson);
    }

    function FindEntryJasa()
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

    function Cancel()
    {
        $errorvalidasi = FALSE;
        $userlogin = $this->session->userdata('myusername');

        if ($errorvalidasi == FALSE) {
            $data = array(
                'keteranganbatal' => $this->input->post('alasan'),
                'batal' => true,
                'tglbatal' => date("Y-m-d H:i:s"),
                'userbatal' => $userlogin
            );
            $this->entry_jasa_detail_model->Cancel($data, $this->input->post('no_wo'));

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'error' => true,
                    'message' => "Data gagal dibatalkan"
                );
                # Something went wrong.
                $this->db->trans_rollback();
            } else {
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
