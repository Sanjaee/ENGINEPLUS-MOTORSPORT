<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Statuspekerjaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('spk/Statuspekerjaan_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }


    public function getWO()
    {
        $result =  $this->Statuspekerjaan_model->getWO($this->input->post('nomor'));
        echo json_encode($result);
    }

    public function getWODetail()
    {
        $result =  $this->Statuspekerjaan_model->getWODetail($this->input->post('nomor'));
        echo json_encode($result);
    }


    function cariWO()
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
                        $sub_array[] = '<button class="btn btn-success datacariWO" data-id="' . $msearch . '"   data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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


    function updateStatus()
    {
        $kode = $this->input->post('kode');
        $statuspekerjaan = $this->input->post('statuspekerjaan');
        $nopolisi = $this->input->post('nopolisi');
        $kodecabang = $this->input->post('kodecabang');
        $userlogin = $this->session->userdata('myusername');
        $nomor_wo = $this->input->post('nomor');
        $nourut = 1;
        // $statuspekerjaan = 1;

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $ceknomorwo = $this->Statuspekerjaan_model->ceknomorwo($nomor_wo, $kode);
        if (!empty($ceknomorwo)) {
            foreach ($ceknomorwo as $value) {
                if ($value->statuspekerjaan == 2) {
                    $resultjson = array(
                        'nomor' => '',
                        'error' => true,
                        'message' => 'Pekerjaan sudah selesai dilakukan',
                    );
                    echo json_encode($resultjson);
                    return FALSE;
                }
            }

            if ($statuspekerjaan == $value->statuspekerjaan) {
                $resultjson = array(
                    'nomor' => '',
                    'error' => true,
                    'message' => 'Status pekerjaan tidak berubah',
                );
                echo json_encode($resultjson);
                return FALSE;
            }
        }


        // ------------------- cek nomor urut dalam pencatatan waktu -------------------
        $getnomorurut = $this->Statuspekerjaan_model->getnomorurut($nomor_wo);
        if (!empty($getnomorurut)) {
            $nourut = intval($getnomorurut[0]->nourut) + 1;
        }

        // if (!empty($nomor_wo) && !empty($kode)) {
        //     $getstatuspekerjaan = $this->Statuspekerjaan_model->getstatuspekerjaan($nomor_wo, $kode);

        //     if ($getstatuspekerjaan[0]->statuspekerjaan > 0) {
        //         $statuspekerjaan = intval($getstatuspekerjaan[0]->statuspekerjaan) + 1;
        //     }
        // }

        $data = array(
            'nomor_wo' => $nomor_wo,
            'kodereferensi' => $kode,
            'nopolisi' => $nopolisi,
            'nourut' => $nourut,
            'actualwo_on' => date("Y-m-d H:i:s"),
            'statuspekerjaan' => $statuspekerjaan,
            'batal' => false,
            'kode_cabang' => $this->input->post('kode_cabang'),
            'kodesubcabang' => $this->input->post('kodesubcabang'),
            'kodegrupcabang' => $this->input->post('kodegrupcabang'),
            'kodecompany' => $this->input->post('kodecompany'),
        );
        $this->Statuspekerjaan_model->updateStatus($data);

        $updatestatuswo = array(
            'statuspekerjaan' => $statuspekerjaan
        );
        $this->Statuspekerjaan_model->updateStatusWO($updatestatuswo, $nomor_wo, $kode);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan, Nomor sudah pernah digunakan"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'nomor' => $nomor_wo,
                'message' => "Data berhasil disimpan"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
        return FALSE;
    }

    function cancelStatus()
    {
        $errorvalidasi = FALSE;
        $nomor = $this->input->post('nomor');
        $kode = $this->input->post('kode');
        $userlogin = $this->session->userdata('myusername');

        // $cekstatus = $this->Statuspekerjaan_model->checkstatuswo($nomor, $kode);
        // if (!empty($cekstatus)) {
        //     foreach ($cekstatus as $value) {
        //         // print_r($cekstatus);
        //         // die();

        //         if ($value->statuspekerjaan > 1) {
        //             $resultjson = array(
        //                 'nomor' => '',
        //                 'error' => true,
        //                 'message' => 'Data gagal dibatalkan, pekerjaan sudah selesai dilakukan',
        //             );
        //             echo json_encode($resultjson);
        //             $errorvalidasi = TRUE;
        //             return FALSE;
        //         }
        //     }
        // };

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
            
            $getnomorurut = $this->Statuspekerjaan_model->getnomorurut($nomor);
            if (!empty($getnomorurut)) {
                $nourut = intval($getnomorurut[0]->nourut) + 1;
            }

            $cekstatus = $this->Statuspekerjaan_model->checkstatuspekerjaan($nomor, $kode);
            if (!empty($cekstatus)) {
                $data = array(
                    // 'keteranganbatal' => $this->input->post('alasan'),
                    'statuspekerjaan' => 3,
                    'keteranganbatal' => $this->input->post('alasan'),
                    'batal' => true,
                    'tglbatal' => date("Y-m-d H:i:s"),
                    'userbatal' => $userlogin
                );
                $this->Statuspekerjaan_model->cancelStatus($data, $nomor, $kode);
            } else {
                $data = array(
                    'nomor_wo' => $nomor,
                    'kodereferensi' => $kode,
                    'nopolisi' => $this->input->post('nopolisi'),
                    'nourut' => $nourut,
                    'actualwo_on' => date("Y-m-d H:i:s"),
                    'statuspekerjaan' => 3,
                    'keteranganbatal' => $this->input->post('alasan'),
                    'batal' => true,
                    'tglbatal' => date("Y-m-d H:i:s"),
                    'userbatal' => $userlogin,
                    'kode_cabang' => $this->input->post('kode_cabang'),
                    'kodesubcabang' => $this->input->post('kodesubcabang'),
                    'kodegrupcabang' => $this->input->post('kodegrupcabang'),
                    'kodecompany' => $this->input->post('kodecompany'),
                );
                $this->Statuspekerjaan_model->updateStatus($data);
            }

            $datawodetail = array(
                'statuspekerjaan' => 3
            );
            $this->Statuspekerjaan_model->cancelWODetail($datawodetail, $nomor, $kode);

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


    public function Update()
    {
        $nomor = $this->input->post('nomor');
        $this->Statuspekerjaan_model->DeleteDetail($nomor);
        if (!empty($this->input->post('detailspk'))) {
            foreach ($this->input->post('detailspk') as $key => $value) {
                $data = array(
                    'nomorbooking' => $nomor,
                    'kodereferensi' => $value['Kode'],
                    'kategori' => $value['Kategori'],
                    'namareferensi' => $value['Nama'],
                    'jenis' => $value['Jenis'],
                    'qty' => str_replace(",", "", $value['Qty']),
                    'harga' => str_replace(",", "", $value['Harga']),
                    'subtotal' => str_replace(",", "", $value['Subtotal']),
                );
                $this->Statuspekerjaan_model->SaveDetail($data);
            }
        }
        $data = array(
            'returnjob' => $this->input->post('returnjob'),
            'tanggalbooking' => $this->input->post('tanggalbooking'),
            'dpp' => str_replace(",", "", $this->input->post('dpp')),
            'ppn' => str_replace(",", "", $this->input->post('ppn')),
            'grandtotal' => str_replace(",", "", $this->input->post('grandtotal')),
            'totalpart' => str_replace(",", "", $this->input->post('totalpart')),
            'totaljasa' => str_replace(",", "", $this->input->post('totaljasa')),
            'inventaris' => $this->input->post('inventaris'),
            'kode_regularcheck' => $this->input->post('koderegular'),
            'nama_regularcheck' => $this->input->post('namaregular')
        );
        $result =  $this->Statuspekerjaan_model->UpdateHeader($data, $nomor);

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



    function historyspk()
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
