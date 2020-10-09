<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

/**
 * 
 */
class Api extends CI_Controller
{
	
	public function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->api_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('nama','Nama Lengkap','required');
		$this->form_validation->set_rules('nim','NIM','required');
		if($this->form_validation->run())
		{
			$data = array(
				'nama'	=> $this->input->post('nama'),
				'nim'	=> $this->input->post('nim')
			);

			$this->
		}
	}
}


 ?>