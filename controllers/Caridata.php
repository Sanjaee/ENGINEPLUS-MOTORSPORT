<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Caridata extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
		$this->load->model('caridata_model');
		$this->load->model('caridata2_model');
		$this->load->model('caridataaktif_model');
	}
	function index()
	{
		$data["title"] = "Codeigniter Ajax CRUD with Data Tables and Bootstrap Modals";
		$this->load->view('crud_view', $data);
	}
	function caridata()
	{

		$fetch_data = $this->caridata_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'));
		// print_r($_POST["order"]);
		// print_r($_POST['order']['0']['column']);
		// die();
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
						$sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
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
			"recordsTotal"          =>      $this->caridata_model->get_all_data($this->input->post('nmtb')),
			"recordsFiltered"     =>     $this->caridata_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort')),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	function caridata2()
	{

		$fetch_data = $this->caridata2_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'));
		// print_r($_POST["order"]);
		// print_r($_POST['order']['0']['column']);
		// die();
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
						$sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
						// class="btn btn-new"><i class="fa fa-pen"></i>
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
			"recordsTotal"          =>      $this->caridata2_model->get_all_data($this->input->post('nmtb')),
			"recordsFiltered"     =>     $this->caridata2_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where')),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}
	function caridataaktif()
	{

		$fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
		// print_r($_POST["order"]);
		// print_r($this->input->post('value'));
		// die();
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
						$sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
						$sub_array[] = $row->$value;
						// class="btn btn-new"><i class="fa fa-pen"></i>
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


	public function cariprojectmanager()
	{

		$fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
		// print_r($_POST["order"]);
		// print_r($this->input->post('value'));
		// die();
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
						$sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
						$sub_array[] = $row->$value;
						// class="btn btn-new"><i class="fa fa-pen"></i>
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

	function caridatajenisreport()
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
						$sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
						$sub_array[] = $row->$value;
						// class="btn btn-new"><i class="fa fa-pen"></i>
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

	function caridatareport()
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
						$sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
						$sub_array[] = $row->$value;
						// class="btn btn-new"><i class="fa fa-pen"></i>
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

	function carireport()
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
						$sub_array[] = '<button class="btn btn-success searchok" data-id="' . $msearch . '"><i class="fa fa-hand-o-right"></i></button> ';
						$sub_array[] = $row->$value;
						// class="btn btn-new"><i class="fa fa-pen"></i>
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
