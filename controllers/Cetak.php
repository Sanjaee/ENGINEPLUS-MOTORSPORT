<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('spk/entry_spk_model');
        $this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
        $this->load->library('session');
	}
	
	public function cetakpdf($nomor = null){
		if (!empty($nomor)){
		
		
			// menggunakan class dompdf
			$this->load->library('pdf');

			$data['spk'] = $this->entry_spk_model->GetDataPrint($nomor);

			$data['spkpart'] = $this->entry_spk_model->GetDataPrintPart($nomor);
			$data['spkjasa'] = $this->entry_spk_model->GetDataPrintJasa($nomor);

			$this->pdf->load_view('laporan/cetak', $data);
			        
			// (Opsional) Mengatur ukuran kertas dan orientasi kertas
			$this->pdf->setPaper('F4', 'portrait');

			// Menjadikan HTML sebagai PDF
			$this->pdf->render();

			// Output akan menghasilkan PDF (1 = download dan 0 = preview)
			$this->pdf->stream("welcome.pdf", array("Attachment"=>0));
		}

	}

	// public function cetakpdf($nomor = null){
	// 	if (!empty($nomor)){
		
		
	// 		// menggunakan class dompdf
	// 		$this->load->library('pdf');
	// 		//$data['data'] = $this->entry_spk_model->cetakpdf($nomor);

	// 		$data['data'] = array(
	// 			['nomorspk' => $nomor]
	// 		);
			
	// 		$this->pdf->load_view('laporan/cetak', $data);        
	// 		// (Opsional) Mengatur ukuran kertas dan orientasi kertas
	// 		$this->pdf->setPaper('F4', 'portrait');

	// 		// Menjadikan HTML sebagai PDF
	// 		$this->pdf->render();

	// 		// Output akan menghasilkan PDF (1 = download dan 0 = preview)
	// 		$this->pdf->stream("welcome.pdf", array("Attachment"=>0));
	// 	}

	// }
	 
}