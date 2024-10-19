<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Otorisasi_report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model("masterdata/otorisasi_report_model");
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function update()
	{
		$userlogin = $this->session->userdata('myusername');
		$data = array(
			'jenis' => $this->input->post('nama'),
			'aktif' => $this->input->post('aktif'),
			'tglsimpan' => date("Y-m-d H:i:s"),
			'pemakai' => $userlogin
		);
		$result = $this->otorisasi_report_model->update($data, $this->input->post('id_jenis'));
		if ($result == true) {
			$resultjson = array(
				'message' => "Data berhasil diubah"
			);
		} else {
			$resultjson = array(
				'message' => "Data gagal diubah"
			);
		}
		echo json_encode($resultjson);
		// $this->session->set_flashdata('success', 'Berhasil diubah');
	}
	public function find()
	{
		$data = $this->otorisasi_report_model->get($this->input->post('jenis'));
		echo json_encode($data);
	}

	public function findreport()
	{
		// echo json_encode($this->otorisasi_report_model->findreport());
	}
	public function save()
	{
		$userlogin = $this->session->userdata('myusername');
		$errorvalidasi = FALSE;
		if ($errorvalidasi == FALSE) {
			$this->db->trans_start(); # Starting Transaction
			$this->db->trans_strict(FALSE);
			$data = array(
				'jenis' => $this->input->post('nama'),
				'aktif' => $this->input->post('aktif'),
				'tglsimpan' => date("Y-m-d H:i:s"),
				'pemakai' => $userlogin
			);
			$this->otorisasi_report_model->save($data);


			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$resultjson = array(
					'kode' => "",
					'message' => "Data gagal disimpan, kode sudah pernah digunakan"
				);
				# Something went wrong.
				$this->db->trans_rollback();
			} else {
				$resultjson = array(
					'kode' => $this->input->post('nama'),
					'message' => "Data berhasil disimpan"
				);
				# Everything is Perfect. 
				# Committing data to the database.
				$this->db->trans_commit();
			}
			echo json_encode($resultjson);
			return FALSE;
		}
	}
}
