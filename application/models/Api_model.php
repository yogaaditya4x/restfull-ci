<?php

class Api_model extends CI_Model 
{
	
	function fetch_all()
	{
		$this->db->order_by('nim','DESC');
		return $this->db->get('user_details_table');
	}

	function insert_api($data)
	{
		$this->db->insert('user_details_table', $data);
	}

	function fetch_single_user($nim)
	{
		$this->db->where('nim',$nim);
		$query = $this->db->get('user_details_table');
		return $query->result_array();
	}

	function update_api($nim,$data)
	{
		$this->db->where('nim',$nim);
		$this->db->update('user_details_table',$data);
	}

	function delete_single_user($nim)
	{
		$this->db->where('nim',$nim);
		$this->db->delete('user_details_table');
		if($this->db->affected_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>