<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('form/form_model');
		$this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function cetak_spk($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['spk'] = $this->form_model->GetDataPrintSPK($nomor);
			$data['spksub'] = $this->form_model->GetDataPrintSub($nomor);
			$data['spkjasa'] = $this->form_model->GetDataPrintJasa($nomor);
			$data['spksubpart'] = $this->form_model->GetDataPrintSubPart($nomor);
			$data['spkpart'] = $this->form_model->GetDataPrintPart($nomor);

			$this->pdf->load_view('laporan/cetak_spk', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_spkpkb($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['spk'] = $this->form_model->GetDataPrintSPK($nomor);
			$data['spkjasa'] = $this->form_model->GetDataPrintJasa($nomor);
			$data['spkpart'] = $this->form_model->GetDataPrintPart($nomor);

			$this->pdf->load_view('laporan/cetak_spkpkb', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_permohonanuang($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['permohonan'] = $this->form_model->GetDataPrintPermohonan($nomor);

			$data['detail'] = $this->form_model->GetDataPrintPermohonanDetail($nomor);


			$this->pdf->load_view('laporan/cetak_permohonanuang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_penerimaan($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['penerimaan'] = $this->form_model->GetDataPrintPenerimaan($nomor);

			$data['detail'] = $this->form_model->GetDataPrintPenerimaanDetail($nomor);

			$this->pdf->load_view('laporan/cetak_penerimaankasir', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_pencairan($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['pencairan'] = $this->form_model->GetDataPrintPencairan($nomor);

			$data['detail'] = $this->form_model->GetDataPrintPencairanDetail($nomor);


			$this->pdf->load_view('laporan/cetak_pencairankartu', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_pembebanan($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'Letter';
			$orientation = 'potrait';
			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['pembebanan'] = $this->form_model->GetDataPrintPembebanan($nomor);
			$data['detail'] = $this->form_model->GetDataPrintPembebananDetail($nomor);
			// $data['spkjasa'] = $this->entry_spk_model->GetDataPrintJasa($nomor);

			$this->pdf->load_view('laporan/cetak_pembebanan', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_faktur($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'Letter';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['faktur'] = $this->form_model->GetDataPrintFaktur($nomor);
			$data['subjasafaktur'] = $this->form_model->GetDataPrintSubJasaFaktur($nomor);
			$data['detailfaktur'] = $this->form_model->GetDataPrintFakturDetail($nomor);
			$data['subpartfaktur'] = $this->form_model->GetDataPrintSubPartFaktur($nomor);
			$data['detailfakturp'] = $this->form_model->GetDataPrintFakturDetailP($nomor);

			$this->pdf->load_view('laporan/cetak_faktur', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_opl($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['opl'] = $this->form_model->GetDataPrintOPL($nomor);
			$data['detailopl'] = $this->form_model->GetDataPrintOPLDetail($nomor);

			$this->pdf->load_view('laporan/cetak_opl', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_orderpart($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['order'] = $this->form_model->GetDataPrintOrderPart($nomor);
			$data['detailorder'] = $this->form_model->GetDataPrintOrderPartDetail($nomor);

			$this->pdf->load_view('laporan/cetak_orderpart', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_penerimaanpart($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['penerimaan'] = $this->form_model->GetDataPrintPenerimaanPart($nomor);
			$data['detailpenerimaan'] = $this->form_model->GetDataPrintPenerimaanPartDetail($nomor);

			$this->pdf->load_view('laporan/cetak_penerimaanpart', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_orderingpartcounter($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['counter'] = $this->form_model->GetDataPrintPartCounterOrder($nomor);
			$data['counterdetail'] = $this->form_model->GetDataPrintPartCounterOrderDetail($nomor);

			$this->pdf->load_view('laporan/cetak_ordercounter', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_fakturpartcounter($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['counter'] = $this->form_model->GetDataPrintPartCounterFaktur($nomor);
			$data['counterdetail'] = $this->form_model->GetDataPrintPartCounterFakturDetail($nomor);

			$this->pdf->load_view('laporan/cetak_fakturcounter', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_requestcabang($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['cabang'] = $this->form_model->GetDataPrintRequestCabang($nomor);
			$data['cabangdetail'] = $this->form_model->GetDataPrintRequestCabangDetail($nomor);

			$this->pdf->load_view('laporan/cetak_requestcabang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_transfercabang($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['transfer'] = $this->form_model->GetDataPrintTransferCabang($nomor);
			$data['transferdetail'] = $this->form_model->GetDataPrintTransferCabangDetail($nomor);

			$this->pdf->load_view('laporan/cetak_transfercabang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}


	public function cetak_transfertoho($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['transfer'] = $this->form_model->GetDataPrintTransferToHO($nomor);
			$data['transferdetail'] = $this->form_model->GetDataPrintTransferToHODetail($nomor);

			$this->pdf->load_view('laporan/cetak_transfertoho', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_stockopname($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['opname'] = $this->form_model->GetDataPrintStockOpname($nomor);
			$data['opnamedetail'] = $this->form_model->GetDataPrintStockOpnameDetail($nomor);

			$this->pdf->load_view('laporan/cetak_stockopname', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_bag($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['bag'] = $this->form_model->GetDataPrintBag($nomor);
			$data['bagdetail'] = $this->form_model->GetDataPrintBagDetail($nomor);

			$this->pdf->load_view('laporan/cetak_bag', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_booking($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['booking'] = $this->form_model->GetDataPrintBooking($nomor);
			$data['bookingdetail'] = $this->form_model->GetDataPrintBookingDetail($nomor);

			$this->pdf->load_view('laporan/cetak_booking', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_penerimaantransfer($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['penerimaan'] = $this->form_model->GetDataPrintPenerimaanTransfer($nomor);
			$data['penerimaandetail'] = $this->form_model->GetDataPrintPenerimaanTransferDetail($nomor);

			$this->pdf->load_view('laporan/cetak_penerimaantransfer', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_estimasi($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['spk'] = $this->form_model->GetDataPrintEst($nomor);

			$data['spkjasa'] = $this->form_model->GetDataPrintEstD($nomor);

			$data['spkpart'] = $this->form_model->GetDataPrintEstP($nomor);

			$this->pdf->load_view('laporan/cetak_estimasi', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_kwitansiterima($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['penerimaan'] = $this->form_model->GetDataPrintPenerimaan($nomor);

			$data['detail'] = $this->form_model->GetDataPrintPenerimaanDetail($nomor);

			$this->pdf->load_view('laporan/cetak_kwitansiterima', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_returpart($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['penerimaan'] = $this->form_model->GetDataPrintReturPart($nomor);
			$data['detailpenerimaan'] = $this->form_model->GetDataPrintReturPartDetail($nomor);

			$this->pdf->load_view('laporan/cetak_returpart', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_closewo($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['closewo'] = $this->form_model->GetDataPrintCloseWO($nomor);
			$data['detailwo'] = $this->form_model->GetDataPrintCloseWODetail($nomor);
			$data['detailpart'] = $this->form_model->GetDataPrintCloseWOPart($nomor);
			$data['totalwo'] = $this->form_model->GetDataPrintCloseWOTotal($nomor);

			$this->pdf->load_view('laporan/cetak_closewo', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_entryjasadetail($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['enrtyjasa'] = $this->form_model->GetDataPrintEntryJasa($nomor);
			$data['enrtyjasadetail'] = $this->form_model->GetDataPrintEntryJasaDetail($nomor);

			$this->pdf->load_view('laporan/cetak_entryjasadetail', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_historyso($nopolisi = null)
	{
		if (!empty($nopolisi)) {

			$param = explode(":", urldecode($nopolisi));
			$nomor = 'Report History';
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['so'] = $this->form_model->GetDataPrintHistorySO($param[0], $param[1]);

			$this->pdf->load_view('laporan/cetak_historyso', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));
		}
	}

	public function cetak_penghapusanpiutang($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['penghapusan'] = $this->form_model->GetDataPrintPenghapusan($nomor);
			$data['detail'] = $this->form_model->GetDataPrintPenghapusanDetail($nomor);

			$this->pdf->load_view('laporan/cetak_penghapusanpiutang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}


	public function cetak_estimasiorder($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'legal';
			$orientation = 'landscape';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['order'] = $this->form_model->GetDataPrintEstimasiOrder($nomor);
			$data['detailorder'] = $this->form_model->GetDataPrintEstimasiOrderDetail($nomor);

			$this->pdf->load_view('laporan/cetak_estimasiorder', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_serahterimaunit($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['serahterimaunit'] = $this->form_model->GetDataPrintSerahTerimaUnit($nomor);

			$this->pdf->load_view('laporan/cetak_serahterimaunit', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}


	public function cetak_fakturpartcountergudang($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['counter'] = $this->form_model->GetDataPrintPartCounterFaktur($nomor);
			$data['counterdetail'] = $this->form_model->GetDataPrintPartCounterFakturDetail($nomor);

			$this->pdf->load_view('laporan/cetak_fakturcountergudang', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_statuspekerjaan($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'A4';
			$orientation = 'portrait';

			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['spk'] = $this->form_model->GetDataPrintSPK($nomor);
			$data['spkjasa'] = $this->form_model->GetDataPrintStatusPekerjaan($nomor);

			$this->pdf->load_view('laporan/cetak_statuspekerjaan', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_workshopAR_GR($nama = null)
	{
		
		$param = explode(":", urldecode($nama));
		if (!empty($nama)) {
			$paper = 'letter';
			$orientation = 'landscape';
			$kodecabang = $this->session->userdata('mycabang');
			$kodesubcabang = $this->session->userdata('mysubcabang');
			$kodecompany = $this->session->userdata('mycompany');

			// menggunakan class dompdf
			$this->load->library('pdf');

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');
			// $data['workshopar'] = $this->form_model->GetDataWorkshopAR($nama);
			$data['workshopardetail'] = $this->form_model->GetDataWorkshopARDetail_GR($param[0],$param[1],$param[2],$param[3], $kodecabang, $kodesubcabang, $kodecompany);
			$this->pdf->load_view('laporan/cetak_workshopar_gr', $data, $nama, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'landscape');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	public function cetak_workshopAR_PartCounter($nama = null)
	{
		$param = explode(":", urldecode($nama));
		if (!empty($nama)) {
			$paper = 'A4';
			$orientation = 'landscape';
			$kodecabang = $this->session->userdata('mycabang');
			$kodesubcabang = $this->session->userdata('mysubcabang');
			$kodecompany = $this->session->userdata('mycompany');


			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['workshopardetail2'] = $this->form_model->GetDataWorkshopARDetail_PartCounter($param[0],$param[1],$param[2],$param[3], $kodecabang, $kodecompany);

			$this->pdf->load_view('laporan/cetak_workshopar_partcounter', $data, $nama, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'landscape');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
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


			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['workshopar_woopen'] = $this->form_model->GetDataWorkshopARDetail_WOOpen($param[0], $kodecabang, $kodecompany);

			$this->pdf->load_view('laporan/cetak_workshopar_woopen', $data, $nama, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'landscape');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
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


			// menggunakan class dompdf
			$this->load->library('pdf');

			$namasupplier =  urldecode($nama);
			$data['workshopap_part'] = $this->form_model->GetDataWorkshopAPDetail_PartCounter($param[0],$param[1],$param[2],$param[3],  $kodecabang, $kodesubcabang, $kodecompany);

			$this->pdf->load_view('laporan/cetak_workshopap_partcounter', $data, $nama, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'landscape');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
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


			// menggunakan class dompdf
			$this->load->library('pdf');

			$namasupplier =  urldecode($nama);
			$data['workshopap_opl'] = $this->form_model->GetDataWorkshopAPDetail_OPL($param[0],$param[1],$param[2],$param[3], $kodecabang, $kodesubcabang, $kodecompany);

			$this->pdf->load_view('laporan/cetak_workshopap_opl', $data, $nama, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'landscape');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}

	
	public function cetak_pemakaianpart($nomor = null)
	{
		if (!empty($nomor)) {
			$paper = 'Letter';
			$orientation = 'potrait';
			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['pembebanan'] = $this->form_model->GetDataPrintPemakaian($nomor);
			$data['detail'] = $this->form_model->GetDataPrintPemakaianDetail($nomor);
			// $data['spkjasa'] = $this->entry_spk_model->GetDataPrintJasa($nomor);

			$this->pdf->load_view('laporan/cetak_pemakaianpart', $data, $nomor, $paper, $orientation);

			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

			exit(0);
		}
	}
}
