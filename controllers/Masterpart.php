<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterpart extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterpart_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

	public function caridata()
	{
		$query= $this->masterpart_model->tampildatapart($this->input->post('kode'));
		// print_r($query);
		// die();
        echo json_encode($query);
	}
}
