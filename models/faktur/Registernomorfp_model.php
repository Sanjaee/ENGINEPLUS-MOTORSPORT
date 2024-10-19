<?php

class Registernomorfp_model extends CI_Model {

    private $_table = 'trnt_registrasinomorfakturpajak';

    function GetFP( $nomor = '' ) {
        $this->db->where( 'nomor_fakturpajak', $nomor );
        return $this->db->get( 'cari_datafp' )->result();
    }

    function SaveData( $data = '' ) {
        return $this->db->insert( 'trnt_registrasinomorfakturpajak', $data );
    }

    public function update( $data = '', $nomor = '' ) {
        $this->db->where( 'nomor_fakturpajak', $nomor );
        return $this->db->update( $this->_table, $data );
    }

}

?>
