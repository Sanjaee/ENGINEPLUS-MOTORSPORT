<?php
ini_set('max_execution_time', 1000);
ini_set('memory_limit', '800M');
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('form/report_model');
        $this->load->model('caridataaktif_model');
        $this->load->model('form/form_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function GetDataUrl()
    {
        $result =  $this->report_model->GetUrl($this->input->post('jenis'));
        echo json_encode($result);
    }

    public function report_spk($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportSpk($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['totalsum'] = $this->report_model->GetTotalSpk($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_spk', $data);
        }
    }

    public function report_faktur($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['totalsum'] = $this->report_model->GetTotalFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_faktur', $data);
        }
    }

    public function report_fakturdetail($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_fakturdetail', $data);
        }
    }

    public function report_opl($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_opl', $data);
        }
    }

    public function report_pengeluaran($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_pengeluaran'] = $this->report_model->GetReportPengeluaran($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['totalsum'] = $this->report_model->GetTotalPengeluaran($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_pengeluaranuang', $data);
        }
    }

    public function report_penerimaan($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_penerimaan'] = $this->report_model->GetReportPenerimaan($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['totalsum'] = $this->report_model->GetTotalPenerimaan($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_penerimaanuang', $data);
        }
    }

    public function report_fakturcounter($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFakturCounter($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['totalsum'] = $this->report_model->GetTotalFakturCounter($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_fakturcounter', $data);
        }
    }

    public function report_fakturpenerimaan($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFakturPenerimaan($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['totalsum'] = $this->report_model->GetTotalFakturPenerimaan($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_fakturpenerimaan', $data);
        }
    }

    public function report_historypart($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['history_sparepart'] = $this->report_model->GetHistorySparepart($param[6], $param[7], $param[5], $param[3], $param[4], $param[0]);
            $data['totalsum'] = $this->report_model->GetTotalHistorySparepart($param[6], $param[7], $param[5], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_historypart', $data);
        }
    }

    public function report_pembebanan($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_pembebanan'] = $this->report_model->GetReportPembebanan($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_pembebanan', $data);
        }
    }

    public function report_booking($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_booking'] = $this->report_model->GetReportBooking($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_booking', $data);
        }
    }

    public function report_inventorystock($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_inventorystockpart'] = $this->report_model->GetReportInventoryStockPart($param[5], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('M-Y', strtotime($param[5]));

            $this->load->view('excel_report/excel_report_inventorystockpart', $data);
        }
    }

    public function masterjasa($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        // $namareport = $param[1];

        if (!empty($param)) {

            $data['jasa'] = $this->report_model->GetMasterJasa();
            $data['namareport'] = 'Master Data Jasa';
            $data['title'] = 'Master Data Jasa';

            $this->load->view('excel_report/excel_masterjasa', $data);
        }
    }

    public function masterjasadetail($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        // $namareport = $param[1];

        if (!empty($param)) {

            $data['jasa'] = $this->report_model->GetMasterJasaDetail();
            $data['namareport'] = 'Master Data Jasa Detail';
            $data['title'] = 'Master Data Jasa Detail';

            $this->load->view('excel_report/excel_masterjasadetail', $data);
        }
    }

    public function masterpart($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $periode =  date("Y") . date("m");
        if (!empty($param)) {

            $data['masterpart'] = $this->report_model->GetReportMasterPart($param[0], $param[1], $periode);
            $data['namareport'] = 'Master Sparepart';
            $data['title'] = 'Master Sparepart';

            $this->load->view('excel_report/excel_report_masterpart', $data);
        }
    }

    public function masteropl($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        if (!empty($param)) {

            $data['masteropl'] = $this->report_model->GetReportMasterOpl($param[0], $param[1]);
            $data['namareport'] = 'Master OPL';
            $data['title'] = 'Master OPL';

            $this->load->view('excel_report/excel_report_masteropl', $data);
        }
    }

    
    public function masterjasatipe($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        if (!empty($param)) {

            $data['masterjasatipe'] = $this->report_model->GetReportMasterJasaTipe($param[0], $param[1]);
            $data['namareport'] = 'Master Jasa Tipe';
            $data['title'] = 'Master Jasa Tipe';

            $this->load->view('excel_report/excel_report_masterjasatipe', $data);
        }
    }

    public function report_bag($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportBAG($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_bag', $data);
        }
    }

    public function report_permohonanuang($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_permohonanuang', $data);
        }
    }

	public function report_periodetgl($datalempar = null, $loadviewexcel)
    {

        $param = explode(":", urldecode($datalempar));

        $viewname = $param[0];
		$name = $param[1];
		$kodecabang = $param[3];
		$kodegrup = $param[4];
		$kodecompany = $param[4];
		$tglmulai = $param[5];
		$tglakhir = $param[6];
		$kodesubcabang = $param[7];

        if (!empty($param)) {
			$data['reportcabang'] = $this->report_model->GetCabang($kodegrup, $kodecabang);
            $data['report'] = $this->report_model->GetReportPeriodeTgl($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname, $kodegrup, $kodesubcabang);
            $data['namareport'] = $name;
            $data['title'] = $name;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));
			
            $this->load->view('excel_report/' . $loadviewexcel, $data);
        }
    }

    public function report_podanpenerimaan($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_podanpenerimaan', $data);
        }
    }

    public function report_podanpenerimaandetail($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_podanpenerimaandetail', $data);
        }
    }

    public function report_pembeliandanpenjualanpart($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = 'Laporan Penjualan dan Pembelian Parts';

        if (!empty($param)) {

            $data['report_rekapitulasistockpart'] = $this->report_model->GetReportRekapitulasiStock($param[5], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));

            $this->load->view('excel_report/excel_report_pembeliandanpenjualanpart', $data);
        }
    }

    public function report_fakturcountersummary($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_faktur'] = $this->report_model->GetReportFakturCounter($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_fakturcountersummary', $data);
        }
    }

    public function report_partcounterorder($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_order'] = $this->report_model->GetReportOrderCounter($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_ordercounter', $data);
        }
    }

    public function report_mutasipiutang($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report'] = $this->report_model->GetReportMutasiPiutang($param[5], $param[3], $param[4], $param[0]);
            $data['totalreport'] = $this->report_model->GetReportMutasiPiutangTotal($param[5], $param[3], $param[4], $param[0]);
            $data['tglmulai'] = date('M-Y', strtotime($param[5]));
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $this->load->view('excel_report/excel_report_mutasipiutang', $data);
        }
    }

    public function report_mutasihutang($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report'] = $this->report_model->GetReportMutasiHutang($param[5], $param[3], $param[4], $param[0]);
            $data['totalreport'] = $this->report_model->GetReportMutasiHutangTotal($param[5], $param[3], $param[4], $param[0]);
            $data['tglmulai'] = date('M-Y', strtotime($param[5]));
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $this->load->view('excel_report/excel_report_mutasihutang', $data);
        }
    }

    public function report_mutasium($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report'] = $this->report_model->GetReportMutasiUM($param[5], $param[3], $param[4], $param[0]);
            $data['totalreport'] = $this->report_model->GetReportMutasiUMTotal($param[5], $param[3], $param[4], $param[0]);
            $data['tglmulai'] = date('M-Y', strtotime($param[5]));
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $this->load->view('excel_report/excel_report_mutasium', $data);
        }
    }

    public function report_mutasiumpembelian($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report'] = $this->report_model->GetReportMutasiUMPembelian($param[5], $param[3], $param[4], $param[0]);
            $data['totalreport'] = $this->report_model->GetReportMutasiUMTotalPembelian($param[5], $param[3], $param[4], $param[0]);
            $data['tglmulai'] = date('M-Y', strtotime($param[5]));
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $this->load->view('excel_report/excel_report_mutasiumpembelian', $data);
        }
    }

    public function cetak_faktur($nomor = null)
    {
        if (!empty($nomor)) {

            $data['faktur'] = $this->form_model->GetDataPrintFaktur($nomor);
            $data['subjasafaktur'] = $this->form_model->GetDataPrintSubJasaFaktur($nomor);
            $data['detailfaktur'] = $this->form_model->GetDataPrintFakturDetail($nomor);
            $data['subpartfaktur'] = $this->form_model->GetDataPrintSubPartFaktur($nomor);
            $data['detailfakturp'] = $this->form_model->GetDataPrintFakturDetailP($nomor);
            $data['namareport'] = 'Faktur Service';
            $data['title'] = 'Faktur Service';
            $this->load->view('excel_report/excel_form_fakturservice', $data);
        }
    }

    public function cetak_closewo($nomor = null)
    {
        if (!empty($nomor)) {

            $data['closewo'] = $this->form_model->GetDataPrintCloseWO($nomor);
            $data['detailwo'] = $this->form_model->GetDataPrintCloseWODetail($nomor);
            $data['detailpart'] = $this->form_model->GetDataPrintCloseWOPart($nomor);
            $data['totalwo'] = $this->form_model->GetDataPrintCloseWOTotal($nomor);

            $data['namareport'] = 'Close WO ' . $nomor;
            $data['title'] = 'Close WO ' . $nomor;
            $this->load->view('excel_report/excel_form_closewo', $data);
        }
    }

    public function report_wobelumfaktur($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_wobelumfaktur'] = $this->report_model->GetReportWObelumFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['totalreport_wobelumfaktur'] = $this->report_model->GetReportWObelumFakturTotal($param[5], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_wobelumfaktur', $data);
        }
    }

    public function report_wobatal($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportWoBatal($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalWoBatal($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_wobatal', $data);
        }
    }

    public function report_woharian($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportWO($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['totalsum'] = $this->report_model->GetTotalWO($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_woharianopen', $data);
        }
    }

    public function report_umurpiutang($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportAR($param[5], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;

            $this->load->view('excel_report/excel_report_umurpiutang', $data);
        }
    }

    public function report_umurhutang($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportAR($param[5], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;

            $this->load->view('excel_report/excel_report_umurhutang', $data);
        }
    }

    public function report_detailum($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportUM($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_detailum', $data);
        }
    }

    
    public function report_pobeluminvoice($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportBelumInvoice($param[5], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;

            $this->load->view('excel_report/excel_report_pobeluminvoice', $data);
        }
    }

    public function report_statuspekerjaan($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportUM($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_statuspekerjaan', $data);
        }
    }

    public function cetak_fakturpartcounter($nomor = null)
    {
        if (!empty($nomor)) {
            $data['counter'] = $this->form_model->GetDataPrintPartCounterFaktur($nomor);
			$data['counterdetail'] = $this->form_model->GetDataPrintPartCounterFakturDetail($nomor);
            $data['namareport'] = 'Faktur Part Counter';
            $data['title'] = 'Faktur Part Counter';
            $this->load->view('excel_report/excel_form_fakturpartcounter', $data);
        }
    }

    
    public function mastercustomer($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = 'Laporan Master Customer';
        $cabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');

        if (!empty($param)) {

            $data['report'] = $this->report_model->GetDataCustomer($cabang,$kodecompany);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;

            $this->load->view('excel_report/excel_report_customer', $data);
        }
    }

    public function mastersupplier($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = 'Laporan Master Supplier';
        $cabang = $this->session->userdata('mycabang');
        $kodecompany = $this->session->userdata('mycompany');

        if (!empty($param)) {

            $data['report'] = $this->report_model->GetDataSupplier($cabang,$kodecompany);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;

            $this->load->view('excel_report/excel_report_supplier', $data);
        }
    }

    
	public function cetak_workshopAR_GR($nama = null)
	{
		
		$param = explode(":", urldecode($nama));
		if (!empty($nama)) {
			$paper = 'letter';
			$orientation = 'landscape'; 
            $namareport = 'Laporan Control AR Service';
			$kodecabang = $this->session->userdata('mycabang');
			$kodesubcabang = $this->session->userdata('mysubcabang');
			$kodecompany = $this->session->userdata('mycompany');

			$data['workshopardetail'] = $this->form_model->GetDataWorkshopARDetail_GR($param[0],$param[1],$param[2],$param[3], $kodecabang, $kodesubcabang, $kodecompany);
		    $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            
            $data['tglmulai'] = date('d-M-Y', strtotime($param[1]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[2]));
            $this->load->view('excel_report/excel_cetak_workshopar_gr', $data);
		}
	}

	public function cetak_workshopAR_PartCounter($nama = null)
	{
		$param = explode(":", urldecode($nama));
		if (!empty($nama)) {
			$paper = 'A4';
			$orientation = 'landscape';
            $namareport = 'Laporan Control AR Part Counter';
			$kodecabang = $this->session->userdata('mycabang');
			$kodesubcabang = $this->session->userdata('mysubcabang');
			$kodecompany = $this->session->userdata('mycompany');

			$data['workshopardetail2'] = $this->form_model->GetDataWorkshopARDetail_PartCounter($param[0],$param[1],$param[2],$param[3], $kodecabang, $kodecompany);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            
            $data['tglmulai'] = date('d-M-Y', strtotime($param[1]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[2]));
            $this->load->view('excel_report/excel_cetak_workshopar_partcounter', $data);
		}
	}
	
	public function cetak_workshopAR_WOOpen($nama = null)
	{
		$param = explode(":", urldecode($nama));
		if (!empty($nama)) {
			$paper = 'A4';
			$orientation = 'landscape';
			$kodecabang = $this->session->userdata('mycabang');
			$kodesubcabang = $this->session->userdata('mysubcabang');
			$kodecompany = $this->session->userdata('mycompany');
            $namareport = 'Laporan Control WO OPEN';

			$data['workshopar_woopen'] = $this->form_model->GetDataWorkshopARDetail_WOOpen($param[0], $kodecabang, $kodecompany);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $this->load->view('excel_report/excel_cetak_workshopar_woopen', $data);

		}
	}

	public function cetak_workshopAP_PartCounter($nama = null)
	{
		$param = explode(":", urldecode($nama));
		if (!empty($nama)) {
			$paper = 'A4';
			$orientation = 'landscape';
			$kodecabang = $this->session->userdata('mycabang');
			$kodesubcabang = $this->session->userdata('mysubcabang');
			$kodecompany = $this->session->userdata('mycompany');

            $namareport = 'Laporan Control AP Part';
			$namasupplier =  urldecode($nama);
			$data['workshopap_part'] = $this->form_model->GetDataWorkshopAPDetail_PartCounter($param[0],$param[1],$param[2],$param[3],  $kodecabang, $kodesubcabang, $kodecompany);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            
            $data['tglmulai'] = date('d-M-Y', strtotime($param[1]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[2]));
            $this->load->view('excel_report/excel_cetak_workshopap_partcounter', $data);
		}
	}

	public function cetak_workshopAP_OPL($nama = null)
	{
		$param = explode(":", urldecode($nama));
		if (!empty($nama)) {
			$paper = 'A4';
			$orientation = 'landscape';
			$kodecabang = $this->session->userdata('mycabang');
			$kodesubcabang = $this->session->userdata('mysubcabang');
			$kodecompany = $this->session->userdata('mycompany');

            $namareport = 'Laporan Control AP OPL';

			$namasupplier =  urldecode($nama);
			$data['workshopap_opl'] = $this->form_model->GetDataWorkshopAPDetail_OPL($param[0],$param[1],$param[2],$param[3], $kodecabang, $kodesubcabang, $kodecompany);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            
            $data['tglmulai'] = date('d-M-Y', strtotime($param[1]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[2]));
            $this->load->view('excel_report/excel_cetak_workshopap_opl', $data);
		}
	}

    public function report_penghapusanarap($datalempar = null)
    {
        $param = explode(":", urldecode($datalempar));
        $namareport = $param[1];

        if (!empty($param)) {

            $data['report_spk'] = $this->report_model->GetReportUM($param[5], $param[6], $param[3], $param[4], $param[0]);
            $data['namareport'] = $namareport;
            $data['title'] = $namareport;
            $data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
            $data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

            $this->load->view('excel_report/excel_report_penghapusanarap', $data);
        }
    }
}
