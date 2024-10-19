<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index()
	{
		if (true == $this->session->has_userdata('myusername')) {
			redirect('main/dashboard');
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function dashboard()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Home";
			$data['script'] = "menu/utama/button";
			$this->template->view('menu/utama/dashboard2', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}


	//SUBMENU
	public function menu_spk()
	{

		if (true == $this->session->has_userdata('myusername')) {
			$this->load->view('submenu/menu_spk');
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
		// $this->load->view('submenu/menu_spk');
	}

	public function menu_faktur()
	{
		$this->load->view('submenu/menu_faktur');
	}

	public function menu_sparepart()
	{
		$this->load->view('submenu/menu_sparepart');
	}
	public function menu_finance()
	{
		$this->load->view('submenu/menu_finance');
	}
	public function menu_report()
	{
		$this->load->view('submenu/menu_report');
	}
	public function menu_masterdata()
	{
		$this->load->view('submenu/menu_masterdata');
	}
	// END SUBMENU

	//MENU SPK & HISTORY

	public function entry_datakendaraan()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Entry Data Kendaraan";
			$data['script'] = "menu/spk/entry_datakendaraan/button";
			$this->template->view('menu/spk/entry_datakendaraan/entry_datakendaraan', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function entry_spk($nopol = null)
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Entry SPK & Histoy";
			$data['script'] = "menu/spk/entry_spk/button";
			$data['nopol'] = $nopol;
			$this->template->view('menu/spk/entry_spk/entry_spk', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function entry_spkwo($nomorwo = null)
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Entry SPK & Histoy";
			$data['script'] = "menu/spk/entry_spk/button";
			$nomor_wo = base64_decode($nomorwo);
			$data['nomor_wo'] = $nomor_wo;
			$this->template->view('menu/spk/entry_spk/entry_spk', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}


	public function pembatalan_spk()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Memo Pembatalan SPK";
			$data['script'] = "menu/spk/memo_pembatalan/button";
			$this->template->view('menu/spk/memo_pembatalan/memo_pembatalan', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function orderpekerjaanluar()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Order Pekerjaan Luar";
			$data['script'] = "menu/spk/order_pekerjaanluar/button";
			$this->template->view('menu/spk/order_pekerjaanluar/order_pekerjaanluar', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function booking()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Booking Service";
			$data['script'] = "menu/spk/booking/button";
			$this->template->view('menu/spk/booking/booking', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function estimasiwo($nopol = null)
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Estimasi WO";
			$data['script'] = "menu/spk/estimasi/button";
			$data['nopol'] = $nopol;
			$this->template->view('menu/spk/estimasi/estimasi', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function entry_jasa_detail($nopol = null)
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Entry Jasa Detail";
			$data['script'] = "menu/spk/entry_jasa_detail/button";
			$this->template->view('menu/spk/entry_jasa_detail/entry_jasa_detail', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	//END SPK & HISTORY


	//MENU FAKTUR
	public function inputfakturpajak()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Input Faktur Pajak";
			$data['script'] = "menu/faktur/inputfakturpajak/button";
			$this->template->view('menu/faktur/inputfakturpajak/inputfakturpajak', $data);
		} else {
			$this->session->unset_userdata('myusername');
			redirect('main/index');
		}
		return false;
	}

	public function faktur()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Entry Faktur";
			$data['script'] = "menu/faktur/faktur/button";
			$this->template->view('menu/faktur/faktur/faktur', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function serahterima_unit()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Serah Terima Unit";
			$data['script'] = "menu/faktur/serahterima_unit/button";
			$this->template->view('menu/faktur/serahterima_unit/serahterima_unit', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function closewo()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Close SPK";
			$data['script'] = "menu/faktur/closewo/button";
			$this->template->view('menu/faktur/closewo/closewo', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	//END FAKTUR

	public function registerfp()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Register Nomor Faktur Pajak";
			$data['script'] = "menu/faktur/registernomorfp/js";
			$this->template->view('menu/faktur/registernomorfp/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			redirect('main/index');
		}
		return false;
	}

	//MENU FINANCE
	public function penerimaanuang()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Penerimaan Uang";
			$data['script'] = "menu/finance/penerimaan_uang/js";
			$this->template->view('menu/finance/penerimaan_uang/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function permohonanuang()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Permohonan Uang";
			$data['script'] = "menu/finance/permohonan_uang/js";
			$this->template->view('menu/finance/permohonan_uang/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function pengeluaranuang()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Pengeluaran Uang";
			$data['script'] = "menu/finance/pengeluaran_uang/js";
			$this->template->view('menu/finance/pengeluaran_uang/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function pencairankartu()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Pencairan Kartu Debit Kredit";
			$data['script'] = "menu/finance/pencairan_kartu/js";
			$this->template->view('menu/finance/pencairan_kartu/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function penghapusanpiutang()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Penghapusan Piutang";
			$data['script'] = "menu/finance/penghapusanpiutang/js";
			$this->template->view('menu/finance/penghapusanpiutang/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	//END MENU FINANCE

	//---- menu sparepart--------
	public function orderingsparepart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "ORDERING SPAREPART";
			$data['script'] = "menu/sparepart/ordering/button";
			$this->template->view('menu/sparepart/ordering/ordering_sparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function penerimaansparepart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "PENERIMAAN SPAREPART";
			$data['script'] = "menu/sparepart/penerimaan/button";
			$this->template->view('menu/sparepart/penerimaan/penerimaan_sparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}


	public function requestcabang()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Request Cabang Sparepart";
			$data['script'] = "menu/sparepart/request_cabang/button";
			$this->template->view('menu/sparepart/request_cabang/request_cabang', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function transfersparepart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Transfer Sparepart";
			$data['script'] = "menu/sparepart/transfer/button";
			$this->template->view('menu/sparepart/transfer/transfer_sparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function transferho()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Transfer Sparepart";
			$data['script'] = "menu/sparepart/transfer_ho/button";
			$this->template->view('menu/sparepart/transfer_ho/transfer_partho', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function pembebanansparepart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Pembebanan Sparepart";
			$data['script'] = "menu/sparepart/pembebanan/button";
			$this->template->view('menu/sparepart/pembebanan/pembebanan_sparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function bagsparepart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "BAG Sparepart";
			$data['script'] = "menu/sparepart/bag_sparepart/button";
			$this->template->view('menu/sparepart/bag_sparepart/bag_sparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function stockopnamesparepart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Stockopname Sparepart";
			$data['script'] = "menu/sparepart/stockopname_sparepart/button";
			$this->template->view('menu/sparepart/stockopname_sparepart/stockopname_sparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function requestpart_teknisi()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Request Part Teknisi";
			$data['script'] = "menu/sparepart/requestpart_teknisi/button";
			$this->template->view('menu/sparepart/requestpart_teknisi/requestpart_teknisi', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function ordering_partcounter()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Order Part Counter";
			$data['script'] = "menu/sparepart/ordering_partcounter/button";
			$this->template->view('menu/sparepart/ordering_partcounter/ordering_partcounter', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function faktur_partcounter()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Faktur Part Counter";
			$data['script'] = "menu/sparepart/faktur_partcounter/button";
			$this->template->view('menu/sparepart/faktur_partcounter/faktur_partcounter', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function penerimaan_transferpart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Penerimaan Transfer Parts";
			$data['script'] = "menu/sparepart/penerimaan_transfer/button";
			$this->template->view('menu/sparepart/penerimaan_transfer/penerimaan_transfer_sparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function returpenerimaansparepart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "RETUR PENERIMAAN SPAREPART";
			$data['script'] = "menu/sparepart/retur_penerimaan/button";
			$this->template->view('menu/sparepart/retur_penerimaan/returpenerimaan_sparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	//END SPAREPART


	//MENU MASTER DATA
	public function product()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Product";
			$data['script'] = "menu/masterdata/product/button";
			$this->template->view('menu/masterdata/product/product', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function kodepos()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Kodepos";
			$data['script'] = "menu/masterdata/kodepos/button";
			$this->template->view('menu/masterdata/kodepos/kodepos', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function konfigurasi()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Konfigurasi";
			$data['script'] = "menu/masterdata/konfigurasi/button";
			$this->template->view('menu/masterdata/konfigurasi/konfigurasi', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function user()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Users";
			$data['script'] = "menu/masterdata/user/button";
			$this->template->view('menu/masterdata/user/user', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function user_login()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Users";
			$data['script'] = "menu/masterdata/user/button";
			$this->template->view('menu/masterdata/user/user', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function ganti_pass()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "User Login";
			$data['script'] = "menu/masterdata/ganti_pass/button";
			$this->template->view('menu/masterdata/ganti_pass/ganti_pass', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function cabang()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Cabang";
			$data['script'] = "menu/masterdata/cabang/button";
			$this->template->view('menu/masterdata/cabang/cabang', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function subcabang()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Sub Cabang";
			$data['script'] = "menu/masterdata/subcabang/button";
			$this->template->view('menu/masterdata/subcabang/subcabang', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function warna()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Warna";
			$data['script'] = "menu/masterdata/warna/button";
			$this->template->view('menu/masterdata/warna/warna', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function tipe()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Tipe";
			$data['script'] = "menu/masterdata/tipe/button";
			$this->template->view('menu/masterdata/tipe/tipe', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function supplier()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Supplier";
			$data['script'] = "menu/masterdata/supplier/button";
			$this->template->view('menu/masterdata/supplier/supplier', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function customer()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Customer";
			$data['script'] = "menu/masterdata/customer/button";
			$this->template->view('menu/masterdata/customer/customer', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function parts()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Parts";
			$data['script'] = "menu/masterdata/parts/button";
			$this->template->view('menu/masterdata/parts/parts', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function bahan()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Bahan";
			$data['script'] = "menu/masterdata/bahan/button";
			$this->template->view('menu/masterdata/bahan/bahan', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function jasa()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Jasa";
			$data['script'] = "menu/masterdata/jasa/button";
			$this->template->view('menu/masterdata/jasa/jasa', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function account()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Account";
			$data['script'] = "menu/masterdata/account/button";
			$this->template->view('menu/masterdata/account/account', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function account_lain2()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Account Lain-lain";
			$data['script'] = "menu/masterdata/account_lain2/button";
			$this->template->view('menu/masterdata/account_lain2/account_lain2', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function departement()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Departemen";
			$data['script'] = "menu/masterdata/departement/button";
			$this->template->view('menu/masterdata/departement/departement', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function mekanik()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Mekanik";
			$data['script'] = "menu/masterdata/mekanik/button";
			$this->template->view('menu/masterdata/mekanik/mekanik', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function otorisasimenu()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Otorisasi Menu";
			$data['script'] = "menu/masterdata/otorisasi_menu/button";
			$this->template->view('menu/masterdata/otorisasi_menu/otorisasi_menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function otorisasi_discount()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Otorisasi Discount";
			$data['script'] = "menu/masterdata/otorisasi_discount/button";
			$this->template->view('menu/masterdata/otorisasi_discount/otorisasi_discount', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function otorisasi_pembatalan()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Otorisasi Pembatalan";
			$data['script'] = "menu/masterdata/otorisasi_pembatalan/button";
			$this->template->view('menu/masterdata/otorisasi_pembatalan/otorisasi_pembatalan', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function opl()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Jasa OPL";
			$data['script'] = "menu/masterdata/opl/button";
			$this->template->view('menu/masterdata/opl/opl', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function foreman()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Foreman";
			$data['script'] = "menu/masterdata/foreman/button";
			$this->template->view('menu/masterdata/foreman/foreman', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function jasatipe()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Jasa Tipe";
			$data['script'] = "menu/masterdata/jasatipe/button";
			$this->template->view('menu/masterdata/jasatipe/jasatipe', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function saldoawalkasbank()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Saldo Awal Kas & Bank";
			$data['script'] = "menu/masterdata/saldoawalbank/js";
			$this->template->view('menu/masterdata/saldoawalbank/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function regularcheck()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Regular Check";
			$data['script'] = "menu/masterdata/regularcheck/button";
			$this->template->view('menu/masterdata/regularcheck/regular', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function dataregularcheck()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Data Regular Check";
			$data['script'] = "menu/masterdata/data_regularcheck/button";
			$this->template->view('menu/masterdata/data_regularcheck/regularcheck', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function closingaccounting()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Closing Accounting";
			$data['script'] = "menu/masterdata/closing_accounting/button";
			$this->template->view('menu/masterdata/closing_accounting/closing_accounting', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function jasadetail()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Jasa Detail";
			$data['script'] = "menu/masterdata/jasadetail/button";
			$this->template->view('menu/masterdata/jasadetail/jasadetail', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function projectmanager()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Jasa Detail";
			$data['script'] = "menu/masterdata/projectmanager/button";
			$this->template->view('menu/masterdata/projectmanager/projectmanager', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function jenisreport()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Closing Accounting";
			$data['script'] = "menu/masterdata/jenis_report/button";
			$this->template->view('menu/masterdata/jenis_report/jenis_report', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	public function otorisasireport()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Closing Accounting";
			$data['script'] = "menu/masterdata/otorisasireport/button";
			$this->template->view('menu/masterdata/otorisasireport/otorisasi_report', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	//END MENU MASTER DATA

	//CETAK REPORT
	public function print_report()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Cetak Report SPK";
			$data['script'] = "menu/report/button";
			$this->template->view('menu/report/print_report', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function export_report()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Cetak Report SPK";
			$data['script'] = "menu/export_report/button";
			$this->template->view('menu/export_report/export_report', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function reportkasbank()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Report Kas & Bank";
			$data['script'] = "menu/reportkasbank/js";
			$this->template->view('menu/reportkasbank/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			redirect('main/login/login');
		}
	}

	public function reportstock()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Report Stock";
			$data['script'] = "menu/stok/js";
			$this->template->view('menu/stok/report_stoksparepart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			redirect('main/login/login');
		}
	}

	public function revisivoucher()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Revisi Voucher";
			$data['script'] = "menu/finance/revisi_voucher/js";
			$this->template->view('menu/finance/revisi_voucher/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function estimasiorder()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Estimasi Order Part";
			$data['script'] = "menu/sparepart/estimasi_order/button";
			$this->template->view('menu/sparepart/estimasi_order/estimasi_order', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function historypenjualan()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "History Penjualan";
			$data['script'] = "menu/masterdata/history_penjualan/js";
			$this->template->view('menu/masterdata/history_penjualan/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function historypembelian()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "History Pembelian";
			$data['script'] = "menu/masterdata/history_pembelian/js";
			$this->template->view('menu/masterdata/history_pembelian/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function approval()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Approval WO & Permohonan Uang";
			$data['script'] = "menu/finance/approval_permohonanuang/js";
			$this->template->view('menu/finance/approval_permohonanuang/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function statuspekerjaan()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Pencatatan Waktu";
			$data['script'] = "menu/spk/statuspekerjaan/js";
			$this->template->view('menu/spk/statuspekerjaan/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function workshopAR()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "AR Workshop";
			$data['script'] = "menu/masterdata/workshopAR/js";
			$this->template->view('menu/masterdata/workshopAR/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
	
	public function workshopAP()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "AR Workshop";
			$data['script'] = "menu/masterdata/workshopAP/js";
			$this->template->view('menu/masterdata/workshopAP/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function statuskendaraan()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Status Kendaraan";
			$data['script'] = "menu/masterdata/statuskendaraan/button";
			$this->template->view('menu/masterdata/statuskendaraan/statuskendaraan', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function statuspekerjaanmobil()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Status Kendaraan";
			$data['script'] = "menu/masterdata/statuspekerjaanmobil/button";
			$this->template->view('menu/masterdata/statuspekerjaanmobil/statuspekerjaanmobil', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function jeniscustomer()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Jenis Customer";
			$data['script'] = "menu/masterdata/jeniscustomer/button";
			$this->template->view('menu/masterdata/jeniscustomer/jeniscustomer', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function statusorder()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Status Order";
			$data['script'] = "menu/masterdata/statusorder/button";
			$this->template->view('menu/masterdata/statusorder/statusorder', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	

	public function workshopsum()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Tool Control Summary";
			$data['script'] = "menu/masterdata/workshopsummary/js";
			$this->template->view('menu/masterdata/workshopsummary/menu', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}

	public function pemakaianpart()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['title'] = "Pemakaian Sparepart";
			$data['script'] = "menu/sparepart/pemakaianpart/button";
			$this->template->view('menu/sparepart/pemakaianpart/pemakaianpart', $data);
		} else {
			$this->session->unset_userdata('myusername');
			$this->load->view('menu/login/login');
		}
		return false;
	}
}
