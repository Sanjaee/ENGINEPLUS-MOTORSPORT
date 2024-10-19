<?php
defined('BASEPATH') or exit('No direct script access allowed');
class History_penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/history_penjualan_model");
        $this->load->model("caridataaktif_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function tampilhistoryar()
    {
        $jenispencarian = $this->input->post('jenispencairan');
        $pencairan = $this->input->post('pencairan');
        $sqlcriteria = '';

        if ($jenispencarian == '0') {
            $sqlcriteria = "and lower(nomorfaktur) like lower('%" . $pencairan . "%')";
        } else if ($jenispencarian == '1') {
            $sqlcriteria = "and lower(nomororder) like  lower('%" . $pencairan . "%')";
        } else if ($jenispencarian == '2') {
            $sqlcriteria = "and lower(namacustomer) like lower('%" . $pencairan . "%')";
        } else if ($jenispencarian == '3') {
            $sqlcriteria = "and lower(nopolisi) like  lower('%" . $pencairan . "%')";
        }

        $data = $this->history_penjualan_model->tampilhistoryar($this->input->post('jenisfaktur'), $sqlcriteria, $this->input->post('kodecabang'), $this->input->post('kodecompany'), $this->input->post('kodesubcabang'), $this->input->post('kodegrupcabang'));
        echo json_encode($data);
    }

    function getdetailhistoryar()
    {
        $data = $this->history_penjualan_model->getdetailhistoryar($this->input->post('jenisfaktur'), $this->input->post('nomororder'), $this->input->post('nomorfaktur'));
        echo json_encode($data);
    }

    function getdetailhistoryjasa()
    {
        $empty = 'Data Empty';
        $data = $this->history_penjualan_model->getdetailhistoryjasa($this->input->post('nofaktur'), $this->input->post('jenisfaktur'), $empty);
        echo json_encode($data);
    }

    function getdetailhistorysparepart()
    {
        $data = $this->history_penjualan_model->getdetailhistorysparepart($this->input->post('nofaktur'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }

    function getdetailpembebanansparepart()
    {
        $data = $this->history_penjualan_model->getdetailpembebanansparepart($this->input->post('nopo'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }

    function getdetailhistoryopl()
    {
        $data = $this->history_penjualan_model->getdetailhistoryopl($this->input->post('nofaktur'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }

    function gethistoryopl()
    {
        $data = $this->history_penjualan_model->gethistoryopl($this->input->post('nopo'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }

    function gethistorypenerimaankasir()
    {
        $data = $this->history_penjualan_model->gethistorypenerimaankasir($this->input->post('nofaktur'), $this->input->post('nomororder'));
        echo json_encode($data);
    }

    function gethistorypembatalanpenerimaankasir()
    {
        $data = $this->history_penjualan_model->gethistorypembatalanpenerimaankasir($this->input->post('nofaktur'), $this->input->post('nomororder'));
        echo json_encode($data);
    }

    function gethistorywo()
    {
        $data = $this->history_penjualan_model->gethistorywo($this->input->post('nopo'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }
}
