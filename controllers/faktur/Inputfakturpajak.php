<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Inputfakturpajak extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set( 'Asia/Jakarta' );
        $this->load->model( 'faktur/inputfakturpajak_model' );
        $this->load->model( 'caridataaktif_model' );
        $this->load->model( 'faktur/registernomorfp_model' );
        $this->load->library( 'form_validation' );
        $this->load->library( 'session' );
    }

    public function GetDataInvoice() {
        $result =  $this->inputfakturpajak_model->GetInvoice( $this->input->post( 'nomor' ) );
        echo json_encode( $result );
    }

    public function GetDataFP() {
        $data = $this->inputfakturpajak_model->GetFP( $this->input->post( 'nomor' ) );
        echo json_encode( $data );
    }

    public function GetDataNomorFakturPajak() {
        $data = $this->inputfakturpajak_model->GetNomorFakturPajak( $this->input->post( 'nomor' ) );
        echo json_encode( $data );
    }

    function GetDataDetail() {
        $data = $this->inputfakturpajak_model->GetDetail( $this->input->post( 'nomor' ) );
        echo json_encode( $data );
    }

    function CariDataInvoice() {

        $fetch_data = $this->caridataaktif_model->make_datatables( $this->input->post( 'field' ), $this->input->post( 'nmtb' ), $this->input->post( 'sort' ), $this->input->post( 'where' ), $this->input->post( 'value' ) );

        $data = array();

        foreach ( $fetch_data as $row ) {

            $sub_array = array();

            $i = 1;
            $count = count( $this->input->post( 'field' ) );
            foreach ( $this->input->post( 'field' ) as $key => $value ) {
                if ( $i <= $count ) {
                    if ( $i == 1 ) {
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcustomer" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';

                        $sub_array[] = '<button class="btn btn-success searchinv" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';

                        $sub_array[] = $row->$value;

                    } else {
                        if ( $i == $count ) {
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
            'draw'                    =>     intval( $_POST[ 'draw' ] ),
            'recordsTotal'          =>      $this->caridataaktif_model->get_all_data( $this->input->post( 'nmtb' ) ),
            'recordsFiltered'     =>     $this->caridataaktif_model->get_filtered_data( $this->input->post( 'field' ), $this->input->post( 'nmtb' ), $this->input->post( 'sort' ), $this->input->post( 'where' ), $this->input->post( 'value' ) ),
            'data'                    =>     $data
        );

        echo json_encode( $output );
    }

    function CariDataNomorFakturPajak() {

        $fetch_data = $this->caridataaktif_model->make_datatables( $this->input->post( 'field' ), $this->input->post( 'nmtb' ), $this->input->post( 'sort' ), $this->input->post( 'where' ), $this->input->post( 'value' ) );

        $data = array();

        foreach ( $fetch_data as $row ) {

            $sub_array = array();

            $i = 1;
            $count = count( $this->input->post( 'field' ) );
            foreach ( $this->input->post( 'field' ) as $key => $value ) {
                if ( $i <= $count ) {
                    if ( $i == 1 ) {
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcustomer" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';

                        $sub_array[] = '<button class="btn btn-success searchfp" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';

                        $sub_array[] = $row->$value;
                    } else {
                        $sub_array[] = $row->$value;
                    }
                }
                $i++;
            }

            $data[] = $sub_array;

        }

        $output = array(
            'draw'                    =>     intval( $_POST[ 'draw' ] ),
            'recordsTotal'          =>      $this->caridataaktif_model->get_all_data( $this->input->post( 'nmtb' ) ),
            'recordsFiltered'     =>     $this->caridataaktif_model->get_filtered_data( $this->input->post( 'field' ), $this->input->post( 'nmtb' ), $this->input->post( 'sort' ), $this->input->post( 'where' ), $this->input->post( 'value' ) ),
            'data'                    =>     $data
        );

        echo json_encode( $output );
    }

    function CariDataFP() {

        $fetch_data = $this->caridataaktif_model->make_datatables( $this->input->post( 'field' ), $this->input->post( 'nmtb' ), $this->input->post( 'sort' ), $this->input->post( 'where' ), $this->input->post( 'value' ) );

        $data = array();

        foreach ( $fetch_data as $row ) {

            $sub_array = array();

            $i = 1;
            $count = count( $this->input->post( 'field' ) );
            foreach ( $this->input->post( 'field' ) as $key => $value ) {
                if ( $i <= $count ) {
                    if ( $i == 1 ) {
                        $msearch = $row->$value;
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchok" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';

                        $sub_array[] = '<button class="btn btn-success searchok" data-id="'.$msearch.'" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';

                        $sub_array[] = $row->$value;

                    } else {
                        $sub_array[] = $row->$value;
                    }

                }
                $i++;
            }

            $data[] = $sub_array;

        }

        $output = array(
            'draw'                    =>     intval( $_POST[ 'draw' ] ),
            'recordsTotal'          =>      $this->caridataaktif_model->get_all_data( $this->input->post( 'nmtb' ) ),
            'recordsFiltered'     =>     $this->caridataaktif_model->get_filtered_data( $this->input->post( 'field' ), $this->input->post( 'nmtb' ), $this->input->post( 'sort' ), $this->input->post( 'where' ), $this->input->post( 'value' ) ),
            'data'                    =>     $data
        );

        echo json_encode( $output );

    }

    function Save() {
        $this->db->trans_start();
        # Starting Transaction
        $this->db->trans_strict( FALSE );
        $userlogin = $this->session->userdata( 'myusername' );
        $kodecabang = $this->input->post( 'kodecabang' );

        //------------insert faktur pajak otomatis
        $ambilnomorFP = 'FP-' . $kodecabang . '-' . substr( date( 'Y' ), 2, 2 ) . date( 'm' );
        $get[ 'FP' ] = $this->inputfakturpajak_model->GetMaxNomorFP( $ambilnomorFP );
        if ( !$get[ 'FP' ]->nomor ) {
            $nomor = $ambilnomorFP . '00001';
        } else {
            $lastNomor = $get[ 'FP' ]->nomor;
            $lastNoUrut = substr( $lastNomor, 11, 16 );

            // nomor urut ditambah 1
            $nextNoUrut = $lastNoUrut + 1;
            $nomor = $ambilnomorFP . sprintf( '%05s', $nextNoUrut );
        }

		// get data nomor faktur pajak terakhir sesuai dengan tglregister dengan status faktur pajak false
		$lastNomorFakturPajak = $this->inputfakturpajak_model->getLastNomorFakturPajak();

        foreach ( $this->input->post( 'detailrequest' ) as $key => $value ) {
            $data = array(
                'nomor' => $nomor,
                'nomor_penjualan' => $value[ 'NoInvoice' ],
                'tanggal' => date( 'Y-m-d H:i:s' ),
                'nomor_fakturpajak' => $lastNomorFakturPajak->nomor_fakturpajak,
                'tglppn' => $value[ 'TglPPN' ],
                'kode_customer' => $value[ 'NoCustomer' ],
                'keterangan' => 'FAKTUR PAJAK SERVICE',
                'penanggungjawab' => $userlogin,
                'jabatan' => 'BAG. PAJAK',
                'kode_cabang' => $this->input->post( 'kodecabang' ),
                'kodegroupcabang' => $this->session->userdata( 'mygrupcabang' ),
                'kodecompany' => $this->input->post( 'kodecompany' ),
                'tglsimpan' => date( 'Y-m-d H:i:s' ),
                'pemakai' => $userlogin
            );
            $this->inputfakturpajak_model->SaveFakturPajak( $data );

            // update nomor faktur pajak di invoice
            $dataUpdateNomorFakturPajak = array(
                'nomor_fakturpajak' => $lastNomorFakturPajak->nomor_fakturpajak,
            );
            $this->inputfakturpajak_model->UpdateNoFPInvoice( $dataUpdateNomorFakturPajak, $value[ 'NoInvoice' ] );

            // update status faktur pajak
            $dataUpdateStatusFakturPajak = [
                'status_fakturpajak' => true
            ];
            $this->registernomorfp_model->update( $dataUpdateStatusFakturPajak, $lastNomorFakturPajak->nomor_fakturpajak);
        }

        $this->db->trans_complete();

        if ( $this->db->trans_status() === FALSE ) {
            $resultjson = array(
                'nomor' => '',
                'message' => 'Data gagal disimpan, Nomor sudah pernah digunakan' );
                # Something went wrong.
                $this->db->trans_rollback();
            } else {
                $resultjson = array(
                    'nomor' => $nomor,
					'nomorfp' => $lastNomorFakturPajak->nomor_fakturpajak,
                    'message' => 'Data berhasil disimpan'
                );
                # Everything is Perfect.
                # Committing data to the database.
                $this->db->trans_commit();
            }

            echo json_encode( $resultjson );
        }

        function Cancel() {
            $userlogin = $this->session->userdata( 'myusername' );
            $data = array(
                'keteranganbatal' => $this->input->post( 'alasan' ),
                'batal' => true,
                'tglbatal' => date( 'Y-m-d H:i:s' ),
                'userbatal' => $userlogin
            );
            $this->inputfakturpajak_model->Cancel( $data, $this->input->post( 'nomor' ) );

            foreach ( $this->input->post( 'datadetail' ) as $key => $value ) {
                // update nomor faktur pajak
                $data = array(
                    'nomor_fakturpajak' => ''
                );
                $this->inputfakturpajak_model->UpdateNoFPInvoice( $data, $value[ 'NoInvoice' ] );

                // update status faktur pajak
                $dataUpdateStatusFakturPajak = [
                    'status_fakturpajak' => false
                ];
                $this->registernomorfp_model->update( $dataUpdateStatusFakturPajak, $this->input->post( 'nomorfp' ));
            }

            $this->db->trans_complete();

            if ( $this->db->trans_status() === FALSE ) {
                $resultjson = array(
                    'error' => true,
                    'message' => 'Data gagal disimpan, Nomor sudah pernah digunakan' );
                    # Something went wrong.
                    $this->db->trans_rollback();
                } else {
                    $resultjson = array(
                        'error' => false,
                        'message' => 'Data berhasil dibatalkan'
                    );
                    # Everything is Perfect.
                    # Committing data to the database.
                    $this->db->trans_commit();
                }

                echo json_encode( $resultjson );
            }

        }
        ?>
