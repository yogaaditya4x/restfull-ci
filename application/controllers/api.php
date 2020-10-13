
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	function index(){
		$data = $this->api_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert(){
		$this->form_validation->set_rules('nama','Nama Lengkap','required');
		$this->form_validation->set_rules('nim','NIM','required');
		if ($this->form_validation->run()) 
			{
				$data = array(
			'nama' => $this->input->post('nama'),
			'nim'=> $this->input->post('nim'));

		$this->api_model->insert_api($data);
		$array = array( 'succes'=> true);
			
		}
		else{
			$array = array(
				'error' => true,
				'nama_error' => form_error('nama'),
				'nim_error'=> form_error('nim')
			);
		}
		echo json_encode($array);
	}

	function fetch_single()
	{
		if ($this->input->post('nim')) {
			# code...
			$data = $this->api_model->fetch_single_user($this->input->post('nim'));
			foreach ($data as $row) {
				$output['nama'] = $row['nama'];
				$output['nim'] = $row['nim'];
				# code...
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('nama','Nama Lengkap','required');
		$this->form_validation->set_rules('nim','NIM','required');
		if ($this->form_validation->run()) 
		{
			$data = array(
				'nama' => $this->input->post('nama'),
				'nim' =>$this->input->post('nim')
			);
			$this->api_model->update_api(
				$this->input->post('nim'),$data
		);
			$array = array(
				'succes' => true
			);
		}
		else
		{
			$array = array(
				'error' => true,
				'nama_error' => form_error('nama'),
				'nim_error' => form_error('nim')
			);
		}
		echo json_encode($array);
	}
	function delete()
	{
		if ($this->input->post('nim')) {if ($this->api_model->delete_single_user($this->input->post('nim'))) {

			$array = array(
				'success' =>true
			);
			# code...
		}
		else{
			$array = array(
				'error' => true);
		}
		echo json_encode($array);
			
			
		}
		
	}


}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
?>