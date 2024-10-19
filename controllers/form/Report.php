<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('form/report_model');
		$this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function GetDataUrl()
	{
		$result =  $this->report_model->GetUrl($this->input->post('jenis'));
		echo json_encode($result);
	}

	public function getdatacabangreport()
	{
		$result =  $this->report_model->GetCabangGet($this->input->post('kodegrupcabang'), $this->input->post('kode'));
		echo json_encode($result);
	}

	function cekprintpdf()
	{
		$result =  $this->report_model->cekprintpdf($this->input->post('namareport'), $this->input->post('gruplogin'));
		echo json_encode($result);
	}

	function cekstatustanggal()
	{
		$result =  $this->report_model->cekstatustanggal($this->input->post('namareport'), $this->input->post('gruplogin'));
		echo json_encode($result);
	}

	public function report_penerimaan($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Report Penerimaan';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_penerimaan'] = $this->report_model->GetReportPenerimaan($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalPenerimaan($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_penerimaan', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_pengeluaran($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Report Pengeluaran';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_pengeluaran'] = $this->report_model->GetReportPengeluaran($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalPengeluaran($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_pengeluaran', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_spk($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Report Surat Perintah Kerja';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportSpk($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalSpk($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_spk', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_faktur($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));
		$kodecabang = $param[3];
		$kodegrup = $param[4];

		$nomor = 'Report Surat Perintah Kerja';

		if (!empty($tanggal)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['reportcabang'] = $this->report_model->GetCabang($kodegrup, $kodecabang);
			$data['totalsum'] = $this->report_model->GetTotalFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));
			// print_r($data['report_faktur']);
			// echo'<br>';
			// print_r($data['totalsum']);
			// die();
			$this->pdf->load_view('laporan/report_faktur', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_periodetgl($parameter = null, $loadview)
	{
		$param = explode(":", urldecode($parameter));

		$viewname = $param[0];
		$name = $param[1];
		$kodecabang = $param[3];
		$kodegrup = $param[4];
		$kodecompany = $param[4];
		$tglmulai = $param[5];
		$tglakhir = $param[6];
		$kodesubcabang = $param[7];

		if (!empty($parameter)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['reportcabang'] = $this->report_model->GetCabang($kodegrup, $kodecabang);
			$data['report'] = $this->report_model->GetReportPeriodeTgl($tglmulai, $tglakhir, $kodecabang, $kodecompany, $viewname, $kodegrup, $kodesubcabang);
			$data['tglmulai'] = date('d-M-Y', strtotime($tglmulai));
			$data['tglakhir'] = date('d-M-Y', strtotime($tglakhir));

			$old_limit = ini_set("memory_limit", "1000M");

			if ($name == "Laporan Faktur Service") {
				$this->load->view('laporan/' . $loadview, $data, $name, $paper, $orientation);
			} else {
				$this->pdf->load_view('laporan/' . $loadview, $data, $name, $paper, $orientation);
			}
			// $html = $this->load->view('laporan/' . $loadview, $data, $nomor);
			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			// $this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			// $this->pdf->render();

			// // Output akan menghasilkan PDF (1 = download dan 0 = preview)
			// $this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			// exit(0);
		}
	}

	public function report_fakturdetail($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Report Surat Perintah Kerja';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));
			$this->pdf->load_view('laporan/report_fakturdetail', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_opl($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Report Surat Perintah Kerja';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));
			$this->pdf->load_view('laporan/report_opl', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_fakturcounter($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan Faktur Part Counter';

		if (!empty($tanggal)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFakturCounter($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalFakturCounter($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_fakturcounter', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('legal', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_fakturpenerimaan($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan Faktur dan Penerimaan';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFakturPenerimaan($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalFakturPenerimaan($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_fakturpenerimaan', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_historypart($parameter = null)
	{

		$param = explode(":", urldecode($parameter));
		// print_r($parameter);
		// die();
		$nomor = 'History Sparepart';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['history_sparepart'] = $this->report_model->GetHistorySparepart($param[6], $param[7], $param[5], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalHistorySparepart($param[6], $param[7], $param[5], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[6]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[7]));

			$this->pdf->load_view('laporan/report_historypart', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_pembebanan($parameter = null)
	{

		$param = explode(":", urldecode($parameter));

		// $kodeCabang = base64_decode($param[3]);

		$nomor = 'Laporan Pembebanan';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_pembebanan'] = $this->report_model->GetReportPembebanan($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_pembebanan', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_booking($parameter = null)
	{

		$param = explode(":", urldecode($parameter));

		$nomor = 'Laporan Booking Service';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_booking'] = $this->report_model->GetReportBooking($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_booking', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_inventorystock($parameter = null)
	{

		$param = explode(":", urldecode($parameter));

		$nomor = 'Laporan Inventory Stock Parts';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_inventorystockpart'] = $this->report_model->GetReportInventoryStockPart($param[5], $param[3], $param[4], $param[0]);
			$data['totalsuminventorystock'] = $this->report_model->GetTotalInventorySTock($param[5], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('M-Y', strtotime($param[5]));

			$this->pdf->load_view('laporan/report_inventorystock', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_bag($parameter = null)
	{

		$param = explode(":", urldecode($parameter));

		$nomor = 'Laporan BAG IN Dan BAG OUT';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_bag'] = $this->report_model->GetReportBAG($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_bag', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_permohonanuang($parameter = null)
	{

		$param = explode(":", urldecode($parameter));

		$nomor = 'Laporan Permohonan Pengeluaran Uang';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_permohonanuang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_podanpenerimaan($parameter = null)
	{

		$param = explode(":", urldecode($parameter));

		$nomor = 'Laporan PO dan Penerimaan Sparepart';;

		if (!empty($parameter)) {

			$paper = 'Legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_podanpenerimaan', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_podanpenerimaandetail($parameter = null)
	{

		$param = explode(":", urldecode($parameter));

		$nomor = 'Laporan PO dan Penerimaan Sparepart Detail';;

		if (!empty($parameter)) {

			$paper = 'Legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_podanpenerimaandetail', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}


	public function report_pembeliandanpenjualanpart($parameter = null)
	{

		$param = explode(":", urldecode($parameter));

		$nomor = 'Laporan Pembelian dan Penjualan Part';

		if (!empty($parameter)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_rekapitulasistockpart'] = $this->report_model->GetReportRekapitulasiStock($param[5], $param[3], $param[4], $param[0]);
			$data['totalsumrekapitulasistockpart'] = $this->report_model->GetTotalRekapitulasiStock($param[5], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('M-Y', strtotime($param[5]));

			$this->pdf->load_view('laporan/report_pembeliandanpenjualanpart', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_fakturcountersummary($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan Faktur Part Counter';

		if (!empty($tanggal)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_faktur'] = $this->report_model->GetReportFakturCounter($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_fakturcountersummary', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('legal', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_partcounterorder($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan Order Part Counter ';

		if (!empty($tanggal)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_order'] = $this->report_model->GetReportOrderCounter($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_ordercounter', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('legal', 'landscape');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_mutasipiutang($parameter = null)
	{

		$param = explode(":", urldecode($parameter));
		$nomor = 'Laporan Mutasi Piutang';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report'] = $this->report_model->GetReportMutasiPiutang($param[5], $param[3], $param[4], $param[0]);
			$data['totalreport'] = $this->report_model->GetReportMutasiPiutangTotal($param[5], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('M-Y', strtotime($param[5]));

			$this->pdf->load_view('laporan/report_mutasipiutang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_mutasihutang($parameter = null)
	{

		$param = explode(":", urldecode($parameter));
		$nomor = 'Laporan Mutasi Hutang';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report'] = $this->report_model->GetReportMutasiHutang($param[5], $param[3], $param[4], $param[0]);
			$data['totalreport'] = $this->report_model->GetReportMutasiHutangTotal($param[5], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('M-Y', strtotime($param[5]));

			$this->pdf->load_view('laporan/report_mutasihutang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_mutasium($parameter = null)
	{

		$param = explode(":", urldecode($parameter));
		$nomor = 'Laporan Mutasi Uang Muka';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report'] = $this->report_model->GetReportMutasiUM($param[5], $param[3], $param[4], $param[0]);
			$data['totalreport'] = $this->report_model->GetReportMutasiUMTotal($param[5], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('M-Y', strtotime($param[5]));

			$this->pdf->load_view('laporan/report_mutasium', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}


	public function report_mutasiumpembelian($parameter = null)
	{

		$param = explode(":", urldecode($parameter));
		$nomor = 'Laporan Mutasi Uang Muka Pembelian';

		if (!empty($parameter)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report'] = $this->report_model->GetReportMutasiUMPembelian($param[5], $param[3], $param[4], $param[0]);
			$data['totalreport'] = $this->report_model->GetReportMutasiUMTotalPembelian($param[5], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('M-Y', strtotime($param[5]));

			$this->pdf->load_view('laporan/report_mutasiumpembelian', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_wobelumfaktur($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan WO belum Faktur ';

		if (!empty($tanggal)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_wobelumfaktur'] = $this->report_model->GetReportWObelumFaktur($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_wobelumfaktur', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('legal', 'landscape');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_wobatal($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Report Surat Perintah Kerja';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportWoBatal($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalWoBatal($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_wobatal', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_woharian($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan WO Harian Open';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportWO($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['totalsum'] = $this->report_model->GetTotalWO($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_woharianopen', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_umurpiutang($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan Daftar Umur Piutang';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportAR($param[5], $param[3], $param[4], $param[0]);

			$this->pdf->load_view('laporan/report_umurpiutang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_umurhutang($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan Daftar Umur Hutang';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportAR($param[5], $param[3], $param[4], $param[0]);

			$this->pdf->load_view('laporan/report_umurhutang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_detailum($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan Uang Muka';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportUM($param[5], $param[6], $param[3], $param[4], $param[0]);

			$this->pdf->load_view('laporan/report_detailum', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_pobeluminvoice($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan PO Belum Invoice';

		if (!empty($tanggal)) {

			$paper = 'A4';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportBelumInvoice($param[5], $param[3], $param[4], $param[0]);

			$this->pdf->load_view('laporan/report_pobeluminvoice', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_statuspekerjaan($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan PO Belum Invoice';

		if (!empty($tanggal)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportUM($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_statuspekerjaan', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function report_penghapusanarap($tanggal = null)
	{

		$param = explode(":", urldecode($tanggal));

		$nomor = 'Laporan Penghapusan AR AP';

		if (!empty($tanggal)) {

			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['report_spk'] = $this->report_model->GetReportUM($param[5], $param[6], $param[3], $param[4], $param[0]);
			$data['tglmulai'] = date('d-M-Y', strtotime($param[5]));
			$data['tglakhir'] = date('d-M-Y', strtotime($param[6]));

			$this->pdf->load_view('laporan/report_penghapusanarap', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}


	// --------------- Controller Form Export Data -----------------
	function SPKDetail()
	{
		$data = $this->report_model->GetSPKDetail($this->input->post('tglmulai'), $this->input->post('tglakhir'), $this->input->post('kodecabang'), $this->input->post('kodecompany'));
		echo json_encode($data);
	}


	function ARdetail()
	{
		$data = $this->report_model->GetARdetail($this->input->post('kodecabang'), $this->input->post('kodecompany'));
		echo json_encode($data);
	}

	function APdetail()
	{
		$data = $this->report_model->GetAPdetail($this->input->post('kodecabang'), $this->input->post('kodecompany'));
		echo json_encode($data);
	}
	
	public function findjenisreport()
	{
		echo json_encode($this->report_model->findjenisreport($this->input->post('jenis')));
	}
	public function findreport()
	{
		echo json_encode($this->report_model->findreport($this->input->post('jenis'), $this->input->post('grup')));
	}
	public function getIdReport()
	{

		echo json_encode($this->report_model->getIdReport($this->input->post('jenis')));
	}

	
	public function carijenisreport()
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
						// $sub_array[] = '<button class="btn btnt-info btn-xs searchcustomer" data-id="'.$msearch.'"><i class="fas fa-plus"></i>&nbsp;<i class="fas fa-angle-double-right"></i></button> ';  
						$sub_array[] = '<button class="btn btn-success searchjenisreport" data-id="' . $msearch . '"  data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

	// get data report from table stpm_report
	function CariDataReport()
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
						$sub_array[] = '<button class="btn btn-success searchreport" data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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

	// get data cabang from table glbm_cabang
	function caridatacabang()
	{
		$fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
		$idrow = $this->input->post('idrow');
		$data = array();
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$i = 1;
			$count = count($this->input->post('field'));
			foreach ($this->input->post('field') as $key => $value) {
				if ($i <= $count) {
					if ($i == 1) {
						$msearch = $row->$value;
						$sub_array[] = '<button class="btn btn-primary ' . $idrow . ' " data-id="' . $msearch . '" data-dismiss="modal"><i class="fa fa-hand-o-right"></i></button> ';
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
}
