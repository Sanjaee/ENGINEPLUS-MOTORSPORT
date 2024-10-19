<?php
defined('BASEPATH') or exit('No direct script access allowed');
class WorkshopAP extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/workshopAP_model");
        $this->load->model("caridataaktif_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function tampilworkshopAP()
    {
        $sqlcriteria = '';

        $data = $this->workshopAP_model->tampilworkshopAP($this->input->post('jenisfaktur'), $this->input->post('pencairan'), $this->input->post('kodecabang'), $this->input->post('kodecompany'), $this->input->post('kodesubcabang'), $this->input->post('kodegrupcabang'), $this->input->post('tglmulai'), $this->input->post('tglakhir'));
        echo json_encode($data);
    }
}
