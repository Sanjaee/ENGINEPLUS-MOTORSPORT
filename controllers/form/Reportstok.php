<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportstok extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('form/reportstok_model');
        $this->load->model('caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function datastok()
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
						// $sub_array[] = '<button class="btn btn-primary searchcabang" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
    
    function export()
    {


        $part =  $this->input->post('kodepart');
        $kodecompany = $this->input->post('kodecompany');
        // $cabang = $this->input->post('cabang');


        // $dataabsen = $this->list_absensi_model->getdatafind($tglawal, $tglakhir, $cabang);
        $periode = date("Ym");


        $data = array(
            'title' => 'reportstok' . $periode,
            'buku' => $this->reportstok_model->getdatafind($part, $kodecompany)
        );

        $this->load->view('menu/stok/excel_reportstok', $data);
    }

    public function GetDataUrl()
    {
        $result =  $this->reportstok_model->GetUrl($this->input->post('jenis'));
        echo json_encode($result);
    }

	public function GetDataParts()
	{
		$result =  $this->reportstok_model->GetParts($this->input->post('kode'),$this->input->post('kodecompany'));
		echo json_encode($result);
    }
}
