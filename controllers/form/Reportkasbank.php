<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reportkasbank extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("form/reportkasbank_model");
        $this->load->model("caridataaktif_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function dataaccount()
    {
        $result = $this->reportkasbank_model->dataaccount($this->input->post('nomor'));
        echo json_encode($result);
    }

    function cariaccount()
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
                        $sub_array[] = '<button class="btn btn-primary searchaccount" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

    function tampillaporankasbank()
    {
        $nomor = $this->input->post('nomor');
        $tglawal = $this->input->post('tglawal');
        $tglakhir = $this->input->post('tglakhir');
        $kodecabang = $this->input->post('kodecabang');
        $kodecompany = $this->input->post('kodecompany');
        $result = $this->reportkasbank_model->tampillaporankasbank($nomor, $tglawal, $tglakhir, $kodecabang, $kodecompany);
        $data = [];
        $dataarray = [];
        $j = 0;
        $saldoakhir = 0;
        foreach ($result as $key => $value) {
            $j++;
            $i = 1;
            foreach ($this->input->post('field') as $key => $value2) {
                if ($i == 1) {
                    $dataarray[] = $j;
                    $dataarray[] = $value->$value2;
                } else if ($i == 6) {
                    // $dataarray[] = $value->$value2;
                    $dataarray[] =  "<div align='right'> Rp " . number_format($value->$value2, 0, ',', '.') . "</div>";
                    $saldoakhir = $saldoakhir + $value->$value2;
                } else if ($i == 7) {
                    // $dataarray[] = $value->$value2;
                    $dataarray[] =  "<div align='right'> Rp " . number_format($value->$value2 * -1, 0, ',', '.') . "</div>";
                    $saldoakhir = $saldoakhir - $value->$value2;
                } else {
                    $dataarray[] = $value->$value2;
                }
                $i++;
            }
            $data[] = $dataarray;
            $dataarray = [];
        }

        $total =  $j + 1;
        // Saldo Akhir di ambil manual
        $dataarray[] = $total;
        $dataarray[] = date('d/m/Y', strtotime($this->input->post('tglakhir')));
        $dataarray[] = "Saldo Akhir";
        $dataarray[] = "";
        // $dataarray[] = $nomor;
        $dataarray[] = "";
        $dataarray[] = "Saldo Akhir Tanggal " . date('d/m/Y', strtotime($this->input->post('tglakhir')));
        if ($saldoakhir > 0) {
            // $dataarray[] = $saldoakhir;
            $dataarray[] =  "<div align='right'> Rp " . number_format($saldoakhir, 0, ',', '.') . "</div>";
            $dataarray[] = "<div align='right'> Rp 0 </div>";
        } else {
            $dataarray[] = "<div align='right'> Rp 0 </div>";
            $dataarray[] =  "<div align='right'> Rp " . number_format($saldoakhir, 0, ',', '.') . "</div>";
            // $dataarray[] = $saldoakhir;
        }
        // --------------------- END ----------------------------------------------------------------------------
        $data[] = $dataarray;
        $output = array(
            "draw"                =>    intval($_POST["draw"]),
            "recordsTotal"        =>    $total,
            "recordsFiltered"     =>    $total,
            "data"                =>    $data
        );
        echo json_encode($output);
    }

    public function report_kasbank($parameter = null){
		$param = explode(":",urldecode($parameter));
		// print_r($parameter);
		// die();
		$nomor = 'Report Kas & Bank';

		if (!empty($parameter)){
		
			$paper = 'A4';
			$orientation = 'landscape';
			
			// menggunakan class dompdf
            // print_r($param[3]);
            // die();
			$this->load->library('pdf');

			$data['report_kas_bank'] = $this->reportkasbank_model->tampillaporankasbank($param[1], $param[2], $param[3], $param[5], $param[4]);
            $data['sumkasbank'] = $this->reportkasbank_model->saldoakhirlaporankasbank($param[1], $param[2], $param[3], $param[5], $param[4]);
			$data['tglawal'] = date('d-M-Y',strtotime($param[2]));
			$data['tglakhir'] = date('d-M-Y',strtotime($param[3]));
            $data['nama'] = $param[6];
            $data['nomor'] = $param[1];

			$this->pdf->load_view('laporan/report_kasbank', $data, $nomor, $paper, $orientation);
					
			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment"=>0));

			exit(0);
		}

	}

    function export($parameter = null)
    {
        $param = explode(":",urldecode($parameter));
		// print_r($parameter);
		// die();
		$title = 'Report Kas & Bank';

        $data['report_kas_bank'] = $this->reportkasbank_model->tampillaporankasbank($param[1], $param[2], $param[3], $param[5], $param[4]);
        $data['sumkasbank'] = $this->reportkasbank_model->saldoakhirlaporankasbank($param[1], $param[2], $param[3], $param[5], $param[4]);
        $data['tglawal'] = date('d-M-Y',strtotime($param[2]));
        $data['tglakhir'] = date('d-M-Y',strtotime($param[3]));
        $data['nama'] = $param[6];
        $data['nomor'] = $param[1];
        $data['title'] = 'Report Kas & Bank';

        $this->load->view('menu/reportkasbank/excel_kasbank', $data);
    }
}
