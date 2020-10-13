<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

	function fetch_all()
	{
		$this->db->order_by('nim','DESC');
		return $this->db->get('mhs');
	}

	function insert_api($data)
	{
		$this->db->insert('mhs',$data);
	}
	function fetch_single_user($nim)
	{
		$this->db->where('nim', $nim);
		$query = $this->db->get('mhs');
		return $query->result_array();
	}
	function update_api($nim,$data)
	{
		$this->db->where('nim',$nim);
		$this->db->update('mhs',$data);
	}
	function delete_single_user($nim)
	{
		$this->db->where('nim',$nim);
		$this->db->delete('mhs');
		if ($this ->db->affected_rows()> 0) {
			# code...
			return true;
		}
		else 
		{
			return false;
		}
	}	

	

}
?>

