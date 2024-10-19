<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Statuskendaraan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model("masterdata/statuskendaraan_model");
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function update()
	{
		$userlogin = $this->session->userdata('myusername');
		$data = array(
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
            'aktif' => $this->input->post('aktif')
		);
		$result = $this->statuskendaraan_model->update($data, $this->input->post('kode'));
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
		$data = $this->statuskendaraan_model->get($this->input->post('kode'));
		echo json_encode($data);
	}
	public function save()
	{
		$userlogin = $this->session->userdata('myusername');
		$errorvalidasi = FALSE;
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');

		$last_kode_statuskendaraan = $this->statuskendaraan_model->last_statuskendaraan($kode);
		if ($last_kode_statuskendaraan->kode == $kode or $last_kode_statuskendaraan->kode == " ") {
			$kode = "SK" . sprintf("%04s", $kode + 1);;
		} else {
			// PM0001
			$slice = substr($last_kode_statuskendaraan->kode, 2);
			$kode = "SK" . sprintf("%04s", $slice + 1);
		}

		if ($errorvalidasi == FALSE) {
			$this->db->trans_start(); # Starting Transaction
			$this->db->trans_strict(FALSE);
			$data = array(
				'kode' => $kode,
				'nama' => $nama,
				'aktif' => $this->input->post('aktif'),
				'tglsimpan' => date("Y-m-d H:i:s"),
				'pemakai' => $userlogin
			);
			$this->statuskendaraan_model->save($data);

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
					'kode' => $kode,
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
