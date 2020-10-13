
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller {

	public function index()
	{
		$this->load->view('api_view');
	}

	function action()
	{
		if ($this->input->post('data_action'))
		{
			$data_action=$this->input->post('data_action');
			if ($data_action=="Delete") {
				# code...
				$api_url="http://localhost/CobaRestApi/api/delete" ;
				$form_data = array('nim' => $this->input->post('nim'));
				$client=curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response=curl_exec($client);
				curl_close($client);
				echo $response;

			}
			if ($data_action=="Edit")
				{
					$api_url="http://localhost/CobaRestApi/api/update";
					$form_data = array('nim' => $this->input->post('nim'),
						'nama' => $this->input->post('nama'));
					$client=curl_init($api_url);
					curl_setopt($client, CURLOPT_POST, true);
					curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
					curl_setopt($client,CURLOPT_RETURNTRANSFER, true);
					$response=curl_exec($client);
					curl_close($client);
					echo $response;
				} 
			if($data_action == "fetch_single" ){
					$api_url="http://localhost/CobaRestApi/api/fetch_single";
					$form_data = array('nim' => $this->input->post('nim'));
					$client=curl_init($api_url);
					curl_setopt($client, CURLOPT_POST, true);
					curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
					curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
					$response=curl_exec($client);
					echo $response;
				# code...
			}
			if ($data_action=="Insert")
				{
					$api_url="http://localhost/CobaRestApi/api/insert";
					$form_data = array('nim' => $this->input->post('nim'),
						'nama' => $this->input->post('nama'));
					$client=curl_init($api_url);
					curl_setopt($client, CURLOPT_POST, true);
					curl_setopt($client, CURLOPT_POSTFIELDS,$form_data);
					curl_setopt($clienT,CURLOPT_RETURNTRANSFER, true);
					$response=curl_exec($client);
					curl_close($client);
					echo $response;
				} 

			if($data_action == "fetch_all" )
			{
					$api_url="http://localhost/CobaRestApi/api";
					$client=curl_init($api_url);
					curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
					$response=curl_exec($client);
					curl_close($client);
					$result=json_decode($response);
					$output='';
					if (count($result)>0) {
						# code...
						foreach ($result as $row) {
							$output .='
							<tr>
							<td>'.$row->nim.'</td>
							<td>'.$row->nama.'</td>
							<td> <button type="button" name="edit" class="btn btn-warning edit" id="'.$row->nim.'"><i class="material-icons"
							style="font-size:15px">edit</i></button></td>
							<td><button type="button" name="delete" class = "btn btn-danger delete" id="'.$row->nim.'"><i class="material-icons" style="font-size:15px">delete</i></button></td>
							</tr>
							';
							
							# code...
						}
					}
					else{
						$output .='
						<tr>
						<td colspan="4" align"center>No Data Found</td
						</tr>
						';
					} echo $output;
					
			}

		}
	}

}
?>

