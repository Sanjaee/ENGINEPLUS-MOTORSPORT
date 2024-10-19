<?php
defined('BASEPATH') or exit('No direct script access allowed');
class History_pembelian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("masterdata/history_pembelian_model");
        $this->load->model("caridataaktif_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function tampilhistoryap()
    {
        $jenispencarian = $this->input->post('jenispencairan');
        $pencairan = $this->input->post('pencairan');
        $sqlcriteria = '';

        if ($jenispencarian == '0') {
            $sqlcriteria = "and lower(nomorfaktur) like lower('%" . $pencairan . "%')";
        } else if ($jenispencarian == '1') {
            $sqlcriteria = "and lower(nomororder) like  lower('%" . $pencairan . "%')";
        } else if ($jenispencarian == '2') {
            $sqlcriteria = "and lower(namasupplier) like lower('%" . $pencairan . "%')";
        } else if ($jenispencarian == '3') {
            $sqlcriteria = "and lower(noinvoice) like  lower('%" . $pencairan . "%')";
        }

        $data = $this->history_pembelian_model->tampilhistoryap($this->input->post('jenisfaktur'), $sqlcriteria, $this->input->post('kodecabang'), $this->input->post('kodecompany'), $this->input->post('kodesubcabang'), $this->input->post('kodegrupcabang'));
        echo json_encode($data);
    }

    function getdetailhistoryap()
    {
        $data = $this->history_pembelian_model->getdetailhistoryap($this->input->post('jenisfaktur'), $this->input->post('nomororder'), $this->input->post('nomorfaktur'));
        echo json_encode($data);
    }

    function GetDetailHistoryDetail()
    {
        $empty = 'Data Empty';
        $data = $this->history_pembelian_model->GetDetailHistoryDetail($this->input->post('nomorfaktur'), $this->input->post('jenisfaktur'), $empty);
        echo json_encode($data);
    }

    function getdetailhistorysparepart()
    {
        $data = $this->history_pembelian_model->getdetailhistorysparepart($this->input->post('nofaktur'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }

    function getdetailpembebanansparepart()
    {
        $data = $this->history_pembelian_model->getdetailpembebanansparepart($this->input->post('nopo'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }

    function getdetailhistoryopl()
    {
        $data = $this->history_pembelian_model->getdetailhistoryopl($this->input->post('nofaktur'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }

    function gethistoryopl()
    {
        $data = $this->history_pembelian_model->gethistoryopl($this->input->post('nopo'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }

    function gethistorypenerimaankasir()
    {
        $data = $this->history_pembelian_model->gethistorypenerimaankasir($this->input->post('nomorfaktur'));
        echo json_encode($data);
    }

    function gethistorypenerimaankasirum()
    {
        $data = $this->history_pembelian_model->gethistorypenerimaankasirum($this->input->post('nomororder'));
        echo json_encode($data);
    }

    function gethistorypembatalanpenerimaankasir()
    {
        $data = $this->history_pembelian_model->gethistorypembatalanpenerimaankasir($this->input->post('nomorfaktur'));
        echo json_encode($data);
    }

    function gethistorywo()
    {
        $data = $this->history_pembelian_model->gethistorywo($this->input->post('nomororder'), $this->input->post('nomorfaktur'), $this->input->post('jenisfaktur'));
        echo json_encode($data);
    }
    
    function gethistorypermohonankasir()
    {
        $data = $this->history_pembelian_model->gethistorypermohonankasir($this->input->post('nomorfaktur'));
        echo json_encode($data);
    }

    function gethistorypermohonankasirum()
    {
        $data = $this->history_pembelian_model->gethistorypermohonankasirum($this->input->post('nomororder'));
        echo json_encode($data);
    }
}
