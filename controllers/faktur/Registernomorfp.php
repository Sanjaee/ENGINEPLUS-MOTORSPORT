<?php

defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Registernomorfp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set( 'Asia/Jakarta' );
        $this->load->model( 'faktur/registernomorfp_model' );
        $this->load->model( 'caridataaktif_model' );
        $this->load->model( 'caridata2_model' );
        $this->load->library( 'form_validation' );
        $this->load->library( 'session' );
    }

    public function GetDataFP() {
        $result =  $this->registernomorfp_model->GetFP( $this->input->post( 'nomorfp' ) );
        echo json_encode( $result );
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
                        // $sub_array[] = '<button class="btn btnt-info btn-xs searchcustomer" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';

                        $sub_array[] = '<button class="btn btn-success searchod" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
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

    function Save() {
        $this->db->trans_start();
        # Starting Transaction
        $this->db->trans_strict( FALSE );
        $userlogin = $this->session->userdata( 'myusername' );
        $nomulai = substr( $this->input->post( 'nomulai' ), 7 );
        $noawal = substr( $this->input->post( 'nomulai' ), 0, 7 );
        $noakhir = substr( $this->input->post( 'noakhir' ), 7 );

        for ( $i = $nomulai; $i <= $noakhir; $i++ ) {
            $data = array(
                'nomor_fakturpajak' => $noawal.$i,
                'status_fakturpajak' => false,
                'tglregister' => date( 'Y-m-d H:i:s' ),
                'pemakai' => $userlogin,
                'tglsimpan' => date( 'Y-m-d H:i:s' ),
                'kode_cabang' => $this->input->post( 'kodecabang' ),
                'kodegroupcabang' => $this->input->post( 'groupcabang' ),
                'kodecompany' => $this->input->post( 'kodecompany' )
            );
			
            $this->registernomorfp_model->SaveData( $data );
        }

        $this->db->trans_complete();

        if ( $this->db->trans_status() === FALSE ) {
            $resultjson = array(
                'nomor' => '',
                'message' => 'Data gagal disimpan, Nomor sudah pernah digunakan'
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'nomor' => '',
                'message' => 'Data berhasil disimpan'
            );
            # Everything is Perfect.
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode( $resultjson );
    }

    public function Remove() {
        $this->db->trans_start();
        # Starting Transaction
        $this->db->trans_strict( FALSE );

        $userlogin = $this->session->userdata( 'myusername' );
        $data = array(
            'status_fakturpajak' => true,
            'tglsimpan' => date( 'Y-m-d H:i:s' ),
            'pemakai' => $userlogin
        );
        $this->registernomorfp_model->update( $data, $this->input->post( 'nomorfp' ) );

        $this->db->trans_complete();

        if ( $this->db->trans_status() === FALSE ) {
            $resultjson = array(
                'nomor' => '',
                'message' => 'Data gagal disimpan, Nomor sudah pernah digunakan'
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'nomor' => '',
                'message' => 'Data berhasil disimpan'
            );
            # Everything is Perfect.
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode( $resultjson );
    }
}
