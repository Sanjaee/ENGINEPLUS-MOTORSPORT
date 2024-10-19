<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginc extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model("login/login_model");
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	public function index()
	{
		//  $this->load->view('admin/utama/menu');       	
		$this->load->view('menu/login/login');      	
	}
	
	
	public function cek_login(){
		
		$username = str_replace("'","",$this->input->post('username'));
		$password = $this->input->post('password');
		
		$mdpass = md5($password);
		

		$get["login"] =  $this->login_model->getlog($username, $mdpass);
		if (!empty($get["login"]->login)){
			foreach($get as $row)
			{
				//echo $row;
				$this->session->set_userdata('myusername',$username);
				$this->session->set_userdata('mygrup',$get["login"]->grup) ;
				$this->session->set_userdata('mycabang',$get["login"]->kode_cabang);
				$this->session->set_userdata('mysubcabang',$get["login"]->kodesub);
				$this->session->set_userdata('mycompany',$get["login"]->kodecompany);
				$this->session->set_userdata('setppn',$get["login"]->ppn);
				$this->session->set_userdata('mygrupcabang',$get["login"]->kodegrup);
				//echo $get["user"]->username;
				//echo ($get["login"]->kode_cabang);

				//---- insert stock bulan baru
				$periode = date("Y").date("m");

				$cek = $this->login_model->checkstock($periode);				
				if (empty($cek)) {
					//insert stock awal dari stock akhir bulan lalu
					$periodelama = date('Ym', strtotime(date('Y-m')." -1 month"));
					$this->login_model->stockbulanlalu($periodelama,$periode);
				};
				//---- end here---------
				
				$data['title'] = "Home";
				$data['script'] = "menu/utama/button";
				$this->template->view('menu/utama/dashboard2', $data);
			}
		}else
		{
			$this->session->set_flashdata('pesan', '<center><div class="alert" style="color:tomato; font-size: 16pt;"><i class="fa fa-warning"></i><p>Username dan Password salah.</p></div></center>');
			$this->session->unset_userdata('myusername');
			redirect('main/index');
		}
		return false;
	}


	function logout() {
		$this->session->unset_userdata('myusername');
        $this->session->unset_userdata('mygrup');
		$this->session->unset_userdata('mycabang');
		$this->session->unset_userdata('mysubcabang');
		$this->session->unset_userdata('mycompany');
		$this->session->unset_userdata('mygrupcabang');
		$this->session->unset_userdata('setppn');
		redirect('main/index');
    }
}
	
