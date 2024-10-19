<?php
ini_set('max_execution_time', 800);
ini_set('memory_limit', '2048M');
defined('BASEPATH') or exit('No direct script access allowed');

class Closing_accounting extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('masterdata/closing_accounting_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('caridata2_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function GetDataClosing()
    {
        $result =  $this->closing_accounting_model->GetOD($this->input->post('periode'), $this->input->post('jenis'), $this->input->post('grupcabang'));
        echo json_encode($result);
    }


    function CariDataClosing()
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
                        $sub_array[] = '<button class="btn btn-success searchod" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                        } else {
                            $sub_array[] = $row->$value;
                        }
                    }
                    // $sub_array[] = $row->$value;
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

    public function CariODetail()
    {
        $result =  $this->otorisasi_menu_model->CariODetail($this->input->post('kode'));
        echo json_encode($result);
    }

    function Save()
    {

        $userlogin = $this->session->userdata('myusername');
        $periode = date("Ym", strtotime($this->input->post('periode')));
        $bln = date("m", strtotime($this->input->post('periode')));
        $thn = date("Y", strtotime($this->input->post('periode')));
        $bulanini =  date("Y") . date("m");
        $kode_cabang = $this->input->post('kode_cabang');
        $kodecompany = $this->input->post('kodecompany');
        $kodesubcabang = $this->input->post('kodesubcabang');
        $grupcabang = $this->input->post('grupcabang');
        $periodebaru = date('Ym', strtotime($this->input->post('periode') . " +1 month"));
        $jenis = $this->input->post('jenis');
        // print_r($periodebaru);
        // die();
        $errorvalidasi = FALSE;


        if (($periode >= $bulanini)) {
            $resultjson = array(
                'error' => true,
                'message' => "Proses Gagal, Proses Closing Tidak Boleh Bulan Berjalan..."
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $cekclose = $this->closing_accounting_model->checkclosing($periode, $this->input->post('jenis'), $this->input->post('grupcabang'), $kode_cabang);
        //   print_r ($cekclose);
        //                  die();
        if (!empty($cekclose)) {
            foreach ($cekclose as $key => $value) {
                if ($value->periode != '') {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal di Close, Periode Setelah nya sudah di close"
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            }
        };

        $cekinv = $this->closing_accounting_model->checkinvoice($periode, $kode_cabang);
        //   print_r ($cekclose);
        //                  die();
        if (!empty($cekinv)) {
            $resultjson = array(
                'error' => true,
                'message' => "Data gagal di Close, Masih ada penerimaan part yang belum invoice !"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        };

        $get["otorisasi"] = $this->closing_accounting_model->get($periode, $this->input->post('jenis'), $this->input->post('grupcabang'),$kode_cabang);
        if (!empty($get["otorisasi"])) {
            $resultjson = array(
                'error' => true,
                'message' => "Periode tersebut sudah di close"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        if ($errorvalidasi == FALSE) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            if ($jenis == '1') { //closing part
                //delete stockpart faktur
                $this->closing_accounting_model->DeleteStockFaktur($periodebaru, $grupcabang, $kode_cabang);

                //----  JIKA TIDAK ADA PART FAKTUR AKAN INSERT
                // $result = $this->closing_accounting_model->stockpartf($bln, $thn, $grupcabang, $kode_cabang);
                // if (!empty($result)) {

                //     foreach ($result as $key => $value) {
                //         //insert bulan berjalan
                //         $get['beliakhir'] =  $this->closing_accounting_model->getdataparts($value->kode_parts, $kode_cabang, $kodecompany);
                //         // $cogsstd = $get['beliakhir']->hargabeliakhir;
                        
                //         if  (!empty($get['beliakhir'])) {
                //             $cogsstd = $get['beliakhir']->hargabeliakhir;                
                //         }else{
                //             $cogsstd = '0';   
                //         };
                        
                //         $stockpf['cogsstd'] =  $this->closing_accounting_model->checkcogs($periode, $value->kode_parts, $kode_cabang, $kodecompany);
                //         // $cogsstd = $get['STD']->cogsstd;

                //         if (empty($stockpf['cogsstd'])) {
                //             $data2 = array(
                //                 'periode' => $periode,
                //                 'kodepart' => $value->kode_parts,
                //                 'kode_cabang' => $value->kode_cabang,
                //                 'kodecompany' => $value->kodecompany,
                //                 'kodesubcabang' => $value->kodesubcabang,
                //                 'kodegrup' => $value->kodegrup,
                //                 'invoice' => '1',
                //                 'stockawal' => '0',
                //                 'cogsstd' => $cogsstd
                                
                //             );
                //             $result =  $this->closing_accounting_model->SaveStockFaktur($data2);
                //         } else {
                //             // print_r($stockpf['cogsstd']->cogsstd);
                //             // die();
                //             if ($stockpf['cogsstd']->cogsstd == 0) {
                //                 $datax = array(
                //                     'cogsstd' => $cogsstd
                //                 );
                //                 $result =  $this->closing_accounting_model->UpdateStockFaktur($datax, $periode, $value->kode_parts, $kode_cabang, $kodecompany);
                //             }
                //         }
                //     }
                // }

                $resultx = $this->closing_accounting_model->stockpartf($bln, $thn, $grupcabang, $kode_cabang);
                if (!empty($resultx)) {
                    foreach ($resultx as $key => $value) {
                        $get['beliakhir'] =  $this->closing_accounting_model->getdataparts($value->kode_parts, $kode_cabang, $kodecompany);
                        $cogsstd = $get['beliakhir']->hargabeliakhir;

                        $stockpf =  $this->closing_accounting_model->checkcogs($periodebaru, $value->kode_parts, $kode_cabang, $kodecompany);
                        if (empty($stockpf)) {
                            $data2 = array(
                                'periode' => $periodebaru,
                                'kodepart' => $value->kode_parts,
                                'kode_cabang' => $value->kode_cabang,
                                'kodecompany' => $value->kodecompany,
                                'kodesubcabang' => $value->kodesubcabang,
                                'kodegrup' => $value->kodegrup,
                                'invoice' => '1',
                                'stockawal' => $value->saldoawalstock,
                                'cogs' => (($value->cogs) ? $value->cogs : 0),
                                'cogsstd' => $cogsstd
                            );
                            $result =  $this->closing_accounting_model->SaveStockFaktur($data2);
                        }
                        if ($value->saldoawalstock != 0) {
                            $datax = array(
                                'stockawal' => $value->saldoawalstock,
                                'cogsstd' => round($value->total_akhir / $value->saldoawalstock)
                            );
                            $result =  $this->closing_accounting_model->UpdateStockFaktur($datax, $periodebaru, $value->kode_parts, $kode_cabang, $kodecompany);
                        } else {
                            $datas = array(
                                'stockawal' => $value->saldoawalstock
                            );
                            $result =  $this->closing_accounting_model->UpdateStockFaktur($datas, $periodebaru, $value->kode_parts, $kode_cabang, $kodecompany);
                        }


                        if ($value->saldoawalstock != 0) {
                            // //update cogs bulan closing
                            // $data = array(
                            //     // 'cogsstd' => round($value->total_akhir / $value->saldoawalstock),
                            //     'cogs' => round($value->total_akhir / $value->saldoawalstock)
                            // );
                            // $result =  $this->closing_accounting_model->updatecogs($data, $periode, $value->kode_parts, $value->kode_cabang, $value->kodecompany, $value->kodesubcabang);

                            // //update cogs bulan berjalan
                            $data = array(
                                // 'cogsstd' => round($value->total_akhir / $value->saldoawalstock),
                                'cogs' => round($value->cogs)
                            );
                            $result =  $this->closing_accounting_model->updatecogs($data, $periodebaru, $value->kode_parts, $value->kode_cabang, $value->kodecompany, $value->kodesubcabang);

                            //update cogs ke master parts
                            $data = array(
                                'cogs' => round($value->cogs)
                            );
                            $result =  $this->closing_accounting_model->updateparts($data, $value->kode_parts, $value->kode_cabang, $value->kodecompany);
                        } else {
                            // //update cogs bulan closing
                            // $data = array(
                            //     // 'cogsstd' => $value->cogs,
                            //     'cogs' => $value->cogs
                            // );
                            // $result =  $this->closing_accounting_model->updatecogs($data, $periode, $value->kode_parts, $value->kode_cabang, $value->kodecompany, $value->kodesubcabang);

                            // //update cogs bulan berjalan
                            $data = array(
                                // 'cogsstd' => $value->cogs,
                                'cogs' => $value->cogs,
                                // 'cogs' => $cogsstd
                            );
                            $result =  $this->closing_accounting_model->updatecogs($data, $periodebaru, $value->kode_parts, $value->kode_cabang, $value->kodecompany, $value->kodesubcabang);

                            //update cogs ke master parts
                            $data = array(
                                'cogs' => $value->cogs
                            );
                            $result =  $this->closing_accounting_model->updateparts($data, $value->kode_parts, $value->kode_cabang, $value->kodecompany);
                        }
                    }
                }

                $result = $this->closing_accounting_model->totalsaldop($bln, $thn, $grupcabang,$kode_cabang);
                if (!empty($result)) {
                    foreach ($result as $key => $value) {
                        $checkdata =  $this->closing_accounting_model->checkdatasp($periodebaru, $value->kode_parts, $value->kode_cabang, $value->kodecompany, $value->kodesubcabang);
                        if (empty($checkdata)) {
                            //jika stock tidak ada maka insert cogs dan total saldoawal nya
                            $data = array(
                                'periode' => $periodebaru,
                                'kodepart' => $value->kode_parts,
                                'kode_cabang' => $value->kode_cabang,
                                'kodecompany' => $value->kodecompany,
                                'kodegrup' => $value->kodegrup,
                                'kodesubcabang' => $value->kodesubcabang,
                                'totalsaldoawal' => (($value->total_akhir) ? $value->total_akhir : 0)
                            );
                            $result = $this->closing_accounting_model->SaveStockPart($data);
                        } else {
                            //Insert COGS Saldo Awal untuk memastikan saldo akhir sama dengan saldo awal bulan berikutnya
                            $data = array(
                                'totalsaldoawal' => (($value->total_akhir) ? $value->total_akhir : 0)
                            );
                            $result =  $this->closing_accounting_model->updatecogs($data, $periodebaru, $value->kode_parts, $value->kode_cabang, $value->kodecompany, $value->kodesubcabang);
                        }
                    }
                }
            } else { //closing akunting dan kasir
                //saldo piutangs
               $this->closing_accounting_model->DeleteSaldoPiutang($periodebaru, $grupcabang, $kode_cabang);

               $checkpiutang = $this->closing_accounting_model->saldopiutang($periode, $grupcabang, $kode_cabang);
               if (!empty($checkpiutang)) {
                   foreach ($checkpiutang as $key => $value) {
                       //insert Saldo Piutang
                       $data = array(
                           'periode' => $periodebaru,
                           'jenistransaksi' => $value->jenispiutang,
                           'tgltransaksi' => $value->tgltransaksi,
                           'tgljatuhtempo' => $value->tgltransaksi,
                           'noreferensi' => $value->nomorfaktur,
                           'nomorcustomer' => $value->nomor_customer,
                           'nilaipiutang' => $value->nilaipiutang,
                           'saldopiutang' => $value->total,
                           'kodecabang' => $value->kodecabang,
                           'kodecompany' => $value->kodecompany,
                           'kodesubcabang' => $value->kodesubcabang,
                           'kodegrup' => $value->kodegrup,
                           'tglsimpan' => date("Y-m-d H:i:s"),
                           'pemakai' => $userlogin
                       );
                       $result =  $this->closing_accounting_model->SaveSaldoPiutang($data);
                   }
               }

               //saldo uang muka
               $this->closing_accounting_model->DeleteSaldoUM($periodebaru, $grupcabang, $kode_cabang);

               $checkum = $this->closing_accounting_model->saldoUM($periode, $grupcabang, $kode_cabang);
               if (!empty($checkum)) {
                   foreach ($checkum as $key => $value) {
                       //insert Saldo UM
                       $data = array(
                           'periode' => $periodebaru,
                           'jenistransaksi' => $value->jenispiutang,
                           'tgltransaksi' => $value->tgltransaksi,
                           'noreferensi' => $value->nomororder,
                           'nomorcustomer' => $value->nomor_customer,
                           'nilaiuangmuka' => $value->total,
                           'kodecabang' => $value->kodecabang,
                           'kodecompany' => $value->kodecompany,
                           'kodesubcabang' => $value->kodesubcabang,
                           'kodegrup' => $value->kodegrup,
                           'tglsimpan' => date("Y-m-d H:i:s"),
                           'pemakai' => $userlogin
                       );
                       $result =  $this->closing_accounting_model->SaveSaldoUM($data);
                   }
               }

               //saldo Hutang 
               $this->closing_accounting_model->DeleteSaldoHutang($periodebaru, $grupcabang, $kode_cabang);

               $checkhutang = $this->closing_accounting_model->saldohutang($periode, $grupcabang, $kode_cabang);
               if (!empty($checkhutang)) {
                   foreach ($checkhutang as $key => $value) {
                       //insert Saldo Hutang
                       $data = array(
                           'periode' => $periodebaru,
                           'jenistransaksi' => $value->jenishutang,
                           'tgltransaksi' => $value->tgltransaksi,
                           'tgljatuhtempo' => $value->tgltransaksi,
                           'noreferensi' => $value->nomorfaktur,
                           'nomorsupplier' => $value->nomorsupplier,
                           'saldohutang' => $value->total,
                           'kodecabang' => $value->kodecabang,
                           'kodecompany' => $value->kodecompany,
                           'kodesubcabang' => $value->kodesubcabang,
                           'kodegrup' => $value->kodegrup,
                           'tglsimpan' => date("Y-m-d H:i:s"),
                           'pemakai' => $userlogin
                       );
                       $result =  $this->closing_accounting_model->SaveSaldoHutang($data);
                   }
               }

               //saldo uang muka pembelian
               $this->closing_accounting_model->DeleteSaldoUMBeli($periodebaru, $grupcabang, $kode_cabang);

               $checkum = $this->closing_accounting_model->saldoUMbeli($periode, $grupcabang, $kode_cabang);
               if (!empty($checkum)) {
                   foreach ($checkum as $key => $value) {
                       //insert Saldo UM
                       $data = array(
                           'periode' => $periodebaru,
                           'jenistransaksi' => $value->jenishutang,
                           'tgltransaksi' => $value->tgltransaksi,
                           'noreferensi' => $value->nomororder,
                           'nomorcustomer' => $value->nomor_supplier,
                           'nilaiuangmuka' => $value->total,
                           'kodecabang' => $value->kodecabang,
                           'kodecompany' => $value->kodecompany,
                           'kodesubcabang' => $value->kodesubcabang,
                           'kodegrup' => $value->kodegrup,
                           'tglsimpan' => date("Y-m-d H:i:s"),
                           'pemakai' => $userlogin
                       );
                       $result =  $this->closing_accounting_model->SaveSaldoUMbeli($data);
                   }
               }
            }

            $cekclose = $this->closing_accounting_model->checkclosingx($periode, $this->input->post('jenis'), $this->input->post('grupcabang'), $kode_cabang);
            if (empty($cekclose)) {
                    $data = array(
                        'periodecabang' => $periode . $kode_cabang . $this->input->post('jenis'),
                        'periode' => $periode,
                        'jenis' => $this->input->post('jenis'),
                        'kode_cabang' => $kode_cabang,
                        'kodecompany' => $this->input->post('kodecompany'),
                        'kodegrup' => $this->input->post('grupcabang'),
                        'status' => '1'
                    );
                    $this->closing_accounting_model->SaveData($data);
                
            }else{
                $this->closing_accounting_model->updateclosing($periode,$this->input->post('jenis'),$this->input->post('grupcabang'), $kode_cabang, false);
            };


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
                    'nomor' => 'ok',
                    'message' => "Data berhasil di close"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }
            echo json_encode($resultjson);
            return false;
        }
    }

    public function Update()
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);
        $userlogin = $this->session->userdata('myusername');
        // $periodelanjut = date("Ym", strtotime($this->input->post('periode')));
        $periodelanjut = $this->input->post('periode') + 1;
        $bln = date("m", strtotime($this->input->post('periode')));
        $thn = date("Y", strtotime($this->input->post('periode')));
        $jenis = $this->input->post('jenis');
        $kode_cabang = $this->input->post('kode_cabang');
        $kodecompany = $this->input->post('kodecompany');
        $grupcabang = $this->input->post('grupcabang');

        $cekclose = $this->closing_accounting_model->checkclosingup($this->input->post('jenis'), $this->input->post('kode_cabang'));
        // print_r ($this->input->post('periode'));
        // die();
        if (!empty($cekclose)) {
            foreach ($cekclose as $key => $value) {
                if (($value->periode) != $this->input->post('periode')) {
                    $resultjson = array(
                        'error' => true,
                        'message' => "Data gagal di unclose, unclose dahulu periode setelah nya."
                    );
                    $errorvalidasi = TRUE;
                    echo json_encode($resultjson);
                    return FALSE;
                }
            }
        };

        $errorvalidasi = FALSE;
        if ($errorvalidasi == FALSE) {

            if ($jenis == 1) {
                //delete stockpart faktur
                // print_r($periodelanjut);
                // die();
                $result =  $this->closing_accounting_model->DeleteStockFaktur($periodelanjut, $grupcabang, $kode_cabang);

                //update cogs bulan closing
                $data = array(
                    'cogs' => '0',
                    'totalsaldoawal' => '0'
                );
                $result =  $this->closing_accounting_model->updatecogsunclose($periodelanjut, $grupcabang, $kode_cabang);
            } else {
                //saldopiutang
                $result =  $this->closing_accounting_model->DeleteSaldoPiutang($periodelanjut, $grupcabang, $kode_cabang);

                //saldo uang muka
                $result =  $this->closing_accounting_model->DeleteSaldoUM($periodelanjut, $grupcabang, $kode_cabang);

                //saldo Hutang 
                $result =  $this->closing_accounting_model->DeleteSaldoHutang($periodelanjut, $grupcabang, $kode_cabang);
                
                //saldo uang muka pembelian 
                $this->closing_accounting_model->DeleteSaldoUMBeli($periodelanjut, $grupcabang, $kode_cabang);
            }

            //delete status closing
            // $result = $this->closing_accounting_model->deleteclosing($this->input->post('periode'), $this->input->post('jenis'), $this->input->post('grupcabang'));
            $this->closing_accounting_model->updateclosing($this->input->post('periode'),$this->input->post('jenis'),$this->input->post('grupcabang'),$kode_cabang, true);

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
                    'nomor' => 'ok',
                    'message' => "Data berhasil di unclose"
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }
            echo json_encode($resultjson);
        }
    }
}
